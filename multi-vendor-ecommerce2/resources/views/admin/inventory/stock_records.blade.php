@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')

<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f6fa;
        margin: 0;
    }

    .container {
        width: 95%;
        max-width: 1200px;
        margin: 30px auto;
        background: #fff;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #1b1b1b;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    th, td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background: #007bff;
        color: white;
    }

    tr:nth-child(even) {
        background: #f3f4f6;
    }

    tr:hover {
        background: #e9ecef;
    }

    .product img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    .status {
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 13px;
        display: inline-block;
    }

    .available {
        background: #e7f9ee;
        color: #218838;
    }

    .soldout {
        background: #fdecea;
        color: #c82333;
    }

    .action-btn {
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 13px;
        font-weight: bold;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .delete-btn {
        background: #dc3545;
    }

    .delete-btn:hover {
        background: #bb2d3b;
        transform: scale(1.05);
    }

</style>

<div class="container">
    <h2>Admin Stock</h2>

    @if(session('success'))
        <p style="color:green; text-align:center;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Vendor Price</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td>{{ $stock->id }}</td>

                <td>{{ $stock->product->product_name ?? 'N/A' }}</td>

                <td class="product">
                    @if($stock->product && $stock->product->product_image)
                        <img src="{{ asset('product_images/'.$stock->product->product_image) }}" alt="Product Image">
                    @else
                        <img src="https://via.placeholder.com/50" alt="Product Image">
                    @endif
                </td>

                <td>{{ $stock->quantity }}</td>
                <td>৳ {{ number_format($stock->vendor_price,2) }}</td>

                <td>
                    @if($stock->quantity > 0)
                        <span class="status available">Available</span>
                    @else
                        <span class="status soldout">Stock Out</span>
                    @endif
                </td>

                <td>{{ $stock->created_at->format('Y-m-d H:i') }}</td>

                <td>
                    <a href="{{ route('inventory.delete_stock',$stock->id) }}" class="action-btn delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection