<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // index view
    public function index(){
        return view('pages.dashboard.index');
    }
}
