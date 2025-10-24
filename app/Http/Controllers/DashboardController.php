<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index', [
            'totalServices' => Service::count(),
            'finishedServices' => Service::where('status', 'finished')->count(),
            'processServices' => Service::where('status', 'process')->count(),
            'activeTechnicians' => User::where('role', 'Technician')->where('status', 'Active')->count(),
            'latestServices' => Service::with(['customer', 'laptop'])->latest()->take(5)->get(),
        ]);
    }
}
