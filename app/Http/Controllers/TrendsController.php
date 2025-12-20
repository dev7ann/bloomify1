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

        // Define week (Monday → Sunday)
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        // Fetch moods for the current week
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

        $dailyLabels = [];
        $dailyScores = [];

        // Loop through each day of the week
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dayMoods = $moods->filter(function ($mood) use ($date) {
                return Carbon::parse($mood->created_at)->isSameDay($date);
            });

            // Average mood score if exists, otherwise null (gap)
            $score = $dayMoods->isEmpty()
                ? null
                : round($dayMoods->avg(fn($mood) => $moodMap[strtolower($mood->mood)] ?? 0), 1);

            $dailyLabels[] = $date->format('D'); // Mon, Tue, Wed...
            $dailyScores[] = $score;
        }

        return view('trends.partial.index', [
            'dailyLabels' => $dailyLabels,
            'dailyScores' => $dailyScores
        ]);
    }
}
