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
    <h2>Add Admin Stock</h2>

    <form action="#" method="POST" id="stockForm">
      <!-- Laravel এ ব্যবহার করলে এখানে @csrf যোগ করবেন -->

      <label for="product_id">Product</label>
      <select id="product_id" name="product_id" required>
        <option value="">-- Select Product --</option>
        <option value="1">Product 1</option>
        <option value="2">Product 2</option>
        <option value="3">Product 3</option>
      </select>

      <label for="quantity">Quantity</label>
      <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" required>

      <label for="vendor_price">Vendor Price (per unit)</label>
      <input type="number" step="0.01" id="vendor_price" name="vendor_price" placeholder="Enter vendor price" required>

      <label for="status">Status</label>
      <select id="status" name="status">
        <option value="Available" selected>Available</option>
        <option value="Sold Out">Sold Out</option>
      </select>

      <button type="submit">Save Stock</button>
    </form>
  </div>

</body>
@endsection