<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartController extends Controller
{
    public function actLogin()
    {
        return view('login.login');
    }
}
