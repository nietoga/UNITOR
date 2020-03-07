<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class Comment extends Model
{
    //attributes id, description, post_id, created_at, updated_at
    protected $fillable = ['description', 'post_id', 'user_id'];

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

    public function setPostId($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    public function setUserId($user_id)
    {
        $this->attributes['user_id'] = $user_id;
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
}
