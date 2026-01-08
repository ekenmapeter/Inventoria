<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Deposits Management</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Review and manage member deposits</p>
            </div>
            <div>
                <x-button href="{{ route('admin.deposits.create') }}" variant="primary">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Deposit
                </x-button>
            </div>
        </div>

        @if($deposits->count() > 0)
            <x-card>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Member</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Payment Method</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($deposits as $deposit)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <x-user-avatar :user="$deposit->user" size="md" />
                                            <div>
                                                <div class="font-medium text-gray-900 dark:text-white">{{ $deposit->user->name }}</div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $deposit->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-lg font-bold text-gray-900 dark:text-white">₦{{ number_format($deposit->amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 capitalize">
                                        {{ str_replace('_', ' ', $deposit->payment_method) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($deposit->status === 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif($deposit->status === 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $deposit->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <x-button href="{{ route('admin.deposits.show', $deposit) }}" variant="outline" size="sm">
                                            View
                                        </x-button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $deposits->links() }}
                </div>
            </x-card>
        @else
            <x-card class="text-center py-12">
                <p class="text-gray-500 dark:text-gray-400">No deposits found.</p>
            </x-card>
        @endif
    </div>
</x-admin-layout>

