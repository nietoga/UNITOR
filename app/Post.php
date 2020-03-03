<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    //attributes id, title, content, user_id, created_at, updated_at
    protected $fillable = ['title', 'content', 'user_id'];

    // Id
    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    // Title
    public function getTitle()
    {
        return $this->attributes['title'];
    }

    public function setTitle($title)
    {
        $this->attributes['title'] = $title;
    }

    public function getContent()
    {
        return $this->attributes['content'];
    }
    public function setContent($content)
    {
        $this->attributes['content'] = $content;
    }

    /**
     * Get post author id.
     * 
     * @return int User identifier.
     */
    public function getUserId()
    {
        return $this->attributes['user_id'];
    }

    /**
     * Set post author id.
     * 
     * @param id User identifier.
     */
    public function setUserId($user_id)
    {
        $this->attributes['user_id'] = $user_id;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Validate functions. The fields that are validated are:
     * title, content
     */
    public static function validate(Request $request)
    {
        $request->validate([
            "title" => "required",
            "content" => "required"
        ]);
    }

    /**
     * Returns the User that wrote this post.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
