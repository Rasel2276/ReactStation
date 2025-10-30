@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')

  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f4f8;
      margin: 0;
      padding: 0;
    }

    .form-container {
      width: 400px;
      background: #fff;
      margin: 10px auto;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      color: #555;
      font-weight: bold;
    }

    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    button {
      width: 100%;
      background: #007bff;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Add Supplier</h2>
    <form action="#" method="POST">
      <!-- Laravel e use korle ekhane @csrf add korben -->

      <label for="supplier_name">Supplier Name</label>
      <input type="text" id="supplier_name" name="supplier_name" placeholder="Enter supplier name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter email">

      <label for="phone">Phone</label>
      <input type="text" id="phone" name="phone" placeholder="Enter phone number">

      <label for="address">Address</label>
      <textarea id="address" name="address" placeholder="Enter address"></textarea>

      <label for="contact_person">Contact Person</label>
      <input type="text" id="contact_person" name="contact_person" placeholder="Enter contact person">

      <label for="status">Status</label>
      <select id="status" name="status">
        <option value="Active" selected>Active</option>
        <option value="Inactive">Inactive</option>
      </select>

      <button type="submit">Save Supplier</button>
    </form>
  </div>

</body>

@endsection