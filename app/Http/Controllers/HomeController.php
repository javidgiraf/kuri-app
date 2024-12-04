<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\UserSubscription;
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
        $activeUsersCount = User::whereHas('customer', function($query){
            $query->where('status', true);
        })->where('is_admin', false)->count();

        $userSubscriptions = UserSubscription::with('user', 'scheme', 'deposits')->latest()->take(5)->get();

        return view('home', compact('logactivities', 'activeUsersCount', 'userSubscriptions'));
    }
}
