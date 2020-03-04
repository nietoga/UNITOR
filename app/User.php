<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * Returns the post this user wrote
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post() {
        return $this->hasMany(Post::class);
    }
}
