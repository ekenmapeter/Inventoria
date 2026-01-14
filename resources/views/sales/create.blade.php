<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Sale') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('sales.store') }}" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="customer_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Customer') }}
                                </label>
                                <select id="customer_id" name="customer_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">{{ __('Walk-in / None') }}</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" @selected(old('customer_id') == $customer->id)>
                                            {{ $customer->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="location_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Location') }}
                                </label>
                                <select id="location_id" name="location_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">{{ __('Select a location') }}</option>
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" @selected(old('location_id') == $location->id)>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="reference" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    {{ __('Reference') }}
                                </label>
                                <input type="text" id="reference" name="reference" value="{{ old('reference') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('reference')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Items') }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ __('Add one or more lines. Each line will decrease stock at the selected location.') }}
                            </p>

                            <div class="border border-gray-200 dark:border-gray-700 rounded-md divide-y divide-gray-200 dark:divide-gray-700">
                                @for($i = 0; $i < 3; $i++)
                                    <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                {{ __('Product') }}
                                            </label>
                                            <select name="items[{{ $i }}][product_id]"
                                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                <option value="">{{ __('Select product') }}</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        @selected(old("items.$i.product_id") == $product->id)>
                                                        {{ $product->item_code }} - {{ $product->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("items.$i.product_id")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                {{ __('Quantity') }}
                                            </label>
                                            <input type="number" min="0" name="items[{{ $i }}][quantity]"
                                                   value="{{ old("items.$i.quantity") }}"
                                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @error("items.$i.quantity")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                                {{ __('Unit Price') }}
                                            </label>
                                            <input type="number" min="0" step="0.01" name="items[{{ $i }}][unit_price]"
                                                   value="{{ old("items.$i.unit_price") }}"
                                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @error("items.$i.unit_price")
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('sales.index') }}"
                               class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 mr-4">
                                {{ __('Cancel') }}
                            </a>
                            <x-primary-button>
                                {{ __('Save Sale') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


