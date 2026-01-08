<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                    <a href="{{ route('admin.payments.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Payments</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span>Payment Details</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Payment Details</h1>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Payment Information -->
            <x-card>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Payment Information</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Payment Type</p>
                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ $payment->isMonthlyDue() ? 'Monthly Dues' : 'Subscription' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Amount</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">₦{{ number_format($payment->amount, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Payment Method</p>
                        <p class="font-semibold text-gray-900 dark:text-white capitalize">
                            {{ str_replace('_', ' ', $payment->payment_method) }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Status</p>
                        @if($payment->status === 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif($payment->status === 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Date</p>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $payment->created_at->format('F d, Y g:i A') }}</p>
                    </div>
                    @if($payment->approved_at)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Approved Date</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $payment->approved_at->format('F d, Y g:i A') }}</p>
                        </div>
                    @endif
                    @if($payment->admin)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Processed By</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $payment->admin->name }}</p>
                        </div>
                    @endif
                    @if($payment->notes)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Notes</p>
                            <p class="text-gray-700 dark:text-gray-300">{{ $payment->notes }}</p>
                        </div>
                    @endif
                </div>
            </x-card>

            <!-- Member Information -->
            <x-card>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Member Information</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <x-user-avatar :user="$payment->user" size="lg" />
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $payment->user->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $payment->user->email }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Subscription Status</p>
                        <span class="badge {{ $payment->user->subscription_status === 'active' ? 'badge-success' : 'badge-warning' }} capitalize">
                            {{ $payment->user->subscription_status }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Role</p>
                        <span class="badge badge-primary capitalize">{{ $payment->user->role }}</span>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Payment Proof -->
        @if($payment->payment_proof)
            <x-card>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Payment Proof</h3>
                <div class="space-y-4">
                    @php
                        $extension = pathinfo($payment->payment_proof, PATHINFO_EXTENSION);
                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                    @endphp

                    @if($isImage)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-gray-50 dark:bg-gray-800">
                            <img src="{{ Storage::url($payment->payment_proof) }}" alt="Payment Proof" class="max-w-full h-auto rounded-lg">
                        </div>
                    @else
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 bg-gray-50 dark:bg-gray-800">
                            <div class="flex items-center gap-3">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white">Payment Proof Document</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ basename($payment->payment_proof) }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <a href="{{ Storage::url($payment->payment_proof) }}" target="_blank" class="btn btn-outline">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View Full Size / Download
                    </a>
                </div>
            </x-card>
        @endif

        @if($payment->status === 'pending')
            <x-card class="border-l-4 border-l-yellow-500">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Actions</h3>
                <div class="space-y-4">
                    <form method="POST" action="{{ route('admin.payments.approve', $payment) }}" onsubmit="return confirm('Are you sure you want to approve this payment? This will activate the member\'s subscription and send an email notification.');">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="approve_notes" :value="__('Notes (optional)')" />
                            <textarea
                                id="approve_notes"
                                name="notes"
                                rows="3"
                                class="input w-full"
                                placeholder="Add any notes about this approval..."
                            >{{ old('notes', $payment->notes) }}</textarea>
                        </div>
                        <x-button type="submit" variant="primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Approve Payment
                        </x-button>
                    </form>

                    <form method="POST" action="{{ route('admin.payments.reject', $payment) }}" onsubmit="return confirm('Are you sure you want to reject this payment? An email notification will be sent to the member.');">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="reject_reason" :value="__('Rejection Reason')" />
                            <textarea
                                id="reject_reason"
                                name="reason"
                                rows="3"
                                class="input w-full"
                                placeholder="Please provide a reason for rejection..."
                                required
                            >{{ old('reason') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">This reason will be included in the email notification to the member.</p>
                        </div>
                        <x-button type="submit" variant="danger">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reject Payment
                        </x-button>
                    </form>
                </div>
            </x-card>
        @endif
    </div>
</x-admin-layout>
