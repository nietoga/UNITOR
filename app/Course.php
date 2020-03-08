<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * Mass assignable fields of Course model
     *
     * @var array
     */
    protected $fillable = [
        'period_id',
        'name',
    ];

    /**
     * Returns current Course id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns the name of the Course
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets the name of the Course
     *
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Returns the Period that owns this Course
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function period() {
        return $this->belongsTo(Period::class);
    }

    public function activities() {
        return $this->hasMany(Course::class);
    }
}
