<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Comment extends Model
{
    //attributes id, description, post_id, created_at, updated_at
    protected $fillable = ['description', 'post_id'];
    
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
    public function setPostId($pId)
    {
        $this->attributes['post_id'] = $pId;
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
