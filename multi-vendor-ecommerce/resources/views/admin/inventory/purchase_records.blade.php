@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')
<style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f8;
      margin: 0;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
      font-size: 14px;
    }

    th {
      background-color: #007bff;
      color: white;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #eaf2ff;
    }

    .status-pending {
      color: #ff9800;
      font-weight: bold;
    }
    .status-completed {
      color: #28a745;
      font-weight: bold;
    }
    .status-cancelled {
      color: #dc3545;
      font-weight: bold;
    }

    .btn {
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      color: white;
      cursor: pointer;
    }
    .btn-edit {
      background: #17a2b8;
    }
    .btn-delete {
      background: #dc3545;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Admin Purchase List</h2>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Supplier</th>
          <th>Product</th>
          <th>Quantity</th>
          <th>Purchase Price</th>
          <th>Total</th>
          <th>Purchase Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Supplier 1</td>
          <td>Product 1</td>
          <td>10</td>
          <td>100.00</td>
          <td>1000.00</td>
          <td>2025-10-30</td>
          <td>
            <button class="btn btn-edit">Edit</button>
            <button class="btn btn-delete">Delete</button>
          </td>
        </tr>

        <tr>
          <td>2</td>
          <td>Supplier 2</td>
          <td>Product 2</td>
          <td>5</td>
          <td>150.00</td>
          <td>750.00</td>
          <td>2025-10-29</td>
          <td>
            <button class="btn btn-edit">Edit</button>
            <button class="btn btn-delete">Delete</button>
          </td>
        </tr>

        <tr>
          <td>3</td>
          <td>Supplier 1</td>
          <td>Product 3</td>
          <td>8</td>
          <td>120.00</td>
          <td>960.00</td>
          <td>2025-10-28</td>
          <td>
            <button class="btn btn-edit">Edit</button>
            <button class="btn btn-delete">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</body>
@endsection