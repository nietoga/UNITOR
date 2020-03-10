<?php

namespace App\Http\Controllers;

use App\Comment;
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
        $data["comments"] = Comment::where('reported', true)->get();
        return view('admin.index')->with("data", $data);
    }
}
