<!DOCTYPE html>
<html>
<head>
    <title>Purchase Order #{{ $order->id }}</title>
</head>
<body>
    <h1>Purchase Order #{{ $order->id }}</h1>

    <p>Dear {{ $order->supplier->name }},</p>

    <p>Please find attached our purchase order #{{ $order->id }}.</p>

    <p>Order Details:</p>
    <ul>
        <li>Order Date: {{ $order->issue_date->format('Y-m-d') }}</li>
        <li>Expected Delivery: {{ $order->expected_date->format('Y-m-d') }}</li>
        <li>Total Amount: ${{ number_format($order->total, 2) }}</li>
    </ul>

    <p>Please confirm receipt of this order.</p>

    <p>Best regards,<br>
    {{ config('app.name') }}</p>
</body>
</html>