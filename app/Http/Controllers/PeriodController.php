<?php

namespace App\Http\Controllers;

use App\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['periods'] = Auth::user()->periods;
        return view('period.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        return view('period.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        Period::validate($request);
        Period::create([
            'user_id' => Auth::user()->getId(),
            'name' => $request['name'],
        ]);

        return redirect()->route('period.index');
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
        $data['period'] = Period::with('courses')->findOrFail($id);

        if ($data['period']->user == Auth::user()) {
            return view('period.show')->with('data', $data);
        } else {
            return abort(401);
        }
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
        $data['period'] = Period::findOrFail($id);

        if ($data['period']->user == Auth::user()) {
            return view('period.edit')->with('data', $data);
        } else {
            return abort(401);
        }
    }

    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Period::validate($request);
        $period = Period::findOrFail($id);

        if ($period->user == Auth::user()) {
            $period->setName($request['name']);
            $period->save();
            return redirect()->route('period.show', $id);
        } else {
            return abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $period = Period::findOrFail($id);

        if ($period->user == Auth::user()) {
            Period::destroy($id);
            return back();
        } else {
            return abort(401);
        }
    }
}
