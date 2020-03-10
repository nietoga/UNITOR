<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\CommentVote;
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
            $comment->commentVotes()->delete();
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
    public function save(Request $request)
    {
        Comment::validate($request);
        Comment::create([
            'user_id' => Auth::user()->getId(),
            'description' => $request["description"],
            'post_id' => $request["post_id"]
        ]);
        $data["title"] = "Created comment";

        return back()->with('success', 'Comment created successfully!');
    }

    /**
     * Show the form to edit a comment
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = []; //to be sent to the view
        $data["title"] = "Edit comment";
        $data["comment"] = Comment::findOrFail($id);

        return view('comment.edit')->with("data", $data);
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
        $comment->setDescription($request->get('description'));
        $comment->save();
        return redirect()->route('post.show', ['id' => $comment->post->getId()])->with('success', 'Comment edited successfully!');
    }

    private function vote($id, $value, $type)
    {
        $user_id = Auth::user()->getId();
        
        $comment = Comment::find($id);
        $comment_id = $comment->getId();
        $comment_vote = CommentVote::where('user_id', $user_id)->where('comment_id', $comment_id)->first();
        $comment_score = $comment->getScore();
        if($comment_vote != null){
            $comment_vote->delete();
            $comment->setScore($comment_score-$value);
            $comment->save();
            return back();
        } else {
            CommentVote::create([
                'user_id' => $user_id,
                'comment_id' => $comment_id,
                'vote_type' => $type
            ]);
            $comment->setScore($comment_score+$value);
            $comment->save();
            return back();
        }
    }

    /**
     * Add one point to the score of a given comment
     * 
     * @param int Comment id
     */
    public function voteUp($id)
    {
        return $this->vote($id, 1, "added");
    }

    /**
     * Subtract one point to the score of a given comment
     * 
     * @param int Commnet id
     */
    public function voteDown($id)
    {
        return $this->vote($id, -1, "subtracted");
    }

    /**
     * Report a comment
     * 
     * @param int Comment id
     */
    public function report(Request $request, $id){
        $comment = Comment::find($id);
        $comment->setReported($request["reported"]);
        $comment->save();
        return back();
    }
}
