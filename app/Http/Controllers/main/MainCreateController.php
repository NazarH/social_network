<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;

class MainCreateController extends Controller
{
    public function __invoke(){
        return view('main.register');
    }
}
