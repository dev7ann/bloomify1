<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    // Show all moods for logged-in user
    public function index()
    {
        $moods = Mood::where('user_id', Auth::id())->latest()->get();
        return view('moods.index', compact('moods'));
    }

    // Show create form
    public function create()
    {
        return view('moods.create');
    }

    // Store new mood
    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required|string|max:255',
            'note' => 'nullable|string|max:1000',
        ]);

        Mood::create([
            'user_id' => Auth::id(),
            'mood' => $request->mood,
            'note' => $request->note,
        ]);

        return redirect()->route('moods.index')->with('success', 'Mood logged successfully!');
    }

    // Show single mood
    // Remove $this->authorize(...) lines
public function show(Mood $mood)
{
    return view('moods.show', compact('mood'));
}

public function edit(Mood $mood)
{
    return view('moods.edit', compact('mood'));
}

public function update(Request $request, Mood $mood)
{
    $request->validate([
        'mood' => 'required|string|max:255',
        'note' => 'nullable|string|max:1000',
    ]);

    $mood->update($request->only('mood', 'note'));

    return redirect()->route('moods.index')->with('success', 'Mood updated!');
}

public function destroy(Mood $mood)
{
    $mood->delete();

    return redirect()->route('moods.index')->with('success', 'Mood deleted.');
}

}
