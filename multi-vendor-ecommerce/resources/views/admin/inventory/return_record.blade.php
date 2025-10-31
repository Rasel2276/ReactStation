@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #f5f6fa;
      margin: 0;
    }

    h2 {
      text-align: center;
      color: #007bff;
      margin-bottom: 25px;
      letter-spacing: 0.5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      font-size: 15px;
    }

    th {
      background-color: #007bff;
      color: white;
      text-transform: uppercase;
      font-size: 14px;
    }

    tr:hover {
      background: #f1f2f6;
    }

    .status {
      padding: 5px 10px;
      border-radius: 5px;
      font-weight: bold;
      font-size: 13px;
    }

    .pending { background: #fff3cd; color: #856404; }
    .approved { background: #d4edda; color: #155724; }
    .rejected { background: #f8d7da; color: #721c24; }
    .completed { background: #d1ecf1; color: #0c5460; }

    .actions {
      display: flex;
      gap: 8px;
    }

    .btn {
      padding: 6px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 13px;
      font-weight: 600;
      transition: 0.3s;
    }

    .btn-view {
      background: #17a2b8;
      color: white;
    }

    .btn-edit {
      background: #ffc107;
      color: white;
    }

    .btn-delete {
      background: #dc3545;
      color: white;
    }

    .btn:hover {
      opacity: 0.85;
    }
  </style>
</head>
<body>

  <h2>Supplier Purchase Returns</h2>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Admin Purchase ID</th>
        <th>Admin</th>
        <th>Supplier</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Return Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>#1001</td>
        <td>Admin A</td>
        <td>ABC Traders</td>
        <td>Wooden Chair</td>
        <td>10</td>
        <td>Damaged items received</td>
        <td><span class="status pending">Pending</span></td>
        <td>2025-10-31 11:00</td>
        <td class="actions">
          <button class="btn btn-view">View</button>
          <button class="btn btn-edit">Edit</button>
          <button class="btn btn-delete">Delete</button>
        </td>
      </tr>

      <tr>
        <td>2</td>
        <td>#1002</td>
        <td>Admin B</td>
        <td>Modern Supply Ltd</td>
        <td>LED Lamp</td>
        <td>5</td>
        <td>Product color mismatch</td>
        <td><span class="status approved">Approved</span></td>
        <td>2025-10-30 16:45</td>
        <td class="actions">
          <button class="btn btn-view">View</button>
          <button class="btn btn-edit">Edit</button>
          <button class="btn btn-delete">Delete</button>
        </td>
      </tr>
    </tbody>
  </table>

</body>

@endsection