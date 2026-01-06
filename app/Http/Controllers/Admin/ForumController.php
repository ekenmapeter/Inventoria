<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = Forum::withCount(['topics', 'moderators'])->latest()->get();

        return view('admin.forums.index', compact('forums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::whereIn('role', ['admin', 'moderator', 'user'])->get();

        return view('admin.forums.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'moderators' => 'array',
            'moderators.*' => 'exists:users,id',
        ]);

        $forum = Forum::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        if (isset($validated['moderators'])) {
            $forum->moderators()->sync($validated['moderators']);
        }

        return redirect()->route('admin.forums.index')
            ->with('success', 'Forum created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum)
    {
        $users = User::whereIn('role', ['admin', 'moderator', 'user'])->get();
        $forum->load('moderators');

        return view('admin.forums.edit', compact('forum', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Forum $forum)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'moderators' => 'array',
            'moderators.*' => 'exists:users,id',
        ]);

        $forum->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'is_active' => $request->has('is_active'),
        ]);

        if (isset($validated['moderators'])) {
            $forum->moderators()->sync($validated['moderators']);
        } else {
            $forum->moderators()->detach();
        }

        return redirect()->route('admin.forums.index')
            ->with('success', 'Forum updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        $forum->delete();

        return redirect()->route('admin.forums.index')
            ->with('success', 'Forum deleted successfully!');
    }
}
