<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getDashboard()
    {
        return view('dashboard');
    }
}
