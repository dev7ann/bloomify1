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
public function destroy(Mood $mood, Request $request)
{
    if ($mood->user_id !== Auth::id()) abort(403);

    $mood->delete();

    if ($request->ajax()) {
        return response()->json(['success' => true]);
    }

    return redirect()->route('moods.index')->with('success', 'Mood deleted.');
}

public function store(Request $request)
{
    $request->validate([
        'feeling' => 'required|string',
        'note' => 'nullable|string',
    ]);

    Mood::create([
        'user_id' => auth()->id(),
        'mood' => $request->feeling,
        'note' => $request->note,
    ]);

    // Return partial view for AJAX
    if ($request->ajax()) {
        $moods = Mood::where('user_id', auth()->id())->latest()->get();
        return response()->view('moods.partial.index', compact('moods'));
    }

    // Fallback for non-AJAX request
    return redirect()->route('moods.index')->with('success', 'Mood logged successfully!');
}


public function update(Request $request, Mood $mood)
{
    $validated = $request->validate([
        'mood' => 'required|string|max:255',
        'note' => 'nullable|string|max:500',
    ]);

    $mood->update($validated);

    // if it's an AJAX request (like from your dashboard partial)
    if ($request->ajax()) {
        return response()->json(['success' => true, 'message' => 'Mood updated successfully.']);
    }

    // if it's a normal form submission
    return redirect()->route('moods.index')->with('success', 'Mood updated successfully.');
}


public function partialIndex()
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

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