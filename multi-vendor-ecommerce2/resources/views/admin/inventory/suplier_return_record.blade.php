@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        margin-top: 40px;
        font-size: 28px;
        color: #333;
    }

    .table-container {
        max-width: 1100px;
        margin: 30px auto;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.1);
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #3498db;
        color: #fff;
    }

    thead th {
        padding: 12px;
        text-align: left;
        font-weight: 600;
    }

    tbody tr {
        border-bottom: 1px solid #e0e0e0;
        transition: 0.2s;
    }

    tbody tr:hover {
        background: #f9fbfd;
    }

    tbody td {
        padding: 12px;
        font-size: 14px;
        color: #444;
        vertical-align: middle;
    }

    /* Product image */
    .product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    /* Action buttons */
    .action-btn {
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 13px;
        color: #fff;
        margin-right: 5px;
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
            border-radius: 8px;
            padding: 12px;
            background: #fff;
        }

        tbody td {
            display: flex;
            justify-content: space-between;
            padding: 8px 5px;
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

<h2>Purchase Return List</h2>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Product</th>
                <th>Image</th>
                <th>Admin Purchase</th>
                <th>Admin</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-label="Id">1</td>
                <td data-label="Product">Product A</td>
                <td data-label="Image"><img src="https://via.placeholder.com/50" class="product-img"></td>
                <td data-label="Admin Purchase">Purchase #1</td>
                <td data-label="Admin">Admin A</td>
                <td data-label="Supplier">Supplier X</td>
                <td data-label="Quantity">10</td>
                <td data-label="Reason">Damaged goods</td>
                <td data-label="Status">Pending</td>
                <td data-label="Action">
                    <a href="#" class="action-btn edit-btn">Edit</a>
                    <a href="#" class="action-btn delete-btn">Delete</a>
                </td>
            </tr>
            <tr>
                <td data-label="Id">2</td>
                <td data-label="Product">Product B</td>
                <td data-label="Image"><img src="https://via.placeholder.com/50" class="product-img"></td>
                <td data-label="Admin Purchase">Purchase #2</td>
                <td data-label="Admin">Admin B</td>
                <td data-label="Supplier">Supplier Y</td>
                <td data-label="Quantity">5</td>
                <td data-label="Reason">Wrong item</td>
                <td data-label="Status">Approved</td>
                <td data-label="Action">
                    <a href="#" class="action-btn edit-btn">Edit</a>
                    <a href="#" class="action-btn delete-btn">Delete</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
@endsection