<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class CommentVote extends Model
{
    //attributes id, user_id, comment_id, vote_type, created_at, updated_at
    protected $fillable = [
        'user_id',
        'comment_id',
        'vote_type',
    ];

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getCommentId()
    {
        return $this->attributes['comment_id'];
    }

    public function setCommentId($comment_id)
    {
        $this->attributes['comment_id'] = $comment_id;
    }

    public function getVoteType()
    {
        return $this->attributes['vote_type'];
    }

    public function setVoteType($vote_type)
    {
        $this->attributes['vote_type'] = $vote_type;
    }

    /**
     * Validate functions. The fields that are validated are:
     * comment_id
     */
    public static function validate(Request $request)
    {
        $request->validate([
            "user_id" => "required",
            "comment_id" => "required",
            "vote_type" => "required"
        ]);
    }

    public function comment()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
