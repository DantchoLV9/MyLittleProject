<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* Disable User To Be Loged In Requirement
        $this->middleware('auth');
        */
        //$this->middleware('verified');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (Auth::check()) {

            if (!Auth::user()->hasVerifiedEmail()) {

                return redirect()->route('verification.notice');

            }

        }

        return view('home');
    }
}
