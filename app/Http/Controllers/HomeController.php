<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogActivityService;

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
    public function index(LogActivityService $logActivityService)
    {
        $logactivities = $logActivityService->getlogActivities();
        return view('home', compact('logactivities'));
    }
}
