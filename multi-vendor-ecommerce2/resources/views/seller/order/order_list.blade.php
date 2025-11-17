@extends('seller.layouts.layout')
@section('seller_layout')

<style>
.table-container {
    width: 95%;
    margin: 30px auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}

h2 { text-align: center; font-size: 26px; color: #222; margin-bottom: 20px; }

.custom-table {
    width: 100%;
    border-collapse: collapse;
    table-layout: auto;
    font-size: 14px;
}

.custom-table th {
    background-color: #007bff;
    color: #fff;
    font-weight: 600;
    padding: 12px 10px;
    text-align: center;
}

.custom-table td {
    padding: 10px 8px;
    border-bottom: 1px solid #e0e0e0;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
}

.custom-table tbody tr:hover {
    background-color: #f1f8ff;
}

.status {
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    text-transform: capitalize;
}
.pending { background: #f1c40f; }
.processing { background: #3498db; }
.completed { background: #28a745; }
.cancelled { background: #e74c3c; }

.delete-btn {
    padding: 7px 12px;
    background: #e74c3c;
    border: none;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
}
.delete-btn:hover { background: #c0392b; }

</style>

<div class="table-container">
    <h2>Order Management Table</h2>

    @if(session('success'))
        <p style="color:green; text-align:center; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <table class="custom-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Type</th>
                <th>Subtotal</th>
                <th>Shipping</th>
                <th>Total</th>
                <th>Shipping Method</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->customer_id ? 'Customer' : 'Guest' }}</td>
                <td>{{ $order->subtotal }}</td>
                <td>{{ $order->shipping_cost }}</td>
                <td>{{ $order->total_payment }}</td>
                <td>{{ $order->shipping_method }}</td>
                <td>{{ $order->payment_method }}</td>
                <td><span class="status {{ strtolower($order->status) }}">{{ $order->status }}</span></td>
                <td>
                    <form action="{{ route('order.delete', $order->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this order?');">
                        @csrf
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
