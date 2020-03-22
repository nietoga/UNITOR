<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
        'percentage',
    ];

    /**
     * Returns current Activity id
     *
     * @return int
     */
    public function getId() {
        return $this->attributes['id'];
    }

    /**
     * Returns the name of the Activity
     *
     * @return string
     */
    public function getName() {
        return $this->attributes['name'];
    }

    /**
     * Sets the name of the Activity
     *
     * @param string $name
     * @return void
     */
    public function setName($name) {
        $this->attributes['name'] = $name;
    }

    /**
     * Returns the grade of the Activity
     *
     * @return float
     */
    public function getGrade() {
        return $this->attributes['grade'];
    }

    /**
     * Sets the grade of the Activity
     *
     * @param float $grade
     * @return void
     */
    public function setGrade($grade) {
        $this->attributes['grade'] = $grade;
    }

    /**
     * Returns the percentage of the Activity
     *
     * @return float
     */
    public function getPercentage() {
        return $this->attributes['percentage'];
    }

    /**
     * Sets the percentage of the Activity
     *
     * @param float $percentage
     * @return void
     */
    public function setPercentage($percentage) {
        $this->attributes['percentage'] = $percentage;
    }

    /**
     * Returns the Course that owns this Activity
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course() {
        return $this->belongsTo(Course::class);
    }

    /**
     * Validates course_id, name, percentage and grade
     *
     * @param Request $request
     * @return void
     */
    public static function validate(Request $request) {
        $request->validate([
            'course_id' => 'required',
            'name' => 'required',
            'percentage' => 'required|numeric|min:0|max:100',
            'grade' => 'numeric|min:0|max:5',
        ]);
    }
}
