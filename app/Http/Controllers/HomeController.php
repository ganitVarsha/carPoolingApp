<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (auth()->user()->isAdmin == 1) {
            return view('admin');
        } else {
            return view('home');
        }
    }

    /**
     * Show the application dashboard for admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin() {
        return view('admin');
    }

}
