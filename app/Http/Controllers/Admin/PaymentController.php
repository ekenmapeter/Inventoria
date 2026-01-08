<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Notifications\PaymentApproved;
use App\Notifications\PaymentRejected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'monthly_due'); // monthly_due or subscription

        $payments = Payment::where('type', $type)
            ->with(['user', 'admin'])
            ->latest()
            ->paginate(20);

        return view('admin.payments.index', compact('payments', 'type'));
    }

    public function monthlyDues()
    {
        $payments = Payment::where('type', 'monthly_due')
            ->with(['user', 'admin'])
            ->latest()
            ->paginate(20);

        return view('admin.payments.monthly-dues', compact('payments'));
    }

    public function subscriptions()
    {
        $payments = Payment::where('type', 'subscription')
            ->with(['user', 'admin'])
            ->latest()
            ->paginate(20);

        return view('admin.payments.subscriptions', compact('payments'));
    }

    public function createSubscription()
    {
        $users = \App\Models\User::where('role', 'user')->orderBy('name')->get();
        $subscriptionAmount = \App\Models\SiteSetting::get('subscription_amount', 100.00);
        $paymentMethods = \App\Models\SiteSetting::get('payment_methods', ['bank_transfer', 'cash']);

        return view('admin.payments.create-subscription', compact('users', 'subscriptionAmount', 'paymentMethods'));
    }

    public function storeSubscription(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|in:bank_transfer,cash',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $paymentData = [
            'user_id' => $validated['user_id'],
            'type' => 'subscription',
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status'],
        ];

        if ($validated['status'] === 'approved') {
            $paymentData['admin_id'] = Auth::id();
            $paymentData['approved_at'] = now();

            // Update user subscription status
            $user = \App\Models\User::find($validated['user_id']);
            $user->update(['subscription_status' => 'active']);
        }

        Payment::create($paymentData);

        return redirect()->route('admin.payments.subscriptions')
            ->with('success', 'Subscription payment created successfully.');
    }

    public function createMonthlyDue()
    {
        $users = \App\Models\User::where('role', 'user')->orderBy('name')->get();
        $monthlyDuesAmount = \App\Models\SiteSetting::get('monthly_dues_amount', 50.00);
        $paymentMethods = \App\Models\SiteSetting::get('payment_methods', ['bank_transfer', 'cash']);

        return view('admin.payments.create-monthly-due', compact('users', 'monthlyDuesAmount', 'paymentMethods'));
    }

    public function storeMonthlyDue(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|in:bank_transfer,cash',
            'notes' => 'nullable|string|max:1000',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $paymentData = [
            'user_id' => $validated['user_id'],
            'type' => 'monthly_due',
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'] ?? null,
            'status' => $validated['status'],
        ];

        if ($validated['status'] === 'approved') {
            $paymentData['admin_id'] = Auth::id();
            $paymentData['approved_at'] = now();

            // Update user subscription status
            $user = \App\Models\User::find($validated['user_id']);
            $user->update(['subscription_status' => 'active']);
        }

        Payment::create($paymentData);

        return redirect()->route('admin.payments.monthly-dues')
            ->with('success', 'Monthly dues payment created successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load(['user', 'admin']);

        return view('admin.payments.show', compact('payment'));
    }

    public function approve(Request $request, Payment $payment)
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $payment->update([
            'status' => 'approved',
            'admin_id' => Auth::id(),
            'approved_at' => now(),
            'notes' => $request->notes ?? $payment->notes,
        ]);

        // Update user subscription status
        $payment->user->update([
            'subscription_status' => 'active',
        ]);

        // Send email notification
        $payment->user->notify(new PaymentApproved($payment));

        $paymentType = $payment->isMonthlyDue() ? 'monthly dues' : 'subscription';

        return redirect()->back()
            ->with('success', ucfirst($paymentType) . ' payment approved and email notification sent!');
    }

    public function reject(Request $request, Payment $payment)
    {
        $request->validate([
            'reason' => 'nullable|string|max:1000',
        ]);

        $payment->update([
            'status' => 'rejected',
            'admin_id' => Auth::id(),
            'notes' => $request->reason ?? $payment->notes,
        ]);

        // Send email notification
        $payment->user->notify(new PaymentRejected($payment, $request->reason));

        $paymentType = $payment->isMonthlyDue() ? 'monthly dues' : 'subscription';

        return redirect()->back()
            ->with('success', ucfirst($paymentType) . ' payment rejected and email notification sent!');
    }
}
