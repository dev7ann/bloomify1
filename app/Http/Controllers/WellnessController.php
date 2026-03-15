<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\WellnessTip;

class WellnessController extends Controller
{
    public function index()
    {
        return view('wellness.index'); // optional main page
    }

    public function partialIndex()
    {
        // Fetch latest wellness tip
        $wellnessTip = WellnessTip::latest()->first();

        return view('wellness.partial.index', compact('wellnessTip'));
    }


}
