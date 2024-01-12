<?php

namespace App\Http\Controllers\UserDashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    Public function index()
    {
        $user = User::all();
        return view('user-dashboard.index',compact('user'));
    }
}
