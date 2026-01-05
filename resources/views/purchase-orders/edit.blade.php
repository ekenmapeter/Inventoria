<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Purchase Order') }} #{{ $purchaseOrder->order_number }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('purchase-orders.update', $purchaseOrder) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Information -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>

                                <div>
                                    <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier</label>
                                    <select name="supplier_id" id="supplier_id" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="">Select a supplier</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}" {{ old('supplier_id', $purchaseOrder->supplier_id) == $supplier->id ? 'selected' : '' }}>
                                                {{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('supplier_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="order_date" class="block text-sm font-medium text-gray-700">Order Date</label>
                                    <input type="date" name="order_date" id="order_date" value="{{ old('order_date', $purchaseOrder->order_date->format('Y-m-d')) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('order_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="expected_date" class="block text-sm font-medium text-gray-700">Expected Date</label>
                                    <input type="date" name="expected_date" id="expected_date" value="{{ old('expected_date', $purchaseOrder->expected_date->format('Y-m-d')) }}" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @error('expected_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                                    <textarea name="notes" id="notes" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('notes', $purchaseOrder->notes) }}</textarea>
                                    @error('notes')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900">Order Items</h3>
                                <div id="order-items">
                                    @foreach($purchaseOrder->items as $index => $item)
                                        <div class="order-item space-y-4 p-4 border rounded-md">
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Product</label>
                                                    <select name="items[{{ $index }}][product_id]" required
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                        <option value="">Select a product</option>
                                                        @foreach($products as $product)
                                                            <option value="{{ $product->id }}" data-price="{{ $product->cost }}"
                                                                {{ old("items.{$index}.product_id", $item->product_id) == $product->id ? 'selected' : '' }}>
                                                                {{ $product->name }} ({{ $product->sku }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Quantity</label>
                                                    <input type="number" name="items[{{ $index }}][quantity]" required min="1"
                                                        value="{{ old("items.{$index}.quantity", $item->quantity) }}"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Unit Price</label>
                                                    <input type="number" name="items[{{ $index }}][unit_price]" required step="0.01" min="0"
                                                        value="{{ old("items.{$index}.unit_price", $item->unit_price) }}"
                                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700">Total</label>
                                                    <input type="text" readonly class="item-total mt-1 block w-full rounded-md bg-gray-50 border-gray-300 shadow-sm sm:text-sm">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700">Notes</label>
                                                <input type="text" name="items[{{ $index }}][notes]"
                                                    value="{{ old("items.{$index}.notes", $item->notes) }}"
                                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" id="add-item"
                                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                    Add Item
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('purchase-orders.show', $purchaseOrder) }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Update Purchase Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderItems = document.getElementById('order-items');
            const addItemButton = document.getElementById('add-item');
            let itemCount = {{ $purchaseOrder->items->count() }};

            // Function to calculate item total
            function calculateItemTotal(itemElement) {
                const quantity = parseFloat(itemElement.querySelector('input[name$="[quantity]"]').value) || 0;
                const unitPrice = parseFloat(itemElement.querySelector('input[name$="[unit_price]"]').value) || 0;
                const total = quantity * unitPrice;
                itemElement.querySelector('.item-total').value = total.toFixed(2);
            }

            // Function to update unit price when product is selected
            function updateUnitPrice(selectElement) {
                const option = selectElement.options[selectElement.selectedIndex];
                const unitPriceInput = selectElement.closest('.order-item').querySelector('input[name$="[unit_price]"]');
                if (option.dataset.price) {
                    unitPriceInput.value = option.dataset.price;
                    calculateItemTotal(selectElement.closest('.order-item'));
                }
            }

            // Add event listeners to existing items
            document.querySelectorAll('.order-item').forEach(item => {
                const productSelect = item.querySelector('select[name$="[product_id]"]');
                const quantityInput = item.querySelector('input[name$="[quantity]"]');
                const unitPriceInput = item.querySelector('input[name$="[unit_price]"]');

                productSelect.addEventListener('change', () => updateUnitPrice(productSelect));
                quantityInput.addEventListener('input', () => calculateItemTotal(item));
                unitPriceInput.addEventListener('input', () => calculateItemTotal(item));

                // Calculate initial totals
                calculateItemTotal(item);
            });

            // Add new item
            addItemButton.addEventListener('click', function() {
                const template = orderItems.querySelector('.order-item').cloneNode(true);

                // Update input names
                template.querySelectorAll('input, select').forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace(/\[\d+\]/, `[${itemCount}]`));
                    }
                });

                // Clear values
                template.querySelectorAll('input').forEach(input => {
                    if (input.type !== 'hidden') {
                        input.value = '';
                    }
                });

                // Add event listeners
                const productSelect = template.querySelector('select[name$="[product_id]"]');
                const quantityInput = template.querySelector('input[name$="[quantity]"]');
                const unitPriceInput = template.querySelector('input[name$="[unit_price]"]');

                productSelect.addEventListener('change', () => updateUnitPrice(productSelect));
                quantityInput.addEventListener('input', () => calculateItemTotal(template));
                unitPriceInput.addEventListener('input', () => calculateItemTotal(template));

                orderItems.appendChild(template);
                itemCount++;
            });
        });
    </script>
    @endpush
</x-app-layout>
