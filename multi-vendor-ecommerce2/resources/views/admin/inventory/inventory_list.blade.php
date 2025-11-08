@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')
  <h2 style="margin-top:40px;">Product Inventory List</h2>

<style>
    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    table thead {
        background: #4CAF50;
        color: white;
    }

    table thead tr th {
        padding: 12px 15px;
        text-align: left;
        font-size: 15px;
    }

    table tbody tr {
        border-bottom: 1px solid #ddd;
    }

    table tbody tr:hover {
        background: #f5f5f5;
    }

    table tbody td {
        padding: 12px 15px;
        font-size: 14px;
        color: #333;
    }

    .product-img {
        width: 60px;
        height: 60px;
        border-radius: 6px;
        object-fit: cover;
        border: 1px solid #ddd;
    }

    .action-btn {
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 13px;
        color: white;
        text-decoration: none;
        margin-right: 6px;
    }

    .edit-btn {
        background: #2196F3;
    }

    .delete-btn {
        background: #f44336;
    }

    .action-btn:hover {
        opacity: 0.8;
    }

    /* ✅ Responsive for Mobile */
    @media(max-width: 768px) {

        table thead {
            display: none;
        }

        table tbody tr {
            display: block;
            margin-bottom: 15px;
            border-bottom: 2px solid #ddd;
            background: #fff;
            padding: 10px;
        }

        table tbody td {
            display: flex;
            justify-content: space-between;
            padding: 8px 5px;
            font-size: 14px;
        }

        table tbody td::before {
            content: attr(data-label);
            font-weight: bold;
            color: #555;
        }

        .product-img {
            width: 50px;
            height: 50px;
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
                <th>Purchase Price</th>
                <th>Selling Price</th>
                <th>Available Qty</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td data-label="Id">1</td>
                <td data-label="Product">Product A</td>

                <td data-label="Image">
                    <img src="https://via.placeholder.com/60" class="product-img">
                </td>

                <td data-label="Total Qty">120</td>
                <td data-label="Purchase Price">৳120</td>
                <td data-label="Selling Price">৳150</td>
                <td data-label="Available Qty">70</td>

                <td data-label="Action">
                    <a href="#" class="action-btn edit-btn">Edit</a>
                    <a href="#" class="action-btn delete-btn">Delete</a>
                </td>
            </tr>

            <tr>
                <td data-label="Id">2</td>
                <td data-label="Product">Product B</td>

                <td data-label="Image">
                    <img src="https://via.placeholder.com/60" class="product-img">
                </td>

                <td data-label="Total Qty">85</td>
                <td data-label="Purchase Price">৳200</td>
                <td data-label="Selling Price">৳260</td>
                <td data-label="Available Qty">40</td>

                <td data-label="Action">
                    <a href="#" class="action-btn edit-btn">Edit</a>
                    <a href="#" class="action-btn delete-btn">Delete</a>
                </td>
            </tr>

        </tbody>
    </table>
</div>
@endsection