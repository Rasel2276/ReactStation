@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        margin-top: 40px;
        color: #333;
        font-size: 28px;
    }

    .form-container {
        max-width: 900px;
        margin: 30px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        flex: 1 1 45%;
    }

    label {
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }

    select, input, textarea {
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
    }

    .full-width {
        flex: 1 1 100%;
    }

    .submit-btn {
        padding: 12px 20px;
        background: #3498db;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
        transition: 0.3s;
        flex: 1 1 100%;
    }

    .submit-btn:hover {
        background: #2980b9;
    }

    /* Responsive */
    @media(max-width: 768px){
        .form-group {
            flex: 1 1 100%;
        }
    }
</style>

<div class="form-container">
    <h2>Supplier Return Form</h2>
    @if(session('error'))
<div style="color:red; margin-bottom:15px;">{{ session('error') }}</div>
@endif


    @if(session('success'))
    <div style="color:green; margin-bottom:15px;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('inventory.store_supplier_return') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Admin Purchase</label>
            <select name="admin_purchase_id" required>
                <option value="">--Select Purchase--</option>
                @foreach($purchases as $purchase)
                <option value="{{ $purchase->id }}">
                    Purchase #{{ $purchase->id }} ({{ $purchase->product->product_name }})
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Admin</label>
            <select name="admin_id" required>
                <option value="">--Select Admin--</option>
                @foreach($admins as $admin)
                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Supplier</label>
            <select name="supplier_id" required>
                <option value="">--Select Supplier--</option>
                @foreach($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Product</label>
            <select name="product_id" required>
                <option value="">--Select Product--</option>
                @foreach($purchases as $purchase)
                <option value="{{ $purchase->product_id }}">{{ $purchase->product->product_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="number" name="quantity" min="1" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" required>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Completed">Completed</option>
            </select>
        </div>

        <div class="form-group full-width">
            <label>Reason</label>
            <textarea name="reason" rows="3"></textarea>
        </div>

        <button type="submit" class="submit-btn">Submit Return</button>
    </form>
</div>
@endsection
