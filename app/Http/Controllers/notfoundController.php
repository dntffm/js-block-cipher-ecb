<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class notfoundController extends Controller
{
    
    public function notfound()
    {
        return view('notfound.notfound');
    }
}