<x-admin-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Package</h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Update package details</p>
            </div>
            <x-button href="{{ route('admin.packages.index') }}" variant="outline">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Packages
            </x-button>
        </div>

        <!-- Form -->
        <x-card>
            <form method="POST" action="{{ route('admin.packages.update', $package) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $package->name)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <!-- Amount (for subscription) -->
                    <div id="amount_container">
                        <x-input-label for="amount" :value="__('Amount (₦)')" />
                        <x-text-input id="amount" name="amount" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('amount', $package->amount)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('amount')" />
                    </div>

                    <!-- Min Amount (for fundraise) -->
                    <div id="min_amount_container" style="display: none;">
                        <x-input-label for="min_amount" :value="__('Minimum Amount (₦)')" />
                        <x-text-input id="min_amount" name="min_amount" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('min_amount', $package->min_amount)" />
                        <x-input-error class="mt-2" :messages="$errors->get('min_amount')" />
                    </div>

                    <!-- Max Amount (for fundraise) -->
                    <div id="max_amount_container" style="display: none;">
                        <x-input-label for="max_amount" :value="__('Maximum Amount (₦)')" />
                        <x-text-input id="max_amount" name="max_amount" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('max_amount', $package->max_amount)" />
                        <x-input-error class="mt-2" :messages="$errors->get('max_amount')" />
                    </div>

                    <!-- Type -->
                    <div>
                        <x-input-label for="type" :value="__('Type')" />
                        <select id="type" name="type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            <option value="subscription" {{ old('type', $package->type) === 'subscription' ? 'selected' : '' }}>Subscription</option>
                            <option value="fundraise" {{ old('type', $package->type) === 'fundraise' ? 'selected' : '' }}>Fundraise</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>

                    <!-- Is Active -->
                    <div>
                        <x-input-label for="is_active" :value="__('Status')" />
                        <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <input id="is_active" name="is_active" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 dark:bg-gray-900 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Active</span>
                            </label>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                    </div>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $package->description) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <!-- Submit -->
                <div class="flex items-center justify-end mt-6">
                    <x-button type="submit" variant="primary">
                        Update Package
                    </x-button>
                </div>
            </form>

            <script>
                document.getElementById('type').addEventListener('change', function() {
                    const amountContainer = document.getElementById('amount_container');
                    const minAmountContainer = document.getElementById('min_amount_container');
                    const maxAmountContainer = document.getElementById('max_amount_container');
                    const amountInput = document.getElementById('amount');
                    const minAmountInput = document.getElementById('min_amount');
                    const maxAmountInput = document.getElementById('max_amount');

                    if (this.value === 'fundraise') {
                        amountContainer.style.display = 'none';
                        minAmountContainer.style.display = 'block';
                        maxAmountContainer.style.display = 'block';
                        amountInput.required = false;
                        minAmountInput.required = true;
                        maxAmountInput.required = true;
                        amountInput.value = '';
                    } else {
                        amountContainer.style.display = 'block';
                        minAmountContainer.style.display = 'none';
                        maxAmountContainer.style.display = 'none';
                        amountInput.required = true;
                        minAmountInput.required = false;
                        maxAmountInput.required = false;
                        minAmountInput.value = '';
                        maxAmountInput.value = '';
                    }
                });

                // Trigger on page load in case of validation errors
                document.addEventListener('DOMContentLoaded', function() {
                    document.getElementById('type').dispatchEvent(new Event('change'));
                });
            </script>
        </x-card>
    </div>
</x-admin-layout>
