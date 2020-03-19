<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new(Request $request)
    {
        $data = [];
        $data['period_id'] = $request['period_id'];
        return view('course.new')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        Course::validate($request);
        Course::create($request->only([
            'period_id',
            'name',
        ]));

        return redirect()->route('period.show', $request['period_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::with('activities')->findOrFail($id);
        $needed = $course->howMuchDoINeed();
        $remaining = $course->remainingPercentage();

        $data = [
            'course' => $course,
            'needed' => $needed,
            'remaining' => $remaining,
        ];

        return view('course.show')->with('data', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Course::destroy($id);
        return back();
    }
}
