<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        return $this->id;
    }

    /**
     * Returns the name of the Period
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets the name of the Period
     *
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Returns the User that owns this Period
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
