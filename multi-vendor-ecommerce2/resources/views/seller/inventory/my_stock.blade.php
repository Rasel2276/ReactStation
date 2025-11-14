@extends('seller.layouts.layout')
@section('seller_page_title')
    Purchased Products
@endsection
@section('seller_layout')

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f4f6f9;
            margin: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background: #e9ecef;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
        }

        th {
            font-weight: 700;
            color: #2c3e50;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: #f1f1f1;
        }

        td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }

        .action-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            margin-right: 5px;
            font-size: 13px;
            transition: 0.2s;
        }

        .btn-delete {
            background: #e74c3c;
            color: #fff;
        }
        .btn-delete:hover {
            background: #c0392b;
        }

        .btn-buy {
            background: #2ecc71;
            color: #fff;
        }
        .btn-buy:hover {
            background: #27ae60;
        }

        @media(max-width: 768px){
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead {
                display: none;
            }

            tbody tr {
                margin-bottom: 15px;
                background: #fff;
                padding: 10px;
                border-radius: 8px;
            }

            td {
                padding: 10px 5px;
                text-align: right;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 120px;
                font-weight: 700;
                text-align: left;
            }

            .action-btn {
                margin-top: 5px;
                width: 48%;
            }
        }
    </style>
</head>
<body>

<h2>Vendor Stock Management</h2>

@if(session('success'))
    <div style="color:green; margin-bottom:15px;">{{ session('success') }}</div>
@endif

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Image</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($stocks as $stock)
        <tr>
            <td>{{ $stock->id }}</td>
            <td>{{ $stock->adminStock->product->product_name ?? 'N/A' }}</td>
            <td>
                @if(!empty($stock->adminStock->product->product_image))
                    <img src="{{ asset('product_images/'.$stock->adminStock->product->product_image) }}" width="55" height="55" style="object-fit:cover;">
                @else
                    N/A
                @endif
            </td>
            <td>{{ $stock->quantity }}</td>
            <td>৳{{ number_format($stock->price, 2) }}</td>
            <td>
                <form action="{{ route('inventory.delete_stock', $stock->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:red;color:white;padding:5px 10px;border:none;border-radius:5px;">Delete</button>
                </form>
                <button style="background:green;color:white;padding:5px 10px;border:none;border-radius:5px;">Buy Now</button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align:center;">No stock found.</td>
        </tr>
        @endforelse
    </tbody>
</table>


@endsection
