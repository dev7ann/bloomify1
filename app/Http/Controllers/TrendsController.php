<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TrendsController extends Controller
{
    public function partialIndex()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Not authenticated'], 403);
        }

        $userId = Auth::id();
           // Map moods to numeric scores
        $moodMap = [
            'happy' => 5,
            'calm' => 4,
            'excited' => 3,
            'anxious' => 2,
            'sad' => 1
        ];

        // Define week (Monday → Sunday)
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        Log::info("These are the start of week" . ' ' . $startOfWeek);
        Log::info("These are the end of week" . ' ' . $endOfWeek);

        // Fetch moods for the current week
        $moods = Mood::where('user_id', $userId)
            ->whereBetween('mood_date', [$startOfWeek, $endOfWeek])
            ->orderBy('mood_date')
            ->get();

        Log::info("These are the mood count" . ' ' . $moods->count());

        $dailyLabels = [];
        $dailyScores = [];

        // Loop through each day of the week
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $dayMoods = $moods->filter(function ($mood) use ($date) {
                return Carbon::parse($mood->mood_date)->isSameDay($date);
            });

            // Average mood score if exists, otherwise null (gap)
            $score = $dayMoods->isEmpty()
                ? null
                : round($dayMoods->avg(fn($mood) => $moodMap[strtolower($mood->feeling)] ?? 0), 1);

            $dailyLabels[] = $date->format('D'); // Mon, Tue, Wed...
            $dailyScores[] = $score;
        }

        Log::info("These are the daily labels" . ' ' . json_encode($dailyLabels));
        Log::info("These are the daily scores" . ' ' . json_encode($dailyScores));

        return view('trends.partial.index', [
            'dailyLabels' => $dailyLabels,
            'dailyScores' => $dailyScores
        ]);
    }
}
