<?php

namespace App\Http\Controllers;

use App\Course;
use App\Interfaces\BookAdvisor;
use App\Util\GogglesAdvisor;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function GuzzleHttp\json_decode;

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
        Course::validate($request, ['period_id', 'name']);
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
        $needed = round($course->howMuchDoINeed(), 2);
        $remaining = $course->remainingPercentage();

        $data = [
            'course' => $course,
            'needed' => $needed,
            'remaining' => $remaining,
            'advise' => [],
            'goggles' => [],
        ];

        if ($needed > 3.0) {
            $bookAdvisor = app(BookAdvisor::class);
            $data['advise'] = $bookAdvisor->getAdvise($course->getName());

            if (!isset($data['advise']['cover_url'])) {
                $gogglesAdvisor = new GogglesAdvisor();
                $data['goggles'] = $gogglesAdvisor->getRandomGoggles();
            }
        }

        return view('course.show')->with('data', $data);
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
        $data['course'] = Course::findOrFail($id);
        return view('course.edit')->with('data', $data);
    }

    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Course::validate($request, ['name']);
        Course::where(['id' => $id])->update($request->only([
            'name',
        ]));

        return redirect()->route('course.show', $id);
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
