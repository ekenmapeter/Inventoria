<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::withCount(['topics', 'posts'])->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['topics', 'posts', 'payments', 'moderatedForums']);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,moderator,user',
            'subscription_status' => 'required|in:active,pending,expired,cancelled',
            'suspended_until' => 'nullable|date',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'User updated successfully!');
    }

    /**
     * Suspend a user.
     */
    public function suspend(Request $request, User $user)
    {
        $validated = $request->validate([
            'suspended_until' => 'required|date|after:now',
        ]);

        $user->update([
            'suspended_until' => $validated['suspended_until'],
        ]);

        return redirect()->back()
            ->with('success', 'User suspended successfully!');
    }

    /**
     * Unsuspend a user.
     */
    public function unsuspend(User $user)
    {
        $user->update([
            'suspended_until' => null,
        ]);

        return redirect()->back()
            ->with('success', 'User unsuspended successfully!');
    }

    /**
     * Impersonate a user (login as user).
     */
    public function impersonate(User $user)
    {
        // Store admin ID in session
        session(['admin_id' => Auth::id()]);

        // Log in as the user
        auth()->guard('web')->login($user);

        return redirect()->route('dashboard')
            ->with('success', 'You are now logged in as ' . $user->name);
    }

    /**
     * Stop impersonating and return to admin.
     */
    public function stopImpersonating()
    {
        $adminId = session('admin_id');

        if ($adminId) {
            $admin = User::find($adminId);
            if ($admin && $admin->isAdmin()) {
                auth()->guard('web')->login($admin);
                session()->forget('admin_id');

                return redirect()->route('admin.dashboard')
                    ->with('success', 'Returned to admin panel.');
            }
        }

        return redirect()->route('admin.dashboard')
            ->with('error', 'Unable to return to admin panel.');
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,moderator,user',
            'subscription_status' => 'required|in:active,pending,expired,cancelled',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
            'role' => $validated['role'],
            'subscription_status' => $validated['subscription_status'],
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'Member created successfully!');
    }

    /**
     * Assign a package to a user.
     */
    public function assignPackage(Request $request, User $user)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);

        $package = Package::find($validated['package_id']);

        if ($user->packages()->where('package_id', $package->id)->exists()) {
            return redirect()->back()
                ->with('error', 'User already has this package assigned.');
        }

        $user->packages()->attach($package->id, ['assigned_at' => now()]);

        return redirect()->back()
            ->with('success', 'Package assigned successfully!');
    }

    /**
     * Remove a package from a user.
     */
    public function removePackage(User $user, Package $package)
    {
        $user->packages()->detach($package->id);

        return redirect()->back()
            ->with('success', 'Package removed successfully!');
    }

    /**
     * Delete a user from the forum.
     */
    public function destroy(User $user)
    {
        // Prevent deleting yourself
        if ($user->id === Auth::id()) {
            return redirect()->back()
                ->with('error', 'You cannot delete your own account.');
        }

        // Delete profile photo if exists
        if ($user->profile_photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_photo)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}
