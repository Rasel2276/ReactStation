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
</head>
<body>

<h2>Purchase Return Form</h2>

<div class="form-container">
    <form id="purchaseReturnForm">
        <!-- Admin Purchase -->
        <div class="form-group">
            <label for="admin_purchase_id">Admin Purchase</label>
            <select id="admin_purchase_id" name="admin_purchase_id" required>
                <option value="">-- Select Purchase --</option>
                <option value="1">Purchase #1</option>
                <option value="2">Purchase #2</option>
            </select>
        </div>

        <!-- Admin -->
        <div class="form-group">
            <label for="admin_id">Admin</label>
            <select id="admin_id" name="admin_id" required>
                <option value="">-- Select Admin --</option>
                <option value="1">Admin A</option>
                <option value="2">Admin B</option>
            </select>
        </div>

        <!-- Supplier -->
        <div class="form-group">
            <label for="supplier_id">Supplier</label>
            <select id="supplier_id" name="supplier_id" required>
                <option value="">-- Select Supplier --</option>
                <option value="1">Supplier A</option>
                <option value="2">Supplier B</option>
            </select>
        </div>

        <!-- Product -->
        <div class="form-group">
            <label for="product_id">Product</label>
            <select id="product_id" name="product_id" required>
                <option value="">-- Select Product --</option>
                <option value="1">Product A</option>
                <option value="2">Product B</option>
            </select>
        </div>

        <!-- Quantity -->
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" min="1" required placeholder="Enter quantity to return">
        </div>

        <!-- Status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="Pending" selected>Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
                <option value="Completed">Completed</option>
            </select>
        </div>

        <!-- Reason -->
        <div class="form-group full-width">
            <label for="reason">Reason</label>
            <textarea id="reason" name="reason" rows="3" placeholder="Enter reason for return"></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="submit-btn">Submit Return</button>
    </form>
</div>

<script>
    document.getElementById('purchaseReturnForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Form submitted! Laravel backend can handle this now.');
    });
</script>

</body>
@endsection
