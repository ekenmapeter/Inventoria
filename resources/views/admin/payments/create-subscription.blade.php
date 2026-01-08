<x-admin-layout>
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                    <a href="{{ route('admin.payments.subscriptions') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition-colors">Subscriptions</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span>Add Subscription</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Add Subscription Payment</h1>
            </div>
        </div>

        <x-card>
            <form method="POST" action="{{ route('admin.payments.subscriptions.store') }}" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="user_id" :value="__('Member')" />
                    <select id="user_id" name="user_id" class="input w-full" required>
                        <option value="">Select a member</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="amount" :value="__('Amount')" />
                    <x-text-input
                        id="amount"
                        class="input w-full"
                        type="number"
                        step="0.01"
                        name="amount"
                        :value="old('amount', $subscriptionAmount)"
                        required
                    />
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Default subscription amount: ₦{{ number_format($subscriptionAmount, 2) }}</p>
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="payment_method" :value="__('Payment Method')" />
                    <select id="payment_method" name="payment_method" class="input w-full" required>
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method }}" {{ old('payment_method') == $method ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $method)) }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="status" :value="__('Status')" />
                    <select id="status" name="status" class="input w-full" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">If approved, the member's subscription will be activated automatically.</p>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="notes" :value="__('Notes (optional)')" />
                    <textarea
                        id="notes"
                        name="notes"
                        rows="4"
                        class="input w-full"
                        placeholder="Add any notes about this subscription payment..."
                    >{{ old('notes') }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <x-button href="{{ route('admin.payments.subscriptions') }}" variant="outline">
                        Cancel
                    </x-button>
                    <x-button type="submit" variant="primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Create Subscription
                    </x-button>
                </div>
            </form>
        </x-card>
    </div>
</x-admin-layout>

