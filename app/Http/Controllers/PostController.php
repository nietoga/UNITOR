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

    /**
     * Show a post from the list
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = []; //to be sent to the view
        $post = Post::findOrFail($id);
        $data["title"] = $post->getTitle();
        $data["post"] = $post;
        if ($post->user == Auth::user()) {
            $data["delete_btn"] = true;
        } else {
            $data["delete_btn"] = false;
        }
        return view('forum.show')->with("data", $data);
    }

    /**
     * Delete a post along with the associated comments. Users only can delete
     * their comments.
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user == Auth::user()) {
            $post->comments()->delete();
            $post->delete();
            return redirect('post/index')->with('success', 'Post deleted successfully!');
        } else {
            return (401);
        }
    }

    /**
     * List all posts in the forum
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = []; //to be sent to the view
        $data["title"] = "Posts list";
        $data["posts"] = Post::all();

        return view('forum.index')->with("data", $data);
    }

    /**
     * Show the form to creating a new post
     * 
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        $data = []; //to be sent to the view
        $data["title"] = "Create post";
        $data["posts"] = Post::all();

        return view('forum.new')->with("data", $data);
    }

    /**
     * Store a new post in storage
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        Post::validate($request);
        Post::create(
            [
                'title' => $request["title"],
                'content' => $request["content"],
                'user_id' => Auth::user()->getId()
            ]
        );
        $data["title"] = "Created post";

        return back()->with('success', 'Post created successfully!');
    }
}
