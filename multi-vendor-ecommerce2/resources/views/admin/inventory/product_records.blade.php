@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f5f6fa;
      margin: 0;
    }

    h2 {
      text-align: center;
      color: #007bff;
      margin-bottom: 25px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      font-size: 14px;
    }

    th {
      background-color: #007bff;
      color: #fff;
      text-transform: uppercase;
      font-size: 13px;
      letter-spacing: 0.5px;
    }

    tr:hover {
      background: #f1f2f6;
    }

    img {
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
      font-size: 12px;
    }

    .inactive {
      background: #f8d7da;
      color: #721c24;
    }

    .featured {
      background: #fff3cd;
      color: #856404;
      padding: 5px 10px;
      border-radius: 5px;
      font-weight: bold;
      font-size: 12px;
    }

    .actions {
      display: flex;
      gap: 8px;
    }

    .btn {
      padding: 6px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 12px;
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

<h2>Product List</h2>

<table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Product Name</th>
        <th>SKU</th>
        <th>Category</th>
        <th>Subcategory</th>
        <th>Supplier</th>
        <th>Base Price (৳)</th>
        <th>Color</th>
        <th>Size</th>
        <th>Featured</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      @forelse($products as $p)
      <tr>
        <td>{{ $p->id }}</td>
        <td>
            @if($p->product_image)
                <img src="{{ asset('product_images/'.$p->product_image) }}" alt="Product Image" width="80">
            @else
                <img src="https://via.placeholder.com/80" alt="Product Image">
            @endif
        </td>
        <td>{{ $p->product_name }}</td>
        <td>{{ $p->sku }}</td>
        <td>{{ $p->category->category_name ?? 'N/A' }}</td>
        <td>{{ $p->subcategory->name ?? 'N/A' }}</td>
        <td>{{ $p->supplier->supplier_name ?? 'N/A' }}</td>
        <td>{{ number_format((float) $p->base_price, 2) }}</td>
        <td>{{ $p->color }}</td>
        <td>{{ $p->size }}</td>
        <td><span class="featured">{{ $p->featured }}</span></td>
        <td><span class="status {{ strtolower($p->status) }}">{{ $p->status }}</span></td>
        <td>{{ $p->created_at->format('Y-m-d') }}</td>
        <td class="actions">
          <a href="{{ route('inventory.product.view', $p->id) }}" class="btn btn-view">View</a>
          <a href="{{ route('inventory.product.edit', $p->id) }}" class="btn btn-edit">Edit</a>
          <a href="{{ route('inventory.product.delete', $p->id) }}" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="14">No products found.</td>
      </tr>
      @endforelse
    </tbody>
  </table>

</body>
@endsection