<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use App\Notifications\NewPostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $post = $topic->posts()->create([
            'body' => $validated['body'],
            'user_id' => Auth::id(),
        ]);

        // Notify all users who have posted in this topic (except the current user)
        $participants = $topic->posts()
            ->where('user_id', '!=', Auth::id())
            ->distinct('user_id')
            ->pluck('user_id')
            ->toArray();

        // Also notify the topic creator if they haven't posted yet
        if ($topic->user_id !== Auth::id() && !in_array($topic->user_id, $participants)) {
            $participants[] = $topic->user_id;
        }

        foreach ($participants as $userId) {
            $user = \App\Models\User::find($userId);
            if ($user) {
                $user->notify(new NewPostNotification($post));
            }
        }

        return redirect()->route('topics.show', $topic)
            ->with('success', 'Reply posted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'body' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('topics.show', $post->topic)
            ->with('success', 'Reply updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $topic = $post->topic;
        $post->delete();

        return redirect()->route('topics.show', $topic)
            ->with('success', 'Reply deleted successfully!');
    }
}
