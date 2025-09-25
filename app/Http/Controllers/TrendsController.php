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
        // Fetch moods for the past 28 days
        $moods = Mood::where('user_id', $userId)
            ->where('created_at', '>=', Carbon::now()->subDays(28))
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

        // Prepare daily mood scores
        $dailyScores = [];
        $dailyLabels = [];
        $currentDate = Carbon::now()->startOfDay();
        for ($i = 27; $i >= 0; $i--) {
            $date = $currentDate->copy()->subDays($i);
            $dayMoods = $moods->filter(function ($mood) use ($date) {
                return Carbon::parse($mood->created_at)->startOfDay()->equalTo($date);
            });
            $score = $dayMoods->isEmpty() ? 0 : $dayMoods->avg(function ($mood) use ($moodMap) {
                return $moodMap[strtolower($mood->mood)] ?? 0;
            });
            $dailyScores[] = round($score, 1);
            $dailyLabels[] = $date->format('M d');
        }

        // Debug: Check if data exists
        if (empty($dailyScores) || array_sum($dailyScores) == 0) {
            \Log::info('No mood data for user ' . $userId . ': ', $dailyScores);
        }

        return view('trends.partial.index', [
            'dailyScores' => $dailyScores,
            'dailyLabels' => $dailyLabels
        ]);
    }
}