<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use Carbon\Carbon;

class TrendsController extends Controller
{
    public function partialIndex()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Not authenticated'], 403);
        }

        $userId = Auth::id();

        // Get moods for the current week (Monday–Sunday)
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $moods = Mood::where('user_id', $userId)
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->orderBy('created_at')
            ->get();

        // Map moods to numeric scores
        $moodMap = [
            'happy' => 5,
            'calm' => 4,
            'excited' => 3,
            'anxious' => 2,
            'sad' => 1
        ];

        // Prepare daily averages for each day of the week
        $dailyScores = [];
        $dailyLabels = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dayMoods = $moods->filter(function ($mood) use ($date) {
                return Carbon::parse($mood->created_at)->isSameDay($date);
            });

            $score = $dayMoods->isEmpty()
                ? 0
                : $dayMoods->avg(fn($mood) => $moodMap[strtolower($mood->mood)] ?? 0);

            $dailyScores[] = round($score, 1);
            $dailyLabels[] = $date->format('D'); // Mon, Tue, Wed...
        }

        return view('trends.partial.index', [
            'dailyScores' => $dailyScores,
            'dailyLabels' => $dailyLabels
        ]);
    }
}
