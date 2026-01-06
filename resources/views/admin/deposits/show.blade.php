<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                    <a href="{{ route('admin.deposits.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Deposits</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span>Deposit Details</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Deposit Details</h1>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Deposit Information -->
            <x-card>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Deposit Information</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Amount</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">₦{{ number_format($deposit->amount, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Payment Method</p>
                        <p class="font-semibold text-gray-900 dark:text-white capitalize">{{ str_replace('_', ' ', $deposit->payment_method) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Status</p>
                        @if($deposit->status === 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif($deposit->status === 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @else
                            <span class="badge badge-warning">Pending</span>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Date</p>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $deposit->created_at->format('F d, Y g:i A') }}</p>
                    </div>
                    @if($deposit->notes)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Notes</p>
                            <p class="text-gray-700 dark:text-gray-300">{{ $deposit->notes }}</p>
                        </div>
                    @endif
                    @if($deposit->admin)
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Processed By</p>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $deposit->admin->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $deposit->approved_at->format('M d, Y g:i A') }}</p>
                        </div>
                    @endif
                </div>
            </x-card>

            <!-- Member Information -->
            <x-card>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Member Information</h3>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <x-user-avatar :user="$deposit->user" size="lg" />
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $deposit->user->name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $deposit->user->email }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Subscription Status</p>
                        <span class="badge {{ $deposit->user->subscription_status === 'active' ? 'badge-success' : 'badge-warning' }} capitalize">
                            {{ $deposit->user->subscription_status }}
                        </span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Role</p>
                        <span class="badge badge-primary capitalize">{{ $deposit->user->role }}</span>
                    </div>
                </div>
            </x-card>
        </div>

        @if($deposit->status === 'pending')
            <x-card class="border-l-4 border-l-yellow-500">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Actions</h3>
                <div class="space-y-4">
                    <form method="POST" action="{{ route('admin.deposits.approve', $deposit) }}" onsubmit="return confirm('Are you sure you want to approve this deposit? This will create a payment and activate the member\'s subscription.');">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Notes (optional)')" />
                            <textarea
                                id="notes"
                                name="notes"
                                rows="3"
                                class="input w-full"
                                placeholder="Add any notes about this approval..."
                            >{{ old('notes', $deposit->notes) }}</textarea>
                        </div>
                        <x-button type="submit" variant="primary">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Approve Deposit
                        </x-button>
                    </form>
                    <form method="POST" action="{{ route('admin.deposits.reject', $deposit) }}" onsubmit="return confirm('Are you sure you want to reject this deposit?');">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Rejection Reason (optional)')" />
                            <textarea
                                id="notes"
                                name="notes"
                                rows="3"
                                class="input w-full"
                                placeholder="Add reason for rejection..."
                            >{{ old('notes') }}</textarea>
                        </div>
                        <x-button type="submit" variant="danger">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Reject Deposit
                        </x-button>
                    </form>
                </div>
            </x-card>
        @endif
    </div>
</x-admin-layout>

