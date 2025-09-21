<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mood;
use App\Models\Journal;
use App\Models\WellnessTip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // User stats
        $users = User::all();
        $activeUsers = User::whereNotNull('last_login_at')
            ->where('last_login_at', '>=', Carbon::now()->subDays(30))
            ->count();
        $newSignups = User::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // Mood and Journal analytics
        $totalMoods = Mood::count();
        $totalJournals = Journal::count();
        $moodTrends = Mood::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, mood, COUNT(*) as count')
            ->groupBy('month', 'mood')
            ->orderBy('month')
            ->get()
            ->groupBy('month')
            ->map(function ($group) {
                $counts = ['happy' => 0, 'calm' => 0, 'excited' => 0, 'anxious' => 0, 'sad' => 0];
                foreach ($group as $item) {
                    $counts[strtolower($item->mood)] = $item->count;
                }
                return $counts;
            })->toArray();

        // Wellness tips
        $tips = WellnessTip::with('creator')->latest()->get();

        // Platform chart data
        $signupTrends = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        return view('admin.dashboard', compact(
            'users',
            'activeUsers',
            'newSignups',
            'totalMoods',
            'totalJournals',
            'moodTrends',
            'tips',
            'signupTrends'
        ));
    }

    public function users(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.dashboard', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate(['usertype' => 'required|in:user,admin']);
        $user->update(['usertype' => $request->usertype]);
        return redirect()->route('admin.users')->with('success', 'User role updated.');
    }

    public function destroyUser(User $user)
    {
        if ($user->id !== Auth::id()) {
            $user->delete();
            return redirect()->route('admin.users')->with('success', 'User deleted.');
        }
        return redirect()->route('admin.users')->with('error', 'Cannot delete yourself.');
    }

    public function storeTip(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
        ]);

        WellnessTip::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Wellness tip added.');
    }

    public function updateTip(Request $request, WellnessTip $tip)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
        ]);

        $tip->update([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Wellness tip updated.');
    }

    public function destroyTip(WellnessTip $tip)
    {
        $tip->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Wellness tip deleted.');
    }
}