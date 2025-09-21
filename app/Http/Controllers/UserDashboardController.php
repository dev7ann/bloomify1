<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Fetch moods for the past 4 weeks
        $moods = Mood::where('user_id', Auth::id())
            ->where('created_at', '>=', Carbon::now()->subWeeks(4))
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

        // Group by week and calculate average mood score per week
        $weekScores = [];
        $weekLabels = [];
        $currentWeek = Carbon::now()->startOfWeek();
        for ($i = 3; $i >= 0; $i--) {
            $weekStart = $currentWeek->copy()->subWeeks($i);
            $weekEnd = $weekStart->copy()->endOfWeek();
            $weekMoods = $moods->filter(function ($mood) use ($weekStart, $weekEnd) {
                return Carbon::parse($mood->created_at)->between($weekStart, $weekEnd);
            });
            $averageScore = $weekMoods->isEmpty() ? 0 : $weekMoods->avg(function ($mood) use ($moodMap) {
                return $moodMap[strtolower($mood->mood)] ?? 0;
            });
            $weekScores[] = round($averageScore, 1);
            $weekLabels[] = $weekStart->format('M d');
        }

        return view('dashboard', [
            'weekScores' => $weekScores,
            'weekLabels' => $weekLabels
        ]);
    }
}