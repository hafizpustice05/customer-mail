<?php

namespace App\Http\Controllers\Auth\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('auth.post.index');
    }
}
