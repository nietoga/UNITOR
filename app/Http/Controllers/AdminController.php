<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    public function index()
    {
        session()->put('module', 'use-icons');
        return view('admin.index');
    }

    public function comments()
    {
        session()->put('module', 'use-icons');
        $data["comments"] = Comment::where('reported', true)->get();
        return view('admin.comments')->with("data", $data);
    }

    public function posts(){
        session()->put('module', 'use-icons');
        $data["posts"] = Post::where('reported', true)->get();
        return view('admin.posts')->with("data", $data);
    }
}
