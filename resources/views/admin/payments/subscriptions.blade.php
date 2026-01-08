<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Subscription Payments</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Review and manage subscription payments</p>
            </div>
            <div class="flex gap-2">
                <x-button href="{{ route('admin.payments.subscriptions.create') }}" variant="primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Subscription
                </x-button>
                <x-button href="{{ route('admin.payments.monthly-dues') }}" variant="outline">
                    View Monthly Dues
                </x-button>
                <x-button href="{{ route('admin.payments.index') }}" variant="outline">
                    View All
                </x-button>
            </div>
        </div>

        @if($payments->count() > 0)
            <x-card>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Member</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Method</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($payments as $payment)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <x-user-avatar :user="$payment->user" size="md" />
                                            <div>
                                                <div class="font-medium text-gray-900 dark:text-white">{{ $payment->user->name }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $payment->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-lg font-bold text-gray-900 dark:text-white">₦{{ number_format($payment->amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 capitalize">
                                        {{ str_replace('_', ' ', $payment->payment_method) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($payment->status === 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($payment->status === 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $payment->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <x-button href="{{ route('admin.payments.show', $payment) }}" variant="outline" size="sm">
                                            View
                                        </x-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $payments->links() }}
                </div>
            </x-card>
        @else
            <x-card class="text-center py-12">
                <p class="text-gray-500 dark:text-gray-400">No subscription payments found.</p>
            </x-card>
        @endif
    </div>
</x-admin-layout>

