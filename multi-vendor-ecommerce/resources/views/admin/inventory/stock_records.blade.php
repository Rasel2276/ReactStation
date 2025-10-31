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

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #1b1b1b;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background: #007bff; /* Blue heading background */
      color: white;
    }

    tr:hover {
      background: #f1f2f6;
    }

    .product {
      display: flex;
      align-items: center;
      gap: 10px;
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
    }

    .delete-btn {
      background: #dc3545;
    }

    .delete-btn:hover {
      background: #bb2d3b;
    }
  </style>
</head>
<body>

  <h2>Admin Stock</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Vendor Price</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>
          <div class="product">
            <img src="https://via.placeholder.com/80" alt="Product Image">
            <span>Wooden Chair</span>
          </div>
        </td>
        <td>50</td>
        <td>৳ 850.00</td>
        <td><span class="status available">Available</span></td>
        <td>2025-10-31 10:45</td>
        <td>
          <button class="action-btn delete-btn">Delete</button>
        </td>
      </tr>

      <tr>
        <td>2</td>
        <td>
          <div class="product">
            <img src="https://via.placeholder.com/80" alt="Product Image">
            <span>Modern Lamp</span>
          </div>
        </td>
        <td>0</td>
        <td>৳ 300.00</td>
        <td><span class="status soldout">Sold Out</span></td>
        <td>2025-10-29 17:30</td>
        <td>
          <button class="action-btn delete-btn">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>

</body>

@endsection