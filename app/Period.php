<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Period extends Model
{
    /**
     * Mass assignable fields of Period model
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
    ];

    /**
     * Returns current Period id
     *
     * @return int
     */
    public function getId() {
        return $this->attributes['id'];
    }

    /**
     * Returns the name of the Period
     *
     * @return string
     */
    public function getName() {
        return $this->attributes['name'];
    }

    /**
     * Sets the name of the Period
     *
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->attributes['name'] = $name;
    }

    /**
     * Returns the User that owns this Period
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Returns the courses belonging to this Period
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses() {
        return $this->hasMany(Course::class);
    }

    /**
     * Validates name
     *
     * @param Request $request
     * @return void
     */
    public static function validate(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);
    }

    /**
     * Event handler for periods
     *
     * @return void
     */
    public static function boot() {
        parent::boot();

        static::deleting(function ($period) {
            $period->courses()->delete();
        });
    }
}
