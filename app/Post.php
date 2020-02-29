<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //attributes id, name, price, created_at, updated_at
    protected $fillable = ['title', 'content', 'author_name'];
    
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

    // Author_name
    public function getAuthorName()
    {
        return $this->attributes['author_name'];
    }
    public function setAuthorName($author_name)
    {
        $this->attributes['author_name'] = $author_name;
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
