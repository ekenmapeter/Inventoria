<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Notifications\DepositApproved;
use App\Notifications\DepositRejected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::with(['user', 'admin'])
            ->latest()
            ->paginate(20);

        return view('admin.deposits.index', compact('deposits'));
    }

    public function show(Deposit $deposit)
    {
        $deposit->load(['user', 'admin']);
        return view('admin.deposits.show', compact('deposit'));
    }

    public function approve(Request $request, Deposit $deposit)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $deposit->update([
            'status' => 'approved',
            'admin_id' => Auth::id(),
            'approved_at' => now(),
            'notes' => $request->notes ?? $deposit->notes,
        ]);

        // Create a payment record from the deposit
        $deposit->user->payments()->create([
            'amount' => $deposit->amount,
            'status' => 'approved',
            'admin_id' => Auth::id(),
        ]);

        // Update user subscription status
        $deposit->user->update([
            'subscription_status' => 'active',
        ]);

        // Send notification
        $deposit->user->notify(new DepositApproved($deposit));

        return redirect()->route('admin.deposits.show', $deposit)
            ->with('success', 'Deposit approved and payment created successfully.');
    }

    public function reject(Request $request, Deposit $deposit)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $deposit->update([
            'status' => 'rejected',
            'admin_id' => Auth::id(),
            'notes' => $request->notes ?? $deposit->notes,
        ]);

        // Send notification
        $deposit->user->notify(new DepositRejected($deposit, $request->notes));

        return redirect()->route('admin.deposits.show', $deposit)
            ->with('success', 'Deposit rejected successfully.');
    }

    public function create()
    {
        $users = \App\Models\User::where('role', 'user')->orderBy('name')->get();
        $paymentMethods = \App\Models\SiteSetting::get('payment_methods', ['bank_transfer', 'cash']);

        return view('admin.deposits.create', compact('users', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|in:bank_transfer,cash',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $depositData = [
            'user_id' => $validated['user_id'],
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status'],
        ];

        if ($validated['status'] === 'approved') {
            $depositData['admin_id'] = Auth::id();
            $depositData['approved_at'] = now();

            // Update user subscription status
            $user = \App\Models\User::find($validated['user_id']);
            $user->update(['subscription_status' => 'active']);
        }

        Deposit::create($depositData);

        return redirect()->route('admin.deposits.index')
            ->with('success', 'Deposit created successfully.');
    }
}
