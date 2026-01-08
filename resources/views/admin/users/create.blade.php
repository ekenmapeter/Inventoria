<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                    <a href="{{ route('admin.users.index') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Members</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span>Create Member</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Create New Member</h1>
            </div>
        </div>

        <x-card>
            <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input
                        id="name"
                        class="input w-full"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        class="input w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input
                            id="password"
                            class="input w-full"
                            type="password"
                            name="password"
                            required
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input
                            id="password_confirmation"
                            class="input w-full"
                            type="password"
                            name="password_confirmation"
                            required
                        />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="role" :value="__('Role')" />
                        <select id="role" name="role" class="input w-full" required>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="moderator" {{ old('role') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="subscription_status" :value="__('Subscription Status')" />
                        <select id="subscription_status" name="subscription_status" class="input w-full" required>
                            <option value="pending" {{ old('subscription_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ old('subscription_status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="expired" {{ old('subscription_status') == 'expired' ? 'selected' : '' }}>Expired</option>
                            <option value="cancelled" {{ old('subscription_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <x-input-error :messages="$errors->get('subscription_status')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <x-button href="{{ route('admin.users.index') }}" variant="outline">
                        Cancel
                    </x-button>
                    <x-button type="submit" variant="primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Create Member
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-admin-layout>

