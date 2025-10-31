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
      padding: 0;
    }

    .container {
      width: 420px;
      background: #fff;
      margin: 10px auto;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #555;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 15px;
      font-weight: bold;
    }

    button:hover {
      background-color: #0056b3;
    }

    input[readonly] {
      background: #f9f9f9;
    }
  </style>
</head>
<body>

<div class="container">
    <h2>Add Stock</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('inventory.store_stock') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="product_id">Select Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="">-- Select Product --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->product_name }} 
                        (Remaining Stock: {{ $product->remaining_stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>

        <div class="form-group">
            <label for="vendor_price">Vendor Price</label>
            <input type="number" name="vendor_price" class="form-control" min="0" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="Available">Available</option>
                <option value="Sold Out">Sold Out</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Add Stock</button>
    </form>
</div>


</body>
@endsection