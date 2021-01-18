<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeviceTypes;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $device_type = DeviceTypes::all();
        return view('home');
    }
}
