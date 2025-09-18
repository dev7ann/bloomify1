<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WellnessController extends Controller
{
    public function index ()
    {
        return view ('wellness.index'); 
    }
}
