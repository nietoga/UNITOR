<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return view('home.index');
        }

        $data = []; //to be sent to the view

        $post = Post::findOrFail($id);
        $data["title"] = $post->getTitle();
        $data["post"] = $post;
        $data["user"] = User::findOrFail($post->getAuthorId());
        return view('forum.show')->with("data", $data);
    }

    public function destroy($id){
        $post = Post::findOrFail($id);
        $post->comments()->delete();
        $post->delete();
        $data["title"] = "Posts list";
        $data["posts"] = Post::all();

        return view('forum.list')->with("data", $data, 'success', 'Post deleted successfully!');
    }

    public function list()
    {
        $data = []; //to be sent to the view
        $data["title"] = "Posts list";
        $data["posts"] = Post::all();

        return view('forum.list')->with("data", $data);
    }

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = "Create post";
        $data["posts"] = Post::all();

        return view('forum.create')->with("data", $data);
    }

    public function save(Request $request)
    {
        $request->validate([
            "title" => "required",
            "content" => "required"
        ]);

        Post::create([
            'title' => $request["title"],
            'content' => $request["content"], 
            'author_id' => Auth::user()->getId()]
        );
        $data["title"] = "Created post";
        // return view('post.save')->with("data", $data);
        return back()->with('success', 'Post created successfully!');
    }
}
