<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $forums = Forum::where('is_active', true)
                ->withCount('topics')
                ->get();

            return view('forums.index', compact('forums'));
        } else {
            return view('welcome');
        }
    }
}
