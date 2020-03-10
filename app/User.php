<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Returns User id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns User name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Returns the periods this user possesses
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function periods() {
        return $this->hasMany(Period::class);
    }

    /**
     * Returns the posts this user wrote
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts() {
        return $this->hasMany(Post::class);
    }

    /**
     * Returns the comments this user wrote
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    /**
     * Returns the votes this user has done
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentVotes() {
        return $this->hasMany(CommentVote::class);
    }

    public function isAdmin() {
        return $this->type === User::ADMIN_TYPE;
    }
}
