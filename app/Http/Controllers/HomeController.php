<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class HomeController extends Controller
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
     * Change the language use in the app
     * 
     * @param string Language indenfication
     */
    public function lang($locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        session()->put('module', 'app');
        return view('home');
    }

    /**
     * Show the forum main page.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function forum()
    {
        session()->put('module', 'forum');
        return view('forum.main');
    }
}
