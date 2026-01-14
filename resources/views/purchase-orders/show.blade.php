<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Purchase Order') }} #{{ $purchaseOrder->order_number }}
            </h2>
            <div class="flex space-x-4">
                @if($purchaseOrder->status === 'draft')
                    <a href="{{ route('purchase-orders.edit', $purchaseOrder) }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('Edit') }}
                    </a>
                    <form action="{{ route('purchase-orders.approve', $purchaseOrder) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Approve') }}
                        </button>
                    </form>
                @endif

                @if($purchaseOrder->status === 'approved')
                    <form action="{{ route('purchase-orders.receive', $purchaseOrder) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Mark as Received') }}
                        </button>
                    </form>
                @endif

                @if(in_array($purchaseOrder->status, ['draft', 'pending', 'approved']))
                    <form action="{{ route('purchase-orders.cancel', $purchaseOrder) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Cancel') }}
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Basic Information -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <span class="mt-1 inline-flex px-2 text-xs leading-5 font-semibold rounded-full
                                    {{ match($purchaseOrder->status) {
                                        'draft' => 'bg-gray-100 text-gray-800',
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-blue-100 text-blue-800',
                                        'received' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-800'
                                    } }}">
                                    {{ ucfirst($purchaseOrder->status) }}
                                </span>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Supplier</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $purchaseOrder->supplier->name }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Order Date</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $purchaseOrder->order_date->format('M d, Y') }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Expected Date</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $purchaseOrder->expected_date->format('M d, Y') }}</p>
                            </div>

                            @if($purchaseOrder->notes)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Notes</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $purchaseOrder->notes }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Order Items -->
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900">Order Items</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Product
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Quantity
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Unit Price
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Total
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($purchaseOrder->items as $item)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                    {{ $item->product->name }}
                                                    <div class="text-xs text-gray-500">{{ $item->product->sku }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ number_format($item->unit_price, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ number_format($item->total_amount, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="bg-gray-50">
                                        <tr>
                                            <td colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-500">
                                                Total Amount:
                                            </td>
                                            <td class="px-6 py-3 text-sm font-medium text-gray-900">
                                                {{ number_format($purchaseOrder->total_amount, 2) }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
