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
      max-width: 800px;
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
    input[type="number"],
    select,
    textarea {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
      margin-bottom: 15px;
      transition: 0.3s;
      outline: none;
    }

    input:focus,
    select:focus,
    textarea:focus {
      border-color: #007bff;
      box-shadow: 0 0 3px rgba(0,123,255,0.3);
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    .form-row {
      display: flex;
      gap: 15px;
    }

    .form-row > div {
      flex: 1;
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
    <h2>Add New Product</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('inventory.store_product') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Product Name -->
      <label for="product_name">Product Name:</label>
      <input type="text" id="product_name" name="product_name" placeholder="Enter product name" value="{{ old('product_name') }}" required>
      @error('product_name')<div style="color:red">{{ $message }}</div>@enderror

      <!-- SKU -->
      <label for="sku">SKU (Stock Keeping Unit):</label>
      <input type="text" id="sku" name="sku" placeholder="Enter SKU" value="{{ old('sku') }}">
      @error('sku')<div style="color:red">{{ $message }}</div>@enderror

      <!-- Category & Subcategory -->
      <div class="form-row">
        <div>
          <label for="category_id">Category:</label>
          <select id="category_id" name="category_id" required>
            <option value="">Select Category</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                {{ $cat->category_name }}
              </option>
            @endforeach
          </select>
          @error('category_id')<div style="color:red">{{ $message }}</div>@enderror
        </div>
        <div>
          <label for="subcategory_id">Subcategory:</label>
          <select id="subcategory_id" name="subcategory_id">
            <option value="">Select Subcategory</option>
            @foreach($subcategories as $sub)
              <option value="{{ $sub->id }}" {{ old('subcategory_id') == $sub->id ? 'selected' : '' }}>
                {{ $sub->name }}
              </option>
            @endforeach
          </select>
          @error('subcategory_id')<div style="color:red">{{ $message }}</div>@enderror
        </div>
      </div>

      <!-- Supplier -->
      <label for="supplier_id">Supplier:</label>
      <select id="supplier_id" name="supplier_id">
        <option value="">Select Supplier</option>
        @foreach($suppliers as $sup)
          <option value="{{ $sup->id }}" {{ old('supplier_id') == $sup->id ? 'selected' : '' }}>
            {{ $sup->supplier_name }}
          </option>
        @endforeach
      </select>
      @error('supplier_id')<div style="color:red">{{ $message }}</div>@enderror

      <!-- Base Price -->
      <label for="base_price">Base Price (৳):</label>
      <input type="number" id="base_price" name="base_price" placeholder="Enter base price" step="0.01" value="{{ old('base_price') }}">
      @error('base_price')<div style="color:red">{{ $message }}</div>@enderror

      <!-- Description -->
      <label for="description">Description:</label>
      <textarea id="description" name="description" placeholder="Enter product details">{{ old('description') }}</textarea>
      @error('description')<div style="color:red">{{ $message }}</div>@enderror

      <!-- Product Image -->
      <label for="product_image">Product Image:</label>
      <input type="file" id="product_image" name="product_image" accept="image/*">
      @error('product_image')<div style="color:red">{{ $message }}</div>@enderror

      <!-- Color & Size -->
      <div class="form-row">
        <div>
          <label for="color">Color:</label>
          <input type="text" id="color" name="color" placeholder="e.g. Red, Blue" value="{{ old('color') }}">
        </div>
        <div>
          <label for="size">Size:</label>
          <input type="text" id="size" name="size" placeholder="e.g. Medium, Large" value="{{ old('size') }}">
        </div>
      </div>

      <!-- Featured -->
      <label>Featured Product:</label>
      <div class="radio-group">
        <label><input type="radio" name="featured" value="Yes" {{ old('featured') == 'Yes' ? 'checked' : '' }}> Yes</label>
        <label><input type="radio" name="featured" value="No" {{ old('featured', 'No') == 'No' ? 'checked' : '' }}> No</label>
      </div>

      <!-- Status -->
      <label>Status:</label>
      <div class="radio-group">
        <label><input type="radio" name="status" value="Active" {{ old('status', 'Active') == 'Active' ? 'checked' : '' }}> Active</label>
        <label><input type="radio" name="status" value="Inactive" {{ old('status') == 'Inactive' ? 'checked' : '' }}> Inactive</label>
      </div>

      <button type="submit">Save Product</button>
    </form>
  </div>

</body>

@endsection