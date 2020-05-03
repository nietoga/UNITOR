<?php

namespace App\Http\Controllers;
use Illuminate\Database\Schema\Blueprint;
use App\Post;
use App\User;
use App\Comment;
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
        $post = Post::with("comments")->find($id);
        $commentsList =$post->comments()->where('reported', false)->orderByDesc('fixed')->orderByDesc('score')->get();
        $data["title"] = $post->getTitle();
        $data["post"] = $post;
        $user = $post->user()->get();
        $data["comments"] = $commentsList;
        if ($post->user == Auth::user()) {
            $data["allowed_ops"] = true;
        } else {
            $data["allowed_ops"] = false;
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
     * Show the form to create a new post
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
     * Show the form to edit a post
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = []; //to be sent to the view
        $data["title"] = "Edit post";
        $data["post"] = Post::findOrFail($id);

        return view('forum.edit')->with("data", $data);
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

    /**
     * Update post in storage. Users can only update their posts.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param int Post id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Post::validate($request);
        $post = Post::findOrFail($id);
        if ($post->user != Auth::user()) {
            return (401);
        }
        $post->title = $request->get('title');
        $post->content = $request->get('content');
        $post->save();
        return redirect()->route('post.show', ['id' => $id])->with('success', 'Post edited successfully!');
    }

    public function fix($post_id, $comment_id)
    {
        $post = Post::with("comments")->findOrFail($post_id);
        if ($post->user != Auth::user()) {
            return (401);
        }
        $post->comments()->update(['fixed' => false]);
        $comment = Comment::where('post_id', $post_id)->where('id', $comment_id)->first();
        $comment->setFixed(true);
        $comment->save();
        return redirect()->route('post.show', ['id' => $post_id]);
    }

    /**
     * Report a post
     * 
     * @param int Posts id
     */
    public function report(Request $request, $id){
        $post = Post::find($id);
        $post->setReported($request["reported"]);
        $post->save();
        return back();
    }
}
