<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Package;
use App\Models\Payment;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $topics = $user->topics()->latest()->take(5)->get();
        $posts = $user->posts()->latest()->take(5)->get();

        $pendingPayment = Payment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->first();

        $pendingPayments = $pendingPayment ? 1 : 0;
        $pendingDeposits = Deposit::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        $monthlyDues = SiteSetting::get('monthly_dues_amount', 50.00);
        $subscriptionAmount = SiteSetting::get('subscription_amount', 100.00);

        // Calculate next payment due date (1st of next month)
        $lastMonthlyDue = Payment::where('user_id', $user->id)
            ->where('type', 'monthly_due')
            ->where('status', 'approved')
            ->latest()
            ->first();

        if ($lastMonthlyDue && $lastMonthlyDue->approved_at) {
            // Get the first of the month after the last approved payment
            $nextPaymentDue = $lastMonthlyDue->approved_at->copy()->addMonth()->startOfMonth();
        } else {
            // If no payment exists, get the first of next month from today
            $nextPaymentDue = now()->addMonth()->startOfMonth();
        }

        // If the calculated date is in the past (shouldn't happen, but just in case), use next month
        if ($nextPaymentDue->isPast()) {
            $nextPaymentDue = now()->addMonth()->startOfMonth();
        }

        // Get payment history
        $paymentHistory = Payment::where('user_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        // Get available packages
        $packages = Package::where('is_active', true)->get();

        return view('dashboard', compact(
            'user',
            'topics',
            'posts',
            'pendingPayment',
            'pendingPayments',
            'pendingDeposits',
            'monthlyDues',
            'subscriptionAmount',
            'nextPaymentDue',
            'paymentHistory',
            'packages'
        ));
    }
}
