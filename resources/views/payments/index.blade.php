<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ __('Payments & Subscriptions') }}
            </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Manage your monthly dues and subscription payments
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Payment Status Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-card class="bg-gradient-to-br from-primary-500 to-primary-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-primary-100 text-sm font-medium mb-1">Monthly Dues</p>
                        <p class="text-3xl font-bold">₦{{ number_format($monthlyDues, 2) }}</p>
                        <p class="text-primary-100 text-xs mt-1">Next due: {{ $nextPaymentDue->format('M d, Y') }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-br from-accent-500 to-accent-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-accent-100 text-sm font-medium mb-1">Subscription</p>
                        <p class="text-3xl font-bold">₦{{ number_format($subscriptionAmount, 2) }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium mb-1">Pending Payment</p>
                        <p class="text-3xl font-bold">{{ $pendingPayment ? '1' : '0' }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Pending Payment Alert -->
        @if($pendingPayment)
            <x-card class="border-l-4 border-l-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Pending Payment</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                            You have a pending {{ $pendingPayment->isMonthlyDue() ? 'monthly dues' : 'subscription' }} payment of
                            <span class="font-semibold">₦{{ number_format($pendingPayment->amount, 2) }}</span>
                            submitted on {{ $pendingPayment->created_at->format('M d, Y') }}.
                        </p>
                    </div>
                    <x-button href="#pending-payment" variant="outline">
                        View Details
                    </x-button>
                </div>
            </x-card>
        @endif

        <!-- Submit Payment Form -->
        @if(!$pendingPayment)
            <x-card>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Submit Payment</h3>
                <form method="POST" action="{{ route('payments.store') }}" enctype="multipart/form-data" class="space-y-4" id="paymentForm">
                    @csrf

                    <div>
                        <x-input-label for="type" :value="__('Payment Type')" />
                        <select id="type" name="type" class="input w-full" required onchange="updateAmount()">
                            <option value="monthly_due">Monthly Dues - ₦{{ number_format($monthlyDues, 2) }}</option>
                            <option value="subscription">Subscription - ₦{{ number_format($subscriptionAmount, 2) }}</option>
                            @if($fundraisePackages->count() > 0)
                                <optgroup label="Fundraise Packages">
                                    @foreach($fundraisePackages as $package)
                                        <option value="fundraise" data-package-id="{{ $package->id }}" data-amount="{{ $package->amount }}">
                                            {{ $package->name }} - ₦{{ number_format($package->amount, 2) }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endif
                        </select>
                        <input type="hidden" name="package_id" id="package_id" value="">
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="amount" :value="__('Amount')" />
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">₦</span>
                            <input
                                id="amount"
                                class="input w-full pl-8"
                                type="number"
                                step="0.01"
                                name="amount"
                                value="{{ $monthlyDues }}"
                                required
                                min="0.01"
                                readonly
                            />
                        </div>
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="payment_method" :value="__('Payment Method')" />
                        <select id="payment_method" name="payment_method" class="input w-full" required onchange="togglePaymentDetails()">
                            <option value="">Select payment method</option>
                            @foreach($paymentMethods as $method)
                                <option value="{{ $method }}" {{ old('payment_method') === $method ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $method)) }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                    </div>

                    <!-- Bank Transfer Details -->
                    <div id="bank_transfer_details" style="display: none;" class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                        <h4 class="font-semibold text-blue-900 dark:text-blue-300 mb-3">Bank Transfer Details</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Bank Name:</span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $bankDetails['bank_name'] ?: 'Not set' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Account Name:</span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $bankDetails['account_name'] ?: 'Not set' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Account Number:</span>
                                <span class="font-semibold text-gray-900 dark:text-white">{{ $bankDetails['account_number'] ?: 'Not set' }}</span>
                            </div>
                            @if($bankDetails['routing_number'])
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Routing Number:</span>
                                    <span class="font-semibold text-gray-900 dark:text-white">{{ $bankDetails['routing_number'] }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4">
                            <x-input-label for="payment_proof" :value="__('Upload Payment Proof')" />
                            <input
                                type="file"
                                id="payment_proof"
                                name="payment_proof"
                                accept="image/*,application/pdf"
                                class="input w-full"
                                required
                            >
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload screenshot or receipt of your bank transfer (Max 5MB)</p>
                            <x-input-error :messages="$errors->get('payment_proof')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Cash Payment Confirmation -->
                    <div id="cash_details" style="display: none;" class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-green-900 dark:text-green-300 mb-1">Cash Payment</h4>
                                <p class="text-sm text-green-800 dark:text-green-400">
                                    Please confirm the amount: <span class="font-bold" id="cash_amount_display">₦{{ number_format($monthlyDues, 2) }}</span>
                                </p>
                                <p class="text-xs text-green-700 dark:text-green-500 mt-2">
                                    Your payment will be reviewed by an administrator upon submission.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="notes" :value="__('Notes (optional)')" />
                        <textarea
                            id="notes"
                            name="notes"
                            rows="3"
                            class="input w-full"
                            placeholder="Add any additional information about your payment..."
                        >{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <x-button type="submit" variant="primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Submit Payment
                    </x-button>
                </form>

                <script>
                    function updateAmount() {
                        const typeSelect = document.getElementById('type');
                        const amountInput = document.getElementById('amount');
                        const packageIdInput = document.getElementById('package_id');
                        const cashAmountDisplay = document.getElementById('cash_amount_display');
                        const selectedOption = typeSelect.selectedOptions[0];

                        if (selectedOption.getAttribute('data-package-id')) {
                            // Fundraise package selected
                            const packageAmount = selectedOption.getAttribute('data-amount');
                            const packageId = selectedOption.getAttribute('data-package-id');

                            amountInput.value = packageAmount;
                            packageIdInput.value = packageId;
                            if (cashAmountDisplay) {
                                cashAmountDisplay.textContent = '₦' + parseFloat(packageAmount).toFixed(2);
                            }
                        } else {
                            // Monthly dues or subscription
                            const typeValue = typeSelect.value;
                            if (typeValue === 'monthly_due') {
                                amountInput.value = '{{ $monthlyDues }}';
                                packageIdInput.value = '';
                                if (cashAmountDisplay) {
                                    cashAmountDisplay.textContent = '₦{{ number_format($monthlyDues, 2) }}';
                                }
                            } else if (typeValue === 'subscription') {
                                amountInput.value = '{{ $subscriptionAmount }}';
                                packageIdInput.value = '';
                                if (cashAmountDisplay) {
                                    cashAmountDisplay.textContent = '₦{{ number_format($subscriptionAmount, 2) }}';
                                }
                            }
                        }
                    }

                    function togglePaymentDetails() {
                        const paymentMethod = document.getElementById('payment_method').value;
                        const bankDetails = document.getElementById('bank_transfer_details');
                        const cashDetails = document.getElementById('cash_details');
                        const paymentProof = document.getElementById('payment_proof');

                        // Hide all details first
                        bankDetails.style.display = 'none';
                        cashDetails.style.display = 'none';
                        paymentProof.required = false;

                        // Show relevant details
                        if (paymentMethod === 'bank_transfer') {
                            bankDetails.style.display = 'block';
                            paymentProof.required = true;
                        } else if (paymentMethod === 'cash') {
                            cashDetails.style.display = 'block';
                        }
                    }

                    // Initialize on page load
                    document.addEventListener('DOMContentLoaded', function() {
                        updateAmount();
                        togglePaymentDetails();
                    });
                </script>
            </x-card>
        @endif

        <!-- Payment History -->
        <x-card>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Payment History</h3>
            @if($allPayments->count() > 0)
                <div class="space-y-3">
                    @foreach($allPayments as $payment)
                        <div id="{{ $payment->id === $pendingPayment?->id ? 'pending-payment' : '' }}" class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg {{ $payment->id === $pendingPayment?->id ? 'border-yellow-400 bg-yellow-50 dark:bg-yellow-900/20' : '' }}">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="font-semibold text-gray-900 dark:text-white">
                                        @if($payment->type === 'fundraise')
                                            Fundraise - {{ $payment->package->name ?? 'Unknown Package' }}
                                        @elseif($payment->type === 'monthly_due')
                                            Monthly Dues
                                        @else
                                            Subscription
                                        @endif
                                    </h4>
                                    <span class="badge {{ $payment->status === 'approved' ? 'badge-success' : ($payment->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                    <p>Amount: <span class="font-semibold">₦{{ number_format($payment->amount, 2) }}</span></p>
                                    <p>Method: {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</p>
                                    <p>Date: {{ $payment->created_at->format('M d, Y g:i A') }}</p>
                                    @if($payment->approved_at)
                                        <p>Approved: {{ $payment->approved_at->format('M d, Y g:i A') }}</p>
                                    @endif
                                </div>
                            </div>
                    @if($payment->payment_proof)
                        <div class="ml-4">
                            <a href="{{ Storage::url($payment->payment_proof) }}" target="_blank" class="btn btn-outline btn-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View Proof
                            </a>
                        </div>
                    @endif
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    {{ $allPayments->links() }}
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-center py-8">No payment history yet.</p>
            @endif
        </x-card>
    </div>
</x-app-layout>
