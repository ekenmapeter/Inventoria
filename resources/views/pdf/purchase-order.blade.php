<!DOCTYPE html>
<html>
<head>
    <title>Purchase Order #{{ $order->id }}</title>
    <style>
        /* Add your PDF styling here */
    </style>
</head>
<body>
    <h1>Purchase Order #{{ $order->id }}</h1>

    <div class="order-info">
        <div class="supplier-info">
            <h3>Supplier</h3>
            <p>{{ $order->supplier->name }}</p>
            <p>{{ $order->billing_address }}</p>
        </div>

        <div class="shipping-info">
            <h3>Ship To</h3>
            <p>{{ $order->location->name }}</p>
            <p>{{ $order->shipping_address }}</p>
        </div>

        <div class="order-details">
            <p><strong>Issue Date:</strong> {{ $order->issue_date->format('Y-m-d') }}</p>
            <p><strong>Expected Date:</strong> {{ $order->expected_date->format('Y-m-d') }}</p>
            <p><strong>Tracking Ref:</strong> {{ $order->tracking_ref }}</p>
            <p><strong>Ship By:</strong> {{ $order->ship_by }}</p>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>Quantity</th>
                <th>Description</th>
                <th>Unit Value</th>
                <th>Line Total</th>
                <th>Measure</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->description }}</td>
                <td>${{ number_format($item->unit_value, 2) }}</td>
                <td>${{ number_format($item->line_total, 2) }}</td>
                <td>{{ $item->measure }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="order-totals">
        <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
        <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
    </div>

    @if($order->order_note)
    <div class="order-notes">
        <h3>Order Notes</h3>
        <p>{{ $order->order_note }}</p>
    </div>
    @endif
</body>
</html>