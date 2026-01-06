<x-admin-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Site Settings</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Configure site name, logo, SMTP, and payment settings</p>
        </div>

        <x-card>
            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Site Information -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">Site Information</h3>

                    <div>
                        <x-input-label for="site_name" :value="__('Site Name')" class="text-base font-semibold mb-2" />
                        <x-text-input
                            id="site_name"
                            class="input w-full"
                            type="text"
                            name="site_name"
                            :value="old('site_name', $settings['site_name'] ?? config('app.name'))"
                            required
                        />
                        <x-input-error :messages="$errors->get('site_name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="site_logo" :value="__('Site Logo')" class="text-base font-semibold mb-2" />
                        @if($settings['site_logo'] ?? null)
                            <div class="mb-2">
                                <img src="{{ Storage::url($settings['site_logo']) }}" alt="Site Logo" class="h-20 w-auto">
                            </div>
                        @endif
                        <input
                            type="file"
                            id="site_logo"
                            name="site_logo"
                            accept="image/*"
                            class="input w-full"
                        >
                        <x-input-error :messages="$errors->get('site_logo')" class="mt-2" />
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload a logo for your site (max 2MB)</p>
                    </div>
                </div>

                <!-- SMTP Settings -->
                <div class="space-y-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">SMTP Settings</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="smtp_host" :value="__('SMTP Host')" />
                            <x-text-input
                                id="smtp_host"
                                class="input w-full"
                                type="text"
                                name="smtp_host"
                                :value="old('smtp_host', $settings['smtp_host'] ?? '')"
                            />
                        </div>

                        <div>
                            <x-input-label for="smtp_port" :value="__('SMTP Port')" />
                            <x-text-input
                                id="smtp_port"
                                class="input w-full"
                                type="text"
                                name="smtp_port"
                                :value="old('smtp_port', $settings['smtp_port'] ?? '587')"
                            />
                        </div>

                        <div>
                            <x-input-label for="smtp_username" :value="__('SMTP Username')" />
                            <x-text-input
                                id="smtp_username"
                                class="input w-full"
                                type="text"
                                name="smtp_username"
                                :value="old('smtp_username', $settings['smtp_username'] ?? '')"
                            />
                        </div>

                        <div>
                            <x-input-label for="smtp_password" :value="__('SMTP Password')" />
                            <x-text-input
                                id="smtp_password"
                                class="input w-full"
                                type="password"
                                name="smtp_password"
                                :value="old('smtp_password', $settings['smtp_password'] ?? '')"
                            />
                        </div>

                        <div>
                            <x-input-label for="smtp_encryption" :value="__('Encryption')" />
                            <select id="smtp_encryption" name="smtp_encryption" class="input w-full">
                                <option value="tls" {{ ($settings['smtp_encryption'] ?? 'tls') === 'tls' ? 'selected' : '' }}>TLS</option>
                                <option value="ssl" {{ ($settings['smtp_encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option>
                                <option value="" {{ empty($settings['smtp_encryption'] ?? '') ? 'selected' : '' }}>None</option>
                            </select>
                        </div>

                        <div>
                            <x-input-label for="smtp_from_address" :value="__('From Email')" />
                            <x-text-input
                                id="smtp_from_address"
                                class="input w-full"
                                type="email"
                                name="smtp_from_address"
                                :value="old('smtp_from_address', $settings['smtp_from_address'] ?? '')"
                            />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="smtp_from_name" :value="__('From Name')" />
                            <x-text-input
                                id="smtp_from_name"
                                class="input w-full"
                                type="text"
                                name="smtp_from_name"
                                :value="old('smtp_from_name', $settings['smtp_from_name'] ?? '')"
                            />
                        </div>
                    </div>
                </div>

                <!-- Payment Settings -->
                <div class="space-y-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">Payment Settings</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="monthly_dues_amount" :value="__('Monthly Dues Amount')" />
                            <div class="relative">
                                <x-text-input
                                    id="monthly_dues_amount"
                                    class="input w-full pl-8"
                                    type="number"
                                    step="0.01"
                                    name="monthly_dues_amount"
                                    :value="old('monthly_dues_amount', $settings['monthly_dues_amount'] ?? '50.00')"
                                    required
                                />
                            </div>
                            <x-input-error :messages="$errors->get('monthly_dues_amount')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="subscription_amount" :value="__('Subscription Amount')" />
                            <div class="relative">
                                <x-text-input
                                    id="subscription_amount"
                                    class="input w-full pl-8"
                                    type="number"
                                    step="0.01"
                                    name="subscription_amount"
                                    :value="old('subscription_amount', $settings['subscription_amount'] ?? '100.00')"
                                    required
                                />
                            </div>
                            <x-input-error :messages="$errors->get('subscription_amount')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="payment_methods" :value="__('Payment Methods')" />
                        <div class="space-y-2 mt-2">
                            @php
                                $availableMethods = ['bank_transfer' => 'Bank Transfer', 'cash' => 'Cash'];
                                $selectedMethods = old(
                                    'payment_methods',
                                    is_array($settings['payment_methods'] ?? null)
                                        ? $settings['payment_methods']
                                        : ['bank_transfer', 'cash']
                                );
                            @endphp
                            @foreach($availableMethods as $key => $label)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input
                                        type="checkbox"
                                        name="payment_methods[]"
                                        value="{{ $key }}"
                                        {{ in_array($key, $selectedMethods) ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500"
                                    >
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('payment_methods')" class="mt-2" />
                    </div>

                    <!-- Bank Transfer Details -->
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                        <h4 class="font-semibold text-blue-900 dark:text-blue-300 mb-4">Bank Transfer Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="bank_name" :value="__('Bank Name')" />
                                <x-text-input
                                    id="bank_name"
                                    class="input w-full"
                                    type="text"
                                    name="bank_name"
                                    :value="old('bank_name', $settings['bank_name'] ?? '')"
                                />
                            </div>
                            <div>
                                <x-input-label for="bank_account_name" :value="__('Account Name')" />
                                <x-text-input
                                    id="bank_account_name"
                                    class="input w-full"
                                    type="text"
                                    name="bank_account_name"
                                    :value="old('bank_account_name', $settings['bank_account_name'] ?? '')"
                                />
                            </div>
                            <div>
                                <x-input-label for="bank_account_number" :value="__('Account Number')" />
                                <x-text-input
                                    id="bank_account_number"
                                    class="input w-full"
                                    type="text"
                                    name="bank_account_number"
                                    :value="old('bank_account_number', $settings['bank_account_number'] ?? '')"
                                />
                            </div>
                            <div>
                                <x-input-label for="bank_routing_number" :value="__('Routing Number (optional)')" />
                                <x-text-input
                                    id="bank_routing_number"
                                    class="input w-full"
                                    type="text"
                                    name="bank_routing_number"
                                    :value="old('bank_routing_number', $settings['bank_routing_number'] ?? '')"
                                />
                            </div>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="auto_suspend_days" :value="__('Auto-Suspend Days')" />
                        <x-text-input
                            id="auto_suspend_days"
                            class="input w-full"
                            type="number"
                            name="auto_suspend_days"
                            :value="old('auto_suspend_days', $settings['auto_suspend_days'] ?? '30')"
                            min="0"
                        />
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Number of days after payment due date before auto-suspending members (0 to disable)</p>
                        <x-input-error :messages="$errors->get('auto_suspend_days')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <x-button type="submit" variant="primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Settings
                    </x-button>
                </div>
            </form>
        </x-card>


        <!-- Danger Zone -->
        @if(app()->environment('local'))
            <x-card class="border-l-4 border-l-red-500 bg-red-50 dark:bg-red-900/20">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-800 dark:text-red-300 mb-2">Danger Zone</h3>
                        <p class="text-sm text-red-700 dark:text-red-400 mb-4">
                            These actions are irreversible and will permanently delete data. Only use in development environment.
                        </p>
                        <form method="POST" action="{{ route('admin.database.reset') }}" onsubmit="return confirm('Are you absolutely sure you want to reset the entire database? This will delete ALL data and cannot be undone!')">
                            @csrf
                            <x-button type="submit" variant="danger" class="bg-red-600 hover:bg-red-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Reset Database
                            </x-button>
                        </form>
                    </div>
                </div>
            </x-card>
        @endif
    </div>
</x-admin-layout>

