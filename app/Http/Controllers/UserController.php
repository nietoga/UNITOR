<?php

namespace App\Http\Controllers;

use App\Interfaces\ImageStorage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        return view('user.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        return view('user.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        User::validate($request);
        User::create([
            'user_id' => Auth::user()->getId(),
            'name' => $request['name'],
        ]);

        return redirect()->route('user.index');
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
        $data['user'] = User::findOrFail($id);

        if ($data['user'] == Auth::user()) {
            return view('user.show')->with('data', $data);
        } else {
            return abort(401);
        }
    }

    /**
     * Edit the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $data['user'] = User::findOrFail($id);

        if ($data['user'] == Auth::user()) {
            return view('user.edit')->with('data', $data);
        } else {
            return abort(401);
        }
    }

    /**
     * Edit profile photo of the specified user.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editProfilePhoto($id)
    {
        $data = [];
        $data['user'] = User::findOrFail($id);

        if ($data['user'] == Auth::user()) {
            return view('user.edit_pp')->with('data', $data);
        } else {
            return abort(401);
        }
    }

    /**
     * Upload a image for the User
     *
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $user = User::findOrFail($request['user_id']);
        $storeInterface = app(ImageStorage::class);

        if ($user == Auth::user()) {
            $user->setAvatar();
            $storeInterface->store($request);
            $user->save();
            return back()->with('success', 'Image uploaded correctly');
        } else {
            return abort(401);
        }
    }

    /**
     * Update resource in storage.
     * 
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::validate($request);
        $user = User::findOrFail($id);

        if ($user == Auth::user()) {
            if($request['password'] != null){
                if($request['password'] != $request['password_confirmation']){
                    return back()->with('confirmation_error','Passwords must match');
                }else{
                    $user->setPassword($request['password']);
                }
            }
            $user->save();
            return redirect()->route('user.show', $id);
        } else {
            return abort(401);
        }
    }
}
