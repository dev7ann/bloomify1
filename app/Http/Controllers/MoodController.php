<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoodController extends Controller
{
    public function index()
    {
        $moods = Auth::user()->moods()->latest()->paginate(10);
        return view('moods.index', compact('moods'));
    }

    public function partialIndex()
    {
        $moods = Auth::user()->moods()->latest()->paginate(10);
        return view('moods.partial.index', compact('moods'));
    }

    public function create()
    {
        return view('moods.create');
    }

    public function partialCreate()
    {
        return view('moods.partial.create');
    }

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

    public function show(Mood $mood)
    {
        if ($mood->user_id !== Auth::id()) abort(403);
        return view('moods.show', compact('mood'));
    }

    public function partialShow(Mood $mood)
    {
        if ($mood->user_id !== Auth::id()) abort(403);
        return view('moods.partial.show', compact('mood'));
    }

    public function edit(Mood $mood)
    {
        if ($mood->user_id !== Auth::id()) abort(403);
        return view('moods.edit', compact('mood'));
    }

    public function partialEdit(Mood $mood)
    {
        if ($mood->user_id !== Auth::id()) abort(403);
        return view('moods.partial.edit', compact('mood'));
    }

    public function update(Request $request, Mood $mood)
    {
        if ($mood->user_id !== Auth::id()) abort(403);
        $request->validate([
            'mood' => 'required|string|max:255',
            'note' => 'nullable|string|max:1000',
        ]);

        $mood->update($request->only('mood', 'note'));

        return redirect()->route('moods.index')->with('success', 'Mood updated!');
    }

    public function destroy(Mood $mood)
    {
        if ($mood->user_id !== Auth::id()) abort(403);
        $mood->delete();

        return redirect()->route('moods.index')->with('success', 'Mood deleted.');
    }
}