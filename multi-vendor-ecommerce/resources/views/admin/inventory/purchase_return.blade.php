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
      max-width: 700px;
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

    .note {
      text-align: center;
      color: #666;
      font-size: 14px;
      margin-top: 15px;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Supplier Purchase Return Form</h2>
    <form action="#" method="POST">
      <!-- Admin Purchase ID -->
      <label for="admin_purchase_id">Admin Purchase ID:</label>
      <select id="admin_purchase_id" name="admin_purchase_id" required>
        <option value="">Select Purchase</option>
        <option value="1">Purchase #1</option>
        <option value="2">Purchase #2</option>
      </select>

      <!-- Admin ID -->
      <label for="admin_id">Admin:</label>
      <select id="admin_id" name="admin_id" required>
        <option value="">Select Admin</option>
        <option value="1">Admin 1</option>
        <option value="2">Admin 2</option>
      </select>

      <!-- Supplier ID -->
      <label for="supplier_id">Supplier:</label>
      <select id="supplier_id" name="supplier_id" required>
        <option value="">Select Supplier</option>
        <option value="1">ABC Traders</option>
        <option value="2">Modern Supply Ltd</option>
      </select>

      <!-- Product ID -->
      <label for="product_id">Product:</label>
      <select id="product_id" name="product_id" required>
        <option value="">Select Product</option>
        <option value="1">Wooden Chair</option>
        <option value="2">LED Lamp</option>
      </select>

      <!-- Quantity -->
      <label for="quantity">Return Quantity:</label>
      <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" min="1" required>

      <!-- Reason -->
      <label for="reason">Reason for Return:</label>
      <textarea id="reason" name="reason" placeholder="Enter reason for return" required></textarea>

      <!-- Status -->
      <label for="status">Return Status:</label>
      <select id="status" name="status" required>
        <option value="Pending">Pending</option>
        <option value="Approved">Approved</option>
        <option value="Rejected">Rejected</option>
        <option value="Completed">Completed</option>
      </select>

      <button type="submit">Submit Return</button>

      <p class="note">* Submitting this form will automatically decrease the stock quantity for the selected product.</p>
    </form>
  </div>

</body>


@endsection