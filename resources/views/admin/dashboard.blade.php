<x-admin-layout>
    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Admin Dashboard</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Manage your forum community</p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-card class="bg-gradient-to-br from-blue-500 to-blue-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium mb-1">Total Members</p>
                        <p class="text-3xl font-bold">{{ $stats['members'] }}</p>
                        <p class="text-blue-100 text-xs mt-1">{{ $stats['active_members'] }} active</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-br from-green-500 to-green-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium mb-1">Total Forums</p>
                        <p class="text-3xl font-bold">{{ $stats['forums'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-br from-purple-500 to-purple-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium mb-1">Total Topics</p>
                        <p class="text-3xl font-bold">{{ $stats['topics'] }}</p>
                        <p class="text-purple-100 text-xs mt-1">{{ $stats['posts'] }} posts</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-medium mb-1">Monthly Revenue</p>
                        <p class="text-3xl font-bold">₦{{ number_format($stats['monthly_revenue'], 2) }}</p>
                        <p class="text-yellow-100 text-xs mt-1">₦{{ number_format($stats['total_revenue'], 2) }} total</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </x-card>
        </div>

         <!-- Quick Actions -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <x-card class="text-center hover:scale-105 transition-transform cursor-pointer" onclick="window.location.href='{{ route('admin.forums.create') }}'">
                <div class="w-12 h-12 mx-auto mb-4 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Create Forum</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Add a new forum category</p>
            </x-card>

            <x-card class="text-center hover:scale-105 transition-transform cursor-pointer" onclick="window.location.href='{{ route('admin.packages.create') }}'">
                <div class="w-12 h-12 mx-auto mb-4 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Create Package</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Add subscription or fundraise packages</p>
            </x-card>

            <x-card class="text-center hover:scale-105 transition-transform cursor-pointer" onclick="window.location.href='{{ route('admin.users.index') }}'">
                <div class="w-12 h-12 mx-auto mb-4 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Manage Members</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">View and manage all members</p>
            </x-card>

            <x-card class="text-center hover:scale-105 transition-transform cursor-pointer" onclick="window.location.href='{{ route('admin.settings.index') }}'">
                <div class="w-12 h-12 mx-auto mb-4 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Site Settings</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Configure site settings</p>
            </x-card>

            <x-card class="text-center hover:scale-105 transition-transform cursor-pointer" onclick="window.location.href='{{ route('admin.payments.index') }}'">
                <div class="w-12 h-12 mx-auto mb-4 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Review Payments</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Approve or reject payments</p>
            </x-card>
        </div>

        <!-- Additional Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <x-card>
                <div class="text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Pending Members</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['pending_members'] }}</p>
                </div>
            </x-card>
            <x-card>
                <div class="text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Suspended Members</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['suspended_members'] }}</p>
                </div>
            </x-card>
            <x-card>
                <div class="text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Pending Payments</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['pending_payments'] }}</p>
                </div>
            </x-card>
            <x-card>
                <div class="text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Pending Deposits</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['pending_deposits'] }}</p>
                </div>
            </x-card>
        </div>

        <!-- Revenue Statistics -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-card>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Revenue Breakdown</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-green-800 dark:text-green-300">Total Revenue</p>
                            <p class="text-xs text-green-600 dark:text-green-400">All time</p>
                        </div>
                        <p class="text-xl font-bold text-green-800 dark:text-green-300">₦{{ number_format($stats['total_revenue'], 2) }}</p>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-blue-800 dark:text-blue-300">Monthly Revenue</p>
                            <p class="text-xs text-blue-600 dark:text-blue-400">This month</p>
                        </div>
                        <p class="text-xl font-bold text-blue-800 dark:text-blue-300">₦{{ number_format($stats['monthly_revenue'], 2) }}</p>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-purple-800 dark:text-purple-300">Weekly Revenue</p>
                            <p class="text-xs text-purple-600 dark:text-purple-400">This week</p>
                        </div>
                        <p class="text-xl font-bold text-purple-800 dark:text-purple-300">₦{{ number_format($stats['weekly_revenue'], 2) }}</p>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-yellow-800 dark:text-yellow-300">Yearly Revenue</p>
                            <p class="text-xs text-yellow-600 dark:text-yellow-400">This year</p>
                        </div>
                        <p class="text-xl font-bold text-yellow-800 dark:text-yellow-300">₦{{ number_format($stats['yearly_revenue'], 2) }}</p>
                    </div>
                </div>
            </x-card>

            <x-card>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Revenue by Type</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-indigo-800 dark:text-indigo-300">Subscription Revenue</p>
                            <p class="text-xs text-indigo-600 dark:text-indigo-400">Initial subscriptions</p>
                        </div>
                        <p class="text-xl font-bold text-indigo-800 dark:text-indigo-300">₦{{ number_format($stats['subscription_revenue'], 2) }}</p>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-pink-50 dark:bg-pink-900/20 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-pink-800 dark:text-pink-300">Monthly Dues Revenue</p>
                            <p class="text-xs text-pink-600 dark:text-pink-400">Recurring payments</p>
                        </div>
                        <p class="text-xl font-bold text-pink-800 dark:text-pink-300">₦{{ number_format($stats['monthly_dues_revenue'], 2) }}</p>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-teal-50 dark:bg-teal-900/20 rounded-lg">
                        <div>
                            <p class="text-sm font-medium text-teal-800 dark:text-teal-300">Packages</p>
                            <p class="text-xs text-teal-600 dark:text-teal-400">Total / Active</p>
                        </div>
                        <p class="text-xl font-bold text-teal-800 dark:text-teal-300">{{ $stats['packages_count'] }} / {{ $stats['active_packages'] }}</p>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Pending Payments -->
        @if($pendingPayments->count() > 0)
            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Pending Payments</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Require your attention</p>
                    </div>
                    <x-button href="{{ route('admin.payments.index') }}" variant="outline" size="sm">
                        View All
                    </x-button>
                </div>
                <div class="space-y-3">
                    @foreach($pendingPayments as $payment)
                        <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:border-primary-300 dark:hover:border-primary-700 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4">
                                <x-user-avatar :user="$payment->user" size="md" />
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">{{ $payment->user->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $payment->user->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">₦{{ number_format($payment->amount, 2) }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $payment->created_at->diffForHumans() }}</p>
                                </div>
                                <x-button href="{{ route('admin.payments.show', $payment) }}" variant="primary" size="sm">
                                    Review
                                </x-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-card>
        @endif

        <!-- Pending Deposits -->
        @if($pendingDeposits->count() > 0)
            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Pending Deposits</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Require your attention</p>
                    </div>
                    <x-button href="{{ route('admin.deposits.index') }}" variant="outline" size="sm">
                        View All
                    </x-button>
                </div>
                <div class="space-y-3">
                    @foreach($pendingDeposits as $deposit)
                        <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:border-primary-300 dark:hover:border-primary-700 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4">
                                <x-user-avatar :user="$deposit->user" size="md" />
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">{{ $deposit->user->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $deposit->payment_method }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-900 dark:text-white">₦{{ number_format($deposit->amount, 2) }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $deposit->created_at->diffForHumans() }}</p>
                                </div>
                                <x-button href="{{ route('admin.deposits.show', $deposit) }}" variant="primary" size="sm">
                                    Review
                                </x-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-card>
        @endif

        <!-- Recent Members -->
        @if($recentMembers->count() > 0)
            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Recent Members</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Latest registrations</p>
                    </div>
                    <x-button href="{{ route('admin.users.index') }}" variant="outline" size="sm">
                        View All
                    </x-button>
                </div>
                <div class="space-y-3">
                    @foreach($recentMembers as $member)
                        <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:border-primary-300 dark:hover:border-primary-700 hover:shadow-md transition-all">
                            <div class="flex items-center gap-4">
                                <x-user-avatar :user="$member" size="md" />
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">{{ $member->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $member->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="badge {{ $member->subscription_status === 'active' ? 'badge-success' : 'badge-warning' }} capitalize">
                                    {{ $member->subscription_status }}
                                </span>
                                <x-button href="{{ route('admin.users.show', $member) }}" variant="outline" size="sm">
                                    View
                                </x-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-card>
        @endif



    </div>
</x-admin-layout>
