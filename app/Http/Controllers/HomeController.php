<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;

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
            return $this->admin();
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
        $lava = new Lavacharts; // See note below for Laravel
        $booking = $lava->DataTable();

        $booking->addStringColumn('Day')
                ->addNumberColumn('Number of People')
                ->addRow(['Monday', 100])
                ->addRow(['Tuesday', 110])
                ->addRow(['Wednesday', 90])
                ->addRow(['Thursday', 95])
                ->addRow(['Friday', 200])
                ->addRow(['Saturday', 111])
                ->addRow(['Sunday', 60]);
        $chart = $lava->AreaChart('Booking', $booking,[
            'title' => 'Booking Stats',
        ]);
        return view('admin', [
            'lava' => $lava,
            'Booking' => $chart,
        ]);
    }

}
