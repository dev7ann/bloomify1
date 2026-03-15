<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Auth::user()->journals()->latest()->get();
        return view('journals.index', compact('journals'));
    }

   public function partialIndex(Request $request)
{
    $journals = Auth::user()->journals()->latest()->get();

    if ($request->ajax()) {
        return view('journals.partial.index', compact('journals'));
    }

    // fallback if someone visits directly
    return view('journals.index', compact('journals'));
}

public function partialCreate(Request $request)
{
    if ($request->ajax()) {
        return view('journals.partial.create');
    }

    // fallback if someone visits directly
    return view('journals.create');
}


   public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ]);

    Journal::create([
        'user_id' => auth()->id(),
        'title' => $validated['title'],
        'content' => $validated['content'],
    ]);

    

    // If AJAX, return partial
    if ($request->ajax()) {
        $journals = Journal::where('user_id', auth()->id())->latest()->get();
        return view('journals.partial.index', compact('journals'));
    }

    // Otherwise, do normal redirect
    return redirect()->route('journals.index')->with('success', 'Journal saved!');
}

public function update(Request $request, $id)
{
    $journal = Journal::findOrFail($id);

    $journal->update([
        'title' => $request->title,
        'content' => $request->content
    ]);

    return response()->json(['success' => true]);
}

public function editPartial($id)
{
    $journal = Journal::findOrFail($id);
    return view('journals.partial.edit', compact('journal'));
}

public function destroy($id)
{
    $journal = Journal::findOrFail($id);
    $journal->delete();

    return redirect()->back()->with('success', 'Journal entry deleted.');
}




}