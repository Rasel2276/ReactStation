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

    @if(session('success'))
        <div style="color:green;margin-bottom:15px;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('inventory.store_supplier') }}" method="POST">
        @csrf

        <label for="supplier_name">Supplier Name</label>
        <input type="text" id="supplier_name" name="supplier_name" value="{{ old('supplier_name') }}" placeholder="Enter supplier name" required>
        @error('supplier_name')<div style="color:red">{{ $message }}</div>@enderror

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email">
        @error('email')<div style="color:red">{{ $message }}</div>@enderror

        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number">
        @error('phone')<div style="color:red">{{ $message }}</div>@enderror

        <label for="address">Address</label>
        <textarea id="address" name="address" placeholder="Enter address">{{ old('address') }}</textarea>
        @error('address')<div style="color:red">{{ $message }}</div>@enderror

        <label for="contact_person">Contact Person</label>
        <input type="text" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" placeholder="Enter contact person">
        @error('contact_person')<div style="color:red">{{ $message }}</div>@enderror

        <label for="status">Status</label>
        <select id="status" name="status">
            <option value="Active" {{ old('status')=='Active'?'selected':'' }}>Active</option>
            <option value="Inactive" {{ old('status')=='Inactive'?'selected':'' }}>Inactive</option>
        </select>

        <button type="submit">Save Supplier</button>
    </form>
</div>


@endsection