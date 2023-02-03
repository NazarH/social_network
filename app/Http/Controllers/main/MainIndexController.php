<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;

class MainIndexController extends Controller
{
    public function __invoke(){
        return view('auth.login');
    }
}
