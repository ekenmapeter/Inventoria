<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
            {{ __('Dashboard') }}
        </h2>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Welcome back, {{ $user->name }}!
            </p>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Subscription Status Alert -->
        @if(!$user->hasActiveSubscription() || $user->isSuspended())
            <x-card class="border-l-4 {{ $user->isSuspended() ? 'border-l-red-500 bg-red-50 dark:bg-red-900/20' : 'border-l-yellow-500 bg-yellow-50 dark:bg-yellow-900/20' }}">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 {{ $user->isSuspended() ? 'text-red-600 dark:text-red-400' : 'text-yellow-600 dark:text-yellow-400' }} flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h4 class="font-semibold {{ $user->isSuspended() ? 'text-red-800 dark:text-red-300' : 'text-yellow-800 dark:text-yellow-300' }} mb-1">
                            @if($user->isSuspended())
                                Account Suspended
                            @else
                                Subscription Status
                            @endif
                        </h4>
                        <p class="text-sm {{ $user->isSuspended() ? 'text-red-700 dark:text-red-400' : 'text-yellow-700 dark:text-yellow-400' }}">
                            @if($user->isSuspended())
                                Your account is suspended until {{ $user->suspended_until->format('M d, Y') }}.
                            @elseif($user->subscription_status === 'pending')
                                Your subscription is pending approval. Please wait for an administrator to review your payment.
                            @elseif($user->subscription_status === 'expired')
                                Your subscription has expired. Please renew to continue using the forum.
                            @elseif($user->subscription_status === 'cancelled')
                                Your subscription has been cancelled.
                            @endif
                        </p>
                    </div>
                </div>
            </x-card>
        @endif

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-card class="bg-gradient-to-br from-primary-500 to-primary-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-primary-100 text-sm font-medium mb-1">Total Topics</p>
                        <p class="text-3xl font-bold">{{ $user->topics->count() }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-br from-accent-500 to-accent-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-accent-100 text-sm font-medium mb-1">Total Replies</p>
                        <p class="text-3xl font-bold">{{ $user->posts->count() }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                </div>
            </x-card>

            <x-card class="bg-gradient-to-br from-green-500 to-green-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium mb-1">Subscription</p>
                        <p class="text-lg font-bold capitalize">{{ $user->subscription_status }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
            </x-card>


            <x-card class="bg-gradient-to-br from-purple-500 to-purple-600 text-white border-0">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium mb-1">Pending Payments</p>
                        <p class="text-3xl font-bold">{{ $pendingPayments }}</p>
                        <p class="text-orange-100 text-xs mt-1">₦{{ number_format($monthlyDues, 2) }} monthly</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Payment Status & Next Payment Due -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Payment Status -->
            @if($pendingPayment)
                <x-card class="border-l-4 border-l-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Pending Payment</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                You have a pending {{ $pendingPayment->isMonthlyDue() ? 'monthly dues' : 'subscription' }} payment of
                                <span class="font-semibold">₦{{ number_format($pendingPayment->amount, 2) }}</span>
                                awaiting approval.
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Submitted: {{ $pendingPayment->created_at->format('M d, Y g:i A') }}
                            </p>
                        </div>
                        <x-button href="{{ route('payments.index') }}" variant="outline">
                            View Payment
                        </x-button>
                    </div>
                </x-card>
            @elseif(!$user->hasActiveSubscription())
                <x-card class="border-l-4 border-l-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Payment Required</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Your subscription is not active. Please submit a payment to continue.
                            </p>
                        </div>
                        <x-button href="{{ route('payments.index') }}" variant="primary">
                            Make Payment
                        </x-button>
                    </div>
                </x-card>
            @endif

            <!-- Next Payment Due -->
            <x-card class="border-l-4 border-l-primary-500">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Next Payment Due</h3>
                    <p class="text-2xl font-bold text-primary-600 dark:text-primary-400 mb-2">
                        {{ $nextPaymentDue->format('M d, Y') }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Monthly Dues: ₦{{ number_format($monthlyDues, 2) }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        {{ $nextPaymentDue->diffForHumans() }}
                    </p>
                </div>
            </x-card>
        </div>

        <!-- Payment History -->
        <x-card>
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Payment History</h3>
                <x-button href="{{ route('payments.index') }}" variant="outline" size="sm">
                    View All
                </x-button>
            </div>
            @if($paymentHistory->count() > 0)
                <div class="space-y-3">
                    @foreach($paymentHistory as $payment)
                        <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:border-primary-300 dark:hover:border-primary-700 hover:shadow-md transition-all">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h4 class="font-semibold text-gray-900 dark:text-white">
                                        {{ $payment->isMonthlyDue() ? 'Monthly Dues' : 'Subscription' }}
                                    </h4>
                                    <span class="badge {{ $payment->status === 'approved' ? 'badge-success' : ($payment->status === 'rejected' ? 'badge-danger' : 'badge-warning') }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                    <p>Amount: <span class="font-semibold">₦{{ number_format($payment->amount, 2) }}</span> •
                                       Method: {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</p>
                                    <p>Date: {{ $payment->created_at->format('M d, Y g:i A') }}</p>
                                    @if($payment->approved_at)
                                        <p class="text-green-600 dark:text-green-400">Approved: {{ $payment->approved_at->format('M d, Y g:i A') }}</p>
                                    @endif
                                </div>
                            </div>
                            @if($payment->payment_proof)
                                <div class="ml-4">
                                    <a href="{{ Storage::url($payment->payment_proof) }}" target="_blank" class="btn btn-outline btn-sm">
                                        View Proof
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 text-center py-8">No payment history yet.</p>
            @endif
        </x-card>

        <!-- Available Packages -->
        @if($packages->count() > 0)
            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Available Packages</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($packages as $package)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-primary-300 dark:hover:border-primary-700 hover:shadow-md transition-all">
                            <div class="flex items-start justify-between mb-2">
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $package->name }}</h4>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $package->type === 'subscription' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' }}">
                                    {{ ucfirst($package->type) }}
                                </span>
                            </div>
                            @if($package->description)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($package->description, 80) }}</p>
                            @endif
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-primary-600 dark:text-primary-400">₦{{ number_format($package->amount, 2) }}</span>
                                <x-button href="{{ route('payments.index') }}" variant="outline" size="sm">
                                    Subscribe
                                </x-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-card>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Topics -->
            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Topics</h3>
                    <a href="{{ route('home') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:underline">
                        View All
                    </a>
                </div>
                @if($topics->count() > 0)
                    <div class="space-y-4">
                        @foreach($topics as $topic)
                            <div class="group border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-primary-300 dark:hover:border-primary-700 hover:shadow-md transition-all duration-200">
                                <a href="{{ route('topics.show', $topic) }}" class="block">
                                    <h4 class="font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                        {{ $topic->title }}
                                    </h4>
                                    <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $topic->created_at->diffForHumans() }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                            {{ $topic->posts->count() }} replies
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <svg class="mx-auto h-12 w-12 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p>You haven't created any topics yet.</p>
                        <x-button href="{{ route('home') }}" variant="primary" size="sm" class="mt-4">
                            Browse Forums
                        </x-button>
                    </div>
                @endif
            </x-card>

            <!-- Recent Replies -->
            <x-card>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Replies</h3>
                </div>
                @if($posts->count() > 0)
                    <div class="space-y-4">
                        @foreach($posts as $post)
                            <div class="group border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-primary-300 dark:hover:border-primary-700 hover:shadow-md transition-all duration-200">
                                <a href="{{ route('topics.show', $post->topic) }}" class="block">
                                    <h4 class="font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                        Re: {{ Str::limit($post->topic->title, 50) }}
                                    </h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 line-clamp-2">
                                        {{ Str::limit(strip_tags($post->body), 100) }}
                                    </p>
                                    <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            {{ $post->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <svg class="mx-auto h-12 w-12 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        <p>You haven't posted any replies yet.</p>
            </div>
                @endif
            </x-card>
        </div>
    </div>
</x-app-layout>
