@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')
  <style>
    body {
        font-family: 'Segoe UI', Tahoma, sans-serif;
        background: #f0f2f5;
        margin: 0;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 28px;
        font-weight: 600;
    }

    .table-container {
        max-width: 1100px;
        margin: 0 auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
    }

    thead {
        background: #3498db;
        color: #fff;
    }

    thead tr th {
        padding: 14px;
        font-size: 15px;
        text-align: left;
    }

    tbody tr {
        border-bottom: 1px solid #e0e0e0;
        transition: 0.2s;
    }

    tbody tr:hover {
        background: #f9fbfd;
        box-shadow: inset 0 0 5px rgba(0,0,0,0.08);
    }

    tbody td {
        padding: 12px;
        font-size: 14px;
        color: #444;
        vertical-align: middle;
    }

    /* Image Style */
    .product-img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    .action-btn {
        padding: 7px 12px;
        border-radius: 6px;
        text-decoration: none;
        color: #fff;
        font-size: 13px;
        transition: 0.2s;
    }

    .edit-btn {
        background: #27ae60;
    }

    .delete-btn {
        background: #e74c3c;
    }

    .action-btn:hover {
        opacity: 0.85;
    }

    /* Responsive */
    @media(max-width: 768px){
        thead {
            display: none;
        }

        tbody tr {
            display: block;
            margin-bottom: 12px;
            background: #fff;
            border-radius: 8px;
            padding: 12px;
        }

        tbody td {
            display: flex;
            justify-content: space-between;
            padding: 10px 5px;
        }

        tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #111;
        }

        .product-img {
            width: 70px;
            height: 70px;
        }
    }
</style>

</head>
<body>

<h2>Purchase Product List</h2>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Supplier</th>
                <th>Product</th>
                <th>Image</th>
                <th>Qty</th>
                <th>Purchase Price</th>
                <th>Selling Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td data-label="Id">1</td>
                <td data-label="Supplier">Supplier A</td>
                <td data-label="Product">Product A</td>

                <td data-label="Image">
                    <img src="https://via.placeholder.com/60" class="product-img">
                </td>

                <td data-label="Qty">10</td>
                <td data-label="Purchase Price">৳120</td>
                <td data-label="Selling Price">৳150</td>
                <td data-label="Total">৳1200</td>
                <td data-label="Action">
                    <a href="#" class="action-btn edit-btn">Edit</a>
                    <a href="#" class="action-btn delete-btn">Delete</a>
                </td>
            </tr>

            <tr>
                <td data-label="Id">2</td>
                <td data-label="Supplier">Supplier B</td>
                <td data-label="Product">Product B</td>

                <td data-label="Image">
                    <img src="https://via.placeholder.com/60" class="product-img">
                </td>

                <td data-label="Qty">5</td>
                <td data-label="Purchase Price">৳200</td>
                <td data-label="Selling Price">৳260</td>
                <td data-label="Total">৳1000</td>
                <td data-label="Action">
                    <a href="#" class="action-btn edit-btn">Edit</a>
                    <a href="#" class="action-btn delete-btn">Delete</a>
                </td>
            </tr>
        </tbody>

    </table>
</div>
</body>
@endsection
