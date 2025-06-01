<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $totalUsers = User::count();
        $totalProjects = Project::count();
        $activeUsers = User::where('is_active', true)->count();

        return view('dashboard', compact('user', 'totalUsers', 'totalProjects', 'activeUsers'));
    }
}
