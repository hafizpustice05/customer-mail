<?php

namespace App\Http\Controllers\Auth\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('auth.dashboard');
    }
}
