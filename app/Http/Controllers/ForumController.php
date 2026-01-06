<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = Forum::where('is_active', true)
            ->withCount('topics')
            ->get();

        return view('forums.index', compact('forums'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
    {
        $topics = $forum->topics()
            ->with(['user', 'posts'])
            ->withCount('posts')
            ->latest()
            ->paginate(15);

        return view('forums.show', compact('forum', 'topics'));
    }
}
