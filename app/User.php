<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

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
        'name', 'email', 'password', 'avatar',
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
        return $this->attributes['id'];
    }

    /**
     * Returns User name
     *
     * @return string
     */
    public function getName() {
        return $this->attributes['name'];
    }

    /**
     * Sets the name of the User
     *
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->attributes['name'] = $name;
    }

    /**
     * Returns User email
     *
     * @return string
     */
    public function getEmail() {
        return $this->attributes['email'];
    }

    /**
     * Sets the email of the User
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email) {
        $this->attributes['email'] = $email;
    }

    /**
     * Sets the password of the User
     *
     * @param string $password
     * @return void
     */
    public function setPassword($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Returns User avatar
     *
     * @return string
     */
    public function getAvatar() {
        return $this->attributes['avatar'];
    }

    /**
     * Sets the avatar of the User
     *
     * @param string $avatar
     * @return void
     */
    public function setAvatar() {
        $this->attributes['avatar'] = "user".$this->attributes['id'].".png";
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

    /**
     * Indicates if this user is flagged as an admin
     *
     * @return boolean
     */
    public function isAdmin() {
        return $this->type === User::ADMIN_TYPE;
    }

    public static function validate($request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
    }
}
