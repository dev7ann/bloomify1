<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
public function index()
{
    $moods = Auth::user()->moods()->latest()->get(); // No pagination for simplicity
    return view('moods', compact('moods'));
}

public function show(Mood $mood)
{
    if ($mood->user_id !== Auth::id()) abort(403);
    return response()->json([
        'feeling' => $mood->feeling,
        'note' => $mood->note,
        'created_at' => $mood->created_at,
    ]);
}
public function dashboard(Request $request)
{
    $view = $request->query('view', 'index'); // default to index
    $id = $request->query('id');

    $moods = Mood::all();

    $mood = null;
    if ($id) {
        $mood = Mood::find($id);
    }

    return view('moods', [
        'view' => $view,
        'moods' => $moods,
        'mood' => $mood
    ]);
}

}