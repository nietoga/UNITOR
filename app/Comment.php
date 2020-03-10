<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\CommentVote;

class Comment extends Model
{
    //attributes id, description, post_id, created_at, updated_at
    protected $fillable = [
        'description',
        'post_id',
        'user_id',
        'score'
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getDescription()
    {
        return $this->attributes['description'];
    }

    public function setDescription($desc)
    {
        $this->attributes['description'] = $desc;
    }

    public function getPostId()
    {
        return $this->attributes['post_id'];
    }

    public function setPostId($post_id)
    {
        $this->attributes['post_id'] = $post_id;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function getScore()
    {
        return $this->attributes['score'];
    }

    public function setScore($score)
    {
        $this->attributes['score'] = $score;
    }

    public function isUp($user_id){
        $comment_vote = CommentVote::where('user_id', $user_id)->where('comment_id', $this->attributes['id'])->first();
        if($comment_vote !=  null){
            if($comment_vote->getVoteType() == "added"){
                return true;
            }
        }
        return false;
    }

    public function isDown($user_id){
        $comment_vote = CommentVote::where('user_id', $user_id)->where('comment_id', $this->attributes['id'])->first();
        if($comment_vote !=  null){
            if($comment_vote->getVoteType() == "subtracted"){
                return true;
            }
        }
        return false;
    }

    /**
     * Validate functions. The fields that are validated are:
     * description
     */
    public static function validate(Request $request)
    {
        $request->validate([
            "description" => "required"
        ]);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the votes this comment has
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentVotes() {
        return $this->hasMany(CommentVote::class);
    }
}
