<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
     * Delete a comment. Users only can delete
     * their comments.
     * 
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user == Auth::user()) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully!');
        } else {
            return (401);
        }
    }

    /**
     * Store a new comment in storage
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $post_id)
    {
        Comment::validate($request);
        Comment::create([
            'user_id' => Auth::user()->getId(),
            'description' => $request["description"],
            'post_id' => $post_id
        ]);
        $data["title"] = "Created comment";

        return back()->with('success', 'Comment created successfully!');
    }

    /**
     * Update comment in storage. Users can only update their comments.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param int Comment id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Comment::validate($request);
        $comment = Comment::find($id);
        if ($comment->user != Auth::user()) {
            return (401);
        }
        $comment->title = $request->get('title');
        $comment->content = $request->get('content');
        $comment->save();
        return redirect()->route('comment.show', ['id' => $id])->with('success', 'Comment edited successfully!');
    }
}
