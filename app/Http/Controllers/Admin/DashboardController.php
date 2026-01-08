<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Forum;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'members' => User::count(),
            'active_members' => User::where('subscription_status', 'active')->count(),
            'pending_members' => User::where('subscription_status', 'pending')->count(),
            'suspended_members' => User::whereNotNull('suspended_until')->where('suspended_until', '>', now())->count(),
            'forums' => Forum::count(),
            'topics' => Topic::count(),
            'posts' => Post::count(),
            'pending_payments' => Payment::where('status', 'pending')->count(),
            'pending_deposits' => Deposit::where('status', 'pending')->count(),
            'total_revenue' => Payment::where('status', 'approved')->sum('amount'),
            'monthly_revenue' => Payment::where('status', 'approved')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('amount'),
            'weekly_revenue' => Payment::where('status', 'approved')
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->sum('amount'),
            'yearly_revenue' => Payment::where('status', 'approved')
                ->whereYear('created_at', now()->year)
                ->sum('amount'),
            'subscription_revenue' => Payment::where('status', 'approved')
                ->where('type', 'subscription')
                ->sum('amount'),
            'monthly_dues_revenue' => Payment::where('status', 'approved')
                ->where('type', 'monthly_due')
                ->sum('amount'),
            'packages_count' => Package::count(),
            'active_packages' => Package::where('is_active', true)->count(),
        ];

        $pendingPayments = Payment::where('status', 'pending')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        $pendingDeposits = Deposit::where('status', 'pending')
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentMembers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'pendingPayments', 'pendingDeposits', 'recentMembers'));
    }
}
