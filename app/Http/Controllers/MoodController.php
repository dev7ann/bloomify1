<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function index()
    {
        $moods = Auth::user()->moods()->latest()->get();
        return view('moods', compact('moods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'feeling' => 'required|string',
            'note' => 'nullable|string',
        ]);

        Mood::create([
            'user_id' => auth()->id(),
            'feeling' => $request->feeling,
            'note' => $request->note,
        ]);

        if ($request->ajax()) {
            $moods = Auth::user()->moods()->latest()->get();
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
        ]);

        $mood->update($validated);

        if ($request->ajax()) {
            $moods = Auth::user()->moods()->latest()->get();
            return view('moods.partial.index', compact('moods'));
        }

        return redirect()->route('moods.index')->with('success', 'Mood updated successfully.');
    }

    // Partials for AJAX loading
    public function partialIndex()
    {
        $moods = Auth::user()->moods()->latest()->get();
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
