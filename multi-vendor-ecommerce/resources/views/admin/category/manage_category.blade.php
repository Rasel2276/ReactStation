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

  <div class="container">
    <h2>Manage Categories</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Image</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>
                    @if($category->category_image)
                        <img src="{{ asset('category_images/'.$category->category_image) }}" width="80" alt="Category Image">
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <span class="status {{ strtolower($category->status) }}">{{ $category->status }}</span>
                </td>
                <td class="actions">
                    <a href="{{ route('category.edit', $category->id) }}"><button class="btn btn-edit">Edit</button></a>
                    <a href="{{ route('category.delete', $category->id) }}" onclick="return confirm('Are you sure you want to delete this category?')">
                        <button class="btn btn-delete">Delete</button>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection