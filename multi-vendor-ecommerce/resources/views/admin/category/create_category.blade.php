@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f1f5f9;
      margin: 0;
    }

    .container {
      max-width: 600px;
      background: #fff;
      padding: 30px 40px;
      margin: auto;
      border-radius: 12px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #007bff;
      margin-bottom: 25px;
      letter-spacing: 0.5px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 5px;
      color: #333;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
      margin-bottom: 15px;
      outline: none;
      transition: 0.3s;
    }

    input:focus,
    textarea:focus {
      border-color: #007bff;
      box-shadow: 0 0 3px rgba(0,123,255,0.3);
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    .radio-group {
      display: flex;
      gap: 20px;
      margin-bottom: 15px;
    }

    button {
      width: 100%;
      padding: 12px;
      border: none;
      background: #007bff;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border-radius: 6px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Add New Category</h2>
        <!-- Success Message -->
    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="category_name">Category Name:</label>
    <input type="text" id="category_name" name="category_name" placeholder="Enter category name" required>

    <label for="slug">Slug:</label>
    <input type="text" id="slug" name="slug" placeholder="Enter slug (optional)">

    <label for="description">Description:</label>
    <textarea id="description" name="description" placeholder="Enter category description"></textarea>

    <label for="category_image">Category Image:</label>
    <input type="file" id="category_image" name="category_image" accept="image/*">

    <label>Status:</label>
    <div class="radio-group">
        <label><input type="radio" name="status" value="Active" checked> Active</label>
        <label><input type="radio" name="status" value="Inactive"> Inactive</label>
    </div>

    <button type="submit">Save Category</button>
</form>
 
  </div>

</body>

@endsection