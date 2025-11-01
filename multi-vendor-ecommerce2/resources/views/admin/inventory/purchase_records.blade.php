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
        <th>Image</th>
        <th>Quantity</th>
        <th>Purchase Price</th>
        <th>Total</th>
        <th>Purchase Date</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tbody>
      @foreach($purchases as $purchase)
      <tr>
        <td>{{ $purchase->id }}</td>
        <td>{{ $purchase->supplier->supplier_name ?? 'N/A' }}</td>
        <td>{{ $purchase->product->product_name ?? 'N/A' }}</td>
        <td>
          @if($purchase->product && $purchase->product->product_image)
            <img src="{{ asset('product_images/'.$purchase->product->product_image) }}" alt="Image" width="50">
          @else
            N/A
          @endif
        </td>
        <td>{{ $purchase->quantity }}</td>
        <td>{{ number_format($purchase->purchase_price,2) }}</td>
        <td>{{ number_format($purchase->quantity*$purchase->purchase_price,2) }}</td>
        <td>{{ $purchase->purchase_date }}</td>
        <td>{{ $purchase->status }}</td>
        <td>
          <a href="{{ route('inventory.edit_purchase',$purchase->id) }}" class="btn btn-edit">Edit</a>
          <a href="{{ route('inventory.delete_purchase',$purchase->id) }}" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

</body>
@endsection