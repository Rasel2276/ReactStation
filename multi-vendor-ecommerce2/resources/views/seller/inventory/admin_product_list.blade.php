@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')

<h2>Admin Product Stock</h2>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f6f9;
    }

    h2 {
        text-align: center;
        margin: 30px 0;
        font-size: 28px;
        color: #333;
    }

    .table-container {
        width: 95%;
        max-width: 1200px;
        margin: 0 auto 40px auto;
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }

    table thead {
        background: #3498db;
        color: #fff;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        font-size: 15px;
    }

    th {
        font-size: 16px;
        font-weight: 600;
    }

    .product-img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    /* Buttons */
    .buy-btn {
        background: #28a745;
        color: #fff !important;
        padding: 7px 12px;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        transition: 0.3s;
    }

    .buy-btn:hover {
        background: #1f7f38;
    }

    .disabled-btn {
        background: #ccc;
        color: #666 !important;
        padding: 7px 12px;
        border-radius: 5px;
        cursor: not-allowed;
        border: none;
        font-size: 14px;
    }

    /* Responsive */
    @media(max-width: 768px){
        h2 {
            font-size: 22px;
        }

        .product-img {
            width: 45px;
            height: 45px;
        }
    }
</style>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Product</th>
                <th>Image</th>
                <th>Total Qty</th>
                <th>Vendor Sale Price</th>
                <th>Available Qty</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($stocks as $stock)
            <tr>
                <td data-label="Id">{{ $stock->id }}</td>
                <td data-label="Product">{{ $stock->product->product_name }}</td>

                <td data-label="Image">
                    @if($stock->product->product_image)
                        <img src="{{ asset('product_images/'.$stock->product->product_image) }}" class="product-img">
                    @else
                        N/A
                    @endif
                </td>

                <td data-label="Total Qty">{{ $stock->quantity }}</td>

                <td data-label="Vendor Sale Price">৳{{ $stock->vendor_sale_price }}</td>

                <td data-label="Available Qty">
                    {{ $stock->available_quantity > 0 ? $stock->available_quantity : 'Out of Stock' }}
                </td>

                <td data-label="Action">
                    @if($stock->available_quantity > 0)
                        <a href="{{ route('inventory.vendor_purchase', ['product_id' => $stock->product_id]) }}"
                           class="buy-btn">
                           Buy Now
                        </a>
                    @else
                        <button class="disabled-btn" disabled>Out of Stock</button>
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection