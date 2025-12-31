<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    // public function index()
    // {
    //     $user = User::find(Auth::id());
    //     $moods = $user->moods()->latest()->get();
    //     return view('moods', compact('moods'));
    // }

    public function store(Request $request)
    {
        $request->validate([
            'feeling' => 'required|string',
            'note' => 'nullable|string',
            'mood_date' => 'required|date',
        ]);

        $user = User::find(Auth::id());
        Mood::create([
            'user_id' => $user->id,
            'feeling' => $request->feeling,
            'note' => $request->note,
            'mood_date' => $request->mood_date,
        ]);

        if ($request->ajax()) {
            $moods = $user->moods()->latest()->get();
            return view('moods.partial.index', compact('moods'));
        }

        return redirect()->route('moods.index')->with('success', 'Mood logged successfully!');
    }

public function destroy(Mood $mood, Request $request)
{
    if ($mood->user_id !== Auth::id()) abort(403);

    $mood->delete();

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('moods.index')->with('success', 'Mood deleted.');
}



    public function update(Request $request, Mood $mood)
    {
        if ($mood->user_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'feeling' => 'required|string|max:255',
            'note' => 'nullable|string|max:500',
            'mood_date' => 'required|date',
        ]);

        $mood->update($validated);

        $user = User::find(Auth::id());
        if ($request->ajax()) {
            $moods = $user->moods()->latest()->get();
            return view('moods.partial.index', compact('moods'));
        }

        return redirect()->route('moods.index')->with('success', 'Mood updated successfully.');
    }

    // Partials for AJAX loading
    public function partialIndex()
    {
        $user = User::find(Auth::id());
        $moods = $user->moods()->latest()->get();
        return view('moods.partial.index', compact('moods'));
    }

    public function partialCreate()
    {
        return view('moods.partial.create');
    }

    public function partialEdit(Mood $mood)
    {
        if ($mood->user_id !== Auth::id()) abort(403);
        return view('moods.partial.edit', compact('mood'));
    }
}
