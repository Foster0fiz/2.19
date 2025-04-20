<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'image'])
                     ->latest()
                     ->get();

        return view('home', compact('posts'));
    }
}
