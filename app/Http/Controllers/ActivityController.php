<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
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
        $data['course_id'] = $request['course_id'];
        return view('activity.new')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        Activity::validate($request);
        Activity::create($request->only([
            'course_id',
            'name',
            'percentage',
            'grade',
        ]));

        return redirect()->route('course.show', $request['course_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $data['activity'] = Activity::findOrFail($id);
        return view('activity.show')->with('data', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['activity'] = Activity::findOrFail($id);
        return view('activity.edit')->with('data', $data);
    }

    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Notice here is a possibly big - big mistake
        // Request should come with course_id to validate
        // That's possibly not what we desire
        Activity::validate($request);
        Activity::where(['id' => $id])->update($request->only([
            'course_id',
            'name',
        ]));

        return redirect()->route('activity.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Activity::destroy($id);
        return back();
    }
}
