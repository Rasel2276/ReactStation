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

  <div class="container">
    <h2>Supplier Purchase Returns</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" style="width:100%; border-collapse:collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Purchase ID</th>
                <th>Admin</th>
                <th>Supplier</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Return Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($returns as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>#{{ $r->admin_purchase_id }}</td>
                <td>{{ $r->admin->name ?? 'N/A' }}</td>
                <td>{{ $r->supplier->supplier_name ?? 'N/A' }}</td>
                <td>{{ $r->product_name ?? ($r->product->product_name ?? 'N/A') }}</td>
                <td>
                    @if($r->product_image)
                        <img src="{{ asset('product_images/'.$r->product_image) }}" width="60" alt="img">
                    @elseif($r->product && $r->product->product_image)
                        <img src="{{ asset('product_images/'.$r->product->product_image) }}" width="60" alt="img">
                    @else
                        <img src="https://via.placeholder.com/60" alt="img">
                    @endif
                </td>
                <td>{{ $r->quantity }}</td>
                <td>{{ \Illuminate\Support\Str::limit($r->reason, 40) }}</td>
                <td>{{ $r->status }}</td>
                <td>{{ \Carbon\Carbon::parse($r->return_date)->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="">View</a>
                    <a href="{{ route('inventory.edit_return',$r->id) }}">Edit</a>
                    <a href="{{ route('inventory.delete_return',$r->id) }}" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>

@endsection