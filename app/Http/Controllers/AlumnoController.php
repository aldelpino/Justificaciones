<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
class AlumnoController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::Debug($request->session()->all());
        Log::Debug(auth()->user());
        return view('alumno/index');
    }
}
