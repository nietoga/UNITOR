<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //attributes id, title, content, author_id, created_at, updated_at
    protected $fillable = ['title', 'content', 'author_id'];
    
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

    // Content
    public function getContent()
    {
        return $this->attributes['content'];
    }
    public function setContent($content)
    {
        $this->attributes['content'] = $content;
    }

    // Author_id
    public function getAuthorId()
    {
        return $this->attributes['author_id'];
    }
    public function setAuthorName($author_id)
    {
        $this->attributes['author_id'] = $author_id;
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Returns the User that wrote this post
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
