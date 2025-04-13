<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Bill #{{ $bill->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .bill-info {
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .total-section {
            margin-top: 20px;
            text-align: right;
        }

        .payment-info {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Bill #{{ $bill->id }}</h1>
    </div>

    <div class="section">
        <div class="section-title">Reservation Information</div>
        <table>
            <tr>
                <td>Reservation Number:</td>
                <td>#{{ $bill->reservation->id }}</td>
            </tr>
            <tr>
                <td>Table Number:</td>
                <td>#{{ $bill->reservation->table->table_number }}</td>
            </tr>
            <tr>
                <td>Customer Name:</td>
                <td>{{ $bill->reservation->customer_name }}</td>
            </tr>
            <tr>
                <td>Date & Time:</td>
                <td>{{ $bill->reservation->reservation_date->format('F d, Y H:i') }}</td>
            </tr>
            <tr>
                <td>Number of Guests:</td>
                <td>{{ $bill->reservation->number_of_guests }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Bill Summary</div>
        <table>
            <tr>
                <td>Subtotal:</td>
                <td>৳{{ number_format($bill->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td>Tax (10%):</td>
                <td>৳{{ number_format($bill->tax, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Total:</strong></td>
                <td><strong>৳{{ number_format($bill->total, 2) }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="payment-info">
        <div class="section-title">Payment Information</div>
        <p>Status: {{ ucfirst($bill->payment_status) }}</p>
        @if($bill->payment_status == 'paid')
        <p>Method: {{ ucfirst($bill->payment_method) }}</p>
        @if($bill->payment_reference)
        <p>Reference: {{ $bill->payment_reference }}</p>
        @endif
        @endif
    </div>
</body>

</html>