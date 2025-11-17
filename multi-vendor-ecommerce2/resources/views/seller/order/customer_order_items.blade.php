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
}

.custom-table tbody tr:hover {
    background-color: #f1f8ff;
}

.product-img {
    width: 50px;
    height: 50px;
    border-radius: 6px;
    object-fit: cover;
}

.dropdown { position: relative; display: inline-block; }
.dropbtn { background-color: #007bff; color: #fff; padding: 5px 12px; font-size: 13px; border: none; border-radius: 5px; cursor: pointer; }
.dropbtn:hover { background-color: #0056b3; }
.dropdown-content { display: none; position: absolute; background-color: #fff; min-width: 150px; border-radius: 6px; box-shadow: 0 6px 18px rgba(0,0,0,0.15); z-index: 10; }
.dropdown-content a { display: block; color: #333; padding: 10px 15px; text-decoration: none; }
.dropdown-content a:hover { background-color: #f0f0f0; }
.dropdown:hover .dropdown-content { display: block; }

.delete-btn { background-color: #e74c3c; color: white; padding: 6px 12px; border: none; border-radius: 5px; cursor: pointer; }
.delete-btn:hover { background-color: #c0392b; }

</style>

<div class="table-container">
    <h2>Customer Order Items</h2>
    @if(session('success'))
        <p style="color:green; text-align:center; font-weight: bold;">{{ session('success') }}</p>
    @endif
    <table class="custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Customer Product ID</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Manage Order</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order_items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>#{{ $item->order_id }}</td>
                <td><img src="{{ $item->customerProduct->image ?? 'https://via.placeholder.com/50' }}" class="product-img" alt="Product Image"></td>
                <td>{{ $item->customerProduct->name ?? 'N/A' }}</td>
                <td>{{ $item->customer_product_id }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->total }}</td>
                <td>
                    <div class="dropdown">
                        <button class="dropbtn">Manage ▾</button>
                        <div class="dropdown-content">
                            <a href="#">Confirm Order</a>
                            <a href="#">Reject Order</a>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="{{ route('order_item.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this item?');">
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
