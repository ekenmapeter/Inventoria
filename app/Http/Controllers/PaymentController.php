<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\SiteSetting;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Check for pending payment
        $pendingPayment = Payment::where('user_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->first();

        $allPayments = Payment::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        $monthlyDues = SiteSetting::get('monthly_dues_amount', 50.00);
        $subscriptionAmount = SiteSetting::get('subscription_amount', 100.00);
        $paymentMethods = SiteSetting::get('payment_methods', ['bank_transfer', 'cash']);

        // Get active fundraise packages
        $fundraisePackages = Package::where('type', 'fundraise')
            ->where('is_active', true)
            ->orderBy('amount')
            ->get();

        // Bank transfer details
        $bankDetails = [
            'account_name' => SiteSetting::get('bank_account_name', ''),
            'account_number' => SiteSetting::get('bank_account_number', ''),
            'bank_name' => SiteSetting::get('bank_name', ''),
            'routing_number' => SiteSetting::get('bank_routing_number', ''),
        ];

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

        return view('payments.index', compact(
            'pendingPayment',
            'allPayments',
            'monthlyDues',
            'subscriptionAmount',
            'fundraisePackages',
            'paymentMethods',
            'bankDetails',
            'nextPaymentDue'
        ));
    }

    public function store(Request $request)
    {
        // Check if user has pending payment
        $pendingPayment = Payment::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->exists();

        if ($pendingPayment) {
            return redirect()->back()
                ->withErrors(['error' => 'You have a pending payment. Please wait for it to be resolved before submitting a new one.']);
        }

        $validated = $request->validate([
            'type' => 'required|in:monthly_due,subscription,fundraise',
            'package_id' => 'required_if:type,fundraise|nullable|exists:packages,id',
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|in:bank_transfer,cash',
            'payment_proof' => 'required_if:payment_method,bank_transfer|nullable|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'notes' => 'nullable|string|max:1000',
        ]);

        // For fundraise payments, validate that the package exists and is active
        if ($validated['type'] === 'fundraise') {
            $package = Package::where('id', $validated['package_id'])
                ->where('type', 'fundraise')
                ->where('is_active', true)
                ->first();

            if (!$package) {
                return redirect()->back()
                    ->withErrors(['package_id' => 'Selected package is not available.']);
            }

            // Ensure the amount matches the package amount
            if ($validated['amount'] != $package->amount) {
                return redirect()->back()
                    ->withErrors(['amount' => 'Payment amount must match the selected package amount.']);
            }
        }

        $paymentData = [
            'user_id' => Auth::id(),
            'type' => $validated['type'],
            'package_id' => $validated['type'] === 'fundraise' ? $validated['package_id'] : null,
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ];

        // Handle payment proof upload for bank transfers
        if ($request->hasFile('payment_proof') && $validated['payment_method'] === 'bank_transfer') {
            $paymentData['payment_proof'] = $request->file('payment_proof')->store('payment-proofs', 'public');
        }

        Payment::create($paymentData);

        return redirect()->route('payments.index')
            ->with('success', 'Payment submitted successfully. Waiting for admin approval.');
    }
}
