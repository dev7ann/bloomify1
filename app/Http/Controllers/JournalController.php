<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::where('user_id', Auth::id())->latest()->get();
        return view('journals.index', compact('journals'));
    }

    public function create()
    {
        return view('journals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Journal::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('journals.index')->with('success', 'Journal entry added!');
    }
}
