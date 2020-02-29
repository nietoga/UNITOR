<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function show($id)
    {
        if (!is_numeric($id)) {
            return view('home.index');
        }

        $data = []; //to be sent to the view

        $post = Post::findOrFail($id);
        $data["title"] = $post->getTitle();
        $data["post"] = $post;
        return view('forum.show')->with("data", $data);
    }

    public function destroy($id){
        $post = Post::findOrFail($id);
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
            "content" => "required",
            "author_name" => "required"

        ]);
        Post::create($request->only(["title", "content", "author_name"]));
        $data["title"] = "Created post";
        // return view('post.save')->with("data", $data);
        return back()->with('success', 'Post created successfully!');
    }
}
