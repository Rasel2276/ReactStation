@extends('admin.layouts.layout')

@section('admin_page_title')
Add Product Discount - Admin Panel
@endsection

@section('admin_layout')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    body {
        background-color: #f0f2f5;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    .form-wrapper {
        background: #fff;
        width: 80%;
        max-width: 750px;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        padding: 30px 40px;
        margin: 50px auto;
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(-20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    h2 {
        text-align: center;
        color: #182848;
        font-weight: 600;
        margin-bottom: 25px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .form-row {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .form-row label {
        width: 200px;
        font-weight: 500;
        color: #182848;
    }

    .form-row input[type="text"],
    .form-row input[type="number"],
    .form-row input[type="date"],
    .form-row select {
        flex: 1;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        background-color: #f9fafc;
        transition: all 0.3s ease;
    }

    .form-row input:focus,
    .form-row select:focus {
        border-color: #4b6cb7;
        box-shadow: 0 0 5px rgba(75,108,183,0.4);
        outline: none;
    }

    .submit-btn {
        align-self: flex-end;
        background: linear-gradient(90deg, #4b6cb7, #182848);
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .submit-btn:hover {
        background: linear-gradient(90deg, #3f5fa8, #0f1f3a);
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            align-items: flex-start;
        }
        .form-row label {
            width: 100%;
        }
        .submit-btn {
            align-self: center;
            width: 100%;
        }
    }
</style>
</head>
<body>

<div class="form-wrapper">
    <h2>Add Product Discount</h2>
    <form action="{{ route('discount.store_discount') }}" method="POST">
        @csrf
        <div class="form-row">
            <label for="product_id">Select Product:</label>
            <select id="product_id" name="product_id" required>
                <option value="">-- Select Product --</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <label for="discount_for">Discount For:</label>
            <select id="discount_for" name="discount_for" required>
                <option value="Customer">Customer</option>
                <option value="Vendor">Vendor</option>
                <option value="Supplier">Supplier</option>
            </select>
        </div>

        <div class="form-row">
            <label for="discount_type">Discount Type:</label>
            <select id="discount_type" name="discount_type" required>
                <option value="">-- Select Type --</option>
                <option value="Percentage">Percentage (%)</option>
                <option value="Fixed Amount">Fixed Amount</option>
            </select>
        </div>

        <div class="form-row">
            <label for="discount_value">Discount Value:</label>
            <input type="number" id="discount_value" name="discount_value" step="0.01" required>
        </div>

        <div class="form-row">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date" required>
        </div>

        <div class="form-row">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date" required>
        </div>

        <div class="form-row">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="submit-btn">Add Discount</button>
    </form>
</div>

</body>
@endsection
