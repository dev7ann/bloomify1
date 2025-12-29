<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Mood;
use Carbon\Carbon;
use App\Models\WellnessTip;


class UserDashboardController extends Controller
{
    public function index()
    {
        // Fetch moods for the past 28 days
        $moods = Mood::where('user_id', Auth::id())
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

        $wellnessTip = WellnessTip::inRandomOrder()->first();

        return view('dashboard', [
            'dailyScores' => $dailyScores,
            'dailyLabels' => $dailyLabels,
            'wellnessTip' => $wellnessTip
        ]);

    }

    public function trendsPartial()
{
    $userId = Auth::id();

    $moods = Mood::where('user_id', $userId)
        ->where('created_at', '>=', Carbon::now()->subDays(6)) // last 7 days including today
        ->orderBy('created_at')
        ->get();

    $moodMap = [
        'happy' => 5,
        'calm' => 4,
        'excited' => 3,
        'anxious' => 2,
        'sad' => 1
    ];

    $dailyScores = [];
    $dailyLabels = [];
    $today = Carbon::now()->startOfDay();

    for ($i = 6; $i >= 0; $i--) {
        $date = $today->copy()->subDays($i);
        $dayMoods = $moods->filter(function ($mood) use ($date) {
            return Carbon::parse($mood->created_at)->startOfDay()->equalTo($date);
        });

        $score = $dayMoods->isEmpty() 
            ? 0 
            : $dayMoods->avg(fn($mood) => $moodMap[strtolower($mood->mood)] ?? 0);

        $dailyScores[] = round($score, 1);
        $dailyLabels[] = $date->format('D'); // Mon, Tue...
    }

    return view('trends.partial.index', [
        'dailyScores' => $dailyScores,
        'dailyLabels' => $dailyLabels
    ]);
}

}