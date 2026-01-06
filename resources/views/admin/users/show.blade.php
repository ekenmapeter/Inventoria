<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                    <a href="{{ route('admin.users.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Members</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span>{{ $user->name }}</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Member Details</h1>
            </div>
            <form method="POST" action="{{ route('admin.users.impersonate', $user) }}" onsubmit="return confirm('Are you sure you want to login as this member?');">
                @csrf
                <x-button type="submit" variant="outline">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Login as Member
                </x-button>
            </form>
        </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- User Information Form -->
            <div class="lg:col-span-2 space-y-6">
                <x-card>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">User Information</h3>
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="input w-full" type="text" name="name" :value="old('name', $user->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="input w-full" type="email" name="email" :value="old('email', $user->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="role" :value="__('Role')" />
                                <select id="role" name="role" class="input w-full">
                                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                                    <option value="moderator" {{ old('role', $user->role) === 'moderator' ? 'selected' : '' }}>Moderator</option>
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="subscription_status" :value="__('Subscription Status')" />
                                <select id="subscription_status" name="subscription_status" class="input w-full">
                                    <option value="pending" {{ old('subscription_status', $user->subscription_status) === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ old('subscription_status', $user->subscription_status) === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="expired" {{ old('subscription_status', $user->subscription_status) === 'expired' ? 'selected' : '' }}>Expired</option>
                                    <option value="cancelled" {{ old('subscription_status', $user->subscription_status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <x-input-error :messages="$errors->get('subscription_status')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="suspended_until" :value="__('Suspended Until (optional)')" />
                            <x-text-input id="suspended_until" class="input w-full" type="datetime-local" name="suspended_until" :value="old('suspended_until', $user->suspended_until ? $user->suspended_until->format('Y-m-d\TH:i') : '')" />
                            <x-input-error :messages="$errors->get('suspended_until')" class="mt-2" />
                        </div>

                        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                            <x-button type="submit" variant="primary">
                                Update User
                            </x-button>
                        </div>
                    </form>
                </x-card>

                <!-- Suspend/Unsuspend -->
                @if($user->suspended_until && $user->suspended_until->isFuture())
                    <x-card class="border-l-4 border-l-yellow-500">
                        <div class="flex items-start gap-3 mb-4">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <div>
                                <h4 class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">User Suspended</h4>
                                <p class="text-sm text-yellow-700 dark:text-yellow-400 mb-4">
                                    Suspended until {{ $user->suspended_until->format('M d, Y g:i A') }}
                                </p>
                                <form method="POST" action="{{ route('admin.users.unsuspend', $user) }}">
                                    @csrf
                                    <x-button type="submit" variant="primary" class="bg-green-600 hover:bg-green-700">
                                        Unsuspend User
                                    </x-button>
                                </form>
                            </div>
                        </div>
                    </x-card>
                @else
                    <x-card class="border-l-4 border-l-red-500">
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Suspend User</h4>
                        <form method="POST" action="{{ route('admin.users.suspend', $user) }}" class="space-y-4">
                            @csrf
                            <div>
                                <x-input-label for="suspend_until" :value="__('Suspend Until')" />
                                <x-text-input id="suspend_until" name="suspended_until" class="input w-full" type="datetime-local" required />
                            </div>
                            <x-button type="submit" variant="danger">
                                Suspend User
                            </x-button>
                        </form>
                    </x-card>
                @endif

                <!-- Package Assignment -->
                <x-card>
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Assigned Packages</h4>
                    @if($user->packages->count() > 0)
                        <div class="space-y-3 mb-4">
                            @foreach($user->packages as $package)
                                <div class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <div>
                                        <h5 class="font-medium text-gray-900 dark:text-white">{{ $package->name }}</h5>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">₦{{ number_format($package->amount, 2) }} • {{ ucfirst($package->type) }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Assigned: {{ $package->pivot->assigned_at->format('M d, Y') }}</p>
                                    </div>
                                    <form method="POST" action="{{ route('admin.users.remove-package', [$user, $package]) }}" onsubmit="return confirm('Remove this package from the user?')">
                                        @csrf
                                        @method('DELETE')
                                        <x-button type="submit" variant="danger" size="sm">
                                            Remove
                                        </x-button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">No packages assigned yet.</p>
                    @endif

                    <form method="POST" action="{{ route('admin.users.assign-package', $user) }}" class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        @csrf
                        <div class="flex gap-3">
                            <select name="package_id" class="flex-1 input" required>
                                <option value="">Select a package...</option>
                                @foreach(\App\Models\Package::where('is_active', true)->get() as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }} - ₦{{ number_format($package->amount, 2) }}</option>
                                @endforeach
                            </select>
                            <x-button type="submit" variant="primary">
                                Assign
                            </x-button>
                        </div>
                    </form>
                </x-card>
            </div>

            <!-- Statistics Sidebar -->
            <div class="space-y-6">
                <x-card>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Statistics</h3>
                    <div class="space-y-6">
                        <div class="text-center p-4 rounded-lg bg-primary-50 dark:bg-primary-900/20">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Topics</p>
                            <p class="text-3xl font-bold text-primary-600 dark:text-primary-400">{{ $user->topics->count() }}</p>
                        </div>
                        <div class="text-center p-4 rounded-lg bg-accent-50 dark:bg-accent-900/20">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Posts</p>
                            <p class="text-3xl font-bold text-accent-600 dark:text-accent-400">{{ $user->posts->count() }}</p>
                        </div>
                        <div class="text-center p-4 rounded-lg bg-green-50 dark:bg-green-900/20">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Payments</p>
                            <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $user->payments->count() }}</p>
                        </div>
                        <div class="text-center p-4 rounded-lg bg-purple-50 dark:bg-purple-900/20">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Moderating Forums</p>
                            <p class="text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $user->moderatedForums->count() }}</p>
                        </div>
                    </div>
                </x-card>

                @if($user->moderatedForums->count() > 0)
                    <x-card>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Moderating Forums</h4>
                        <div class="space-y-2">
                            @foreach($user->moderatedForums as $forum)
                                <div class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $forum->name }}</span>
                                    <a href="{{ route('admin.forums.edit', $forum) }}" class="text-primary-600 dark:text-primary-400 hover:underline text-xs">
                                        View
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </x-card>
                @endif
            </div>
        </div>
    </div>
</x-admin-layout>
