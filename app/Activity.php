<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * Mass assignable fields of Activity model
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'name',
        'grade',
        'percentage'
    ];

    /**
     * Returns current Activity id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns the name of the Activity
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets the name of the Activity
     *
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Returns the grade of the Activity
     *
     * @return float
     */
    public function getGrade() {
        return $this->grade;
    }

    /**
     * Sets the grade of the Activity
     *
     * @param float $grade
     * @return void
     */
    public function setGrade($grade) {
        $this->grade = $grade;
    }

    /**
     * Returns the percentage of the Activity
     *
     * @return float
     */
    public function getPercentage() {
        return $this->percentage;
    }

    /**
     * Sets the percentage of the Activity
     *
     * @param float $percentage
     * @return void
     */
    public function setPercentage($percentage) {
        $this->percentage = $percentage;
    }

    /**
     * Returns the Course that owns this Activity
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course() {
        return $this->belongsTo(Course::class);
    }
}
