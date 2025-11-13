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
      width: 700px;
      background: #fff;
      margin: 20px auto;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    .form-row {
      display: flex;
      gap: 20px;
      margin-bottom: 15px;
    }

    .form-group {
      flex: 1;
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
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    textarea {
      height: 80px;
      resize: vertical;
    }

    button {
      width: 100%;
      background: #007bff;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      margin-top: 10px;
    }

    button:hover {
      background: #0056b3;
    }
</style>

<div class="form-container">
    <h2>Add Supplier</h2>

    @if(session('success'))
        <div style="color:green;margin-bottom:15px;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('inventory.store_supplier') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label>Supplier Name</label>
                <input type="text" name="supplier_name" value="{{ old('supplier_name') }}" required>
                @error('supplier_name')<div style="color:red">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email')<div style="color:red">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}">
                @error('phone')<div style="color:red">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Contact Person</label>
                <input type="text" name="contact_person" value="{{ old('contact_person') }}">
                @error('contact_person')<div style="color:red">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Address</label>
                <textarea name="address">{{ old('address') }}</textarea>
                @error('address')<div style="color:red">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status">
                    <option value="Active" {{ old('status')=='Active'?'selected':'' }}>Active</option>
                    <option value="Inactive" {{ old('status')=='Inactive'?'selected':'' }}>Inactive</option>
                </select>
            </div>
        </div>

        <button type="submit">Save Supplier</button>
    </form>
</div>

@endsection