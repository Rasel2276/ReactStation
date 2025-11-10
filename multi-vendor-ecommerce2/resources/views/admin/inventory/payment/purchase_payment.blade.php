@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')

<style>
    body {
        font-family: 'Segoe UI', Tahoma, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 20px 0;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        font-weight: 700;
        color: #2c3e50;
    }

    .layout {
        display: flex;
        gap: 25px;
        max-width: 1300px;
        margin: auto;
    }

    /* ✅ LEFT: Vertical Card List */
    .left-table {
        flex: 2;
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .item-card {
        background: #ffffff;
        padding: 18px 25px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        transition: all 0.3s ease;
    }

    .item-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    .item {
        font-size: 15px;
        color: #555;
        min-width: 80px;
        text-align: center;
    }

    .item strong {
        font-weight: 600;
        color: #222;
        display: block;
        margin-bottom: 4px;
    }

    /* ✅ RIGHT PAYMENT BOX */
    .right-payment {
        flex: 1;
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .payment-title {
        font-size: 24px;
        text-align: center;
        margin-bottom: 25px;
        font-weight: 700;
        color: #2c3e50;
        border-bottom: 1px solid #e1e4e8;
        padding-bottom: 12px;
    }

    label {
        margin-bottom: 6px;
        display: block;
        font-weight: 600;
        color: #333;
    }

    select, input {
        width: 100%;
        padding: 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 15px;
        transition: 0.2s;
    }

    select:focus, input:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
    }

    button {
        width: 100%;
        padding: 16px;
        background: #3498db;
        border: none;
        font-size: 16px;
        color: #fff;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: 0.3s;
    }

    button:hover {
        background: #2980b9;
    }

    @media(max-width: 900px){
        .layout {
            flex-direction: column;
        }
        .item {
            min-width: 70px;
            font-size: 14px;
        }
    }
</style>

<body>

<h2>Purchase List & Payment Section</h2>

<div class="layout">

    <!-- ✅ LEFT: Vertical Card List -->
    <div class="left-table">

        <div class="item-card">
            <div class="item"><strong>ID</strong> 1</div>
            <div class="item"><strong>Supplier</strong> ABC</div>
            <div class="item"><strong>Product</strong> Product A</div>
            <div class="item"><strong>Qty</strong> 10</div>
            <div class="item"><strong>Base Price</strong> 120</div>
            <div class="item"><strong>Total</strong> 1500</div>
        </div>

        <div class="item-card">
            <div class="item"><strong>ID</strong> 2</div>
            <div class="item"><strong>Supplier</strong> XYZ</div>
            <div class="item"><strong>Product</strong> Product B</div>
            <div class="item"><strong>Qty</strong> 5</div>
            <div class="item"><strong>Base Price</strong> 280</div>
            <div class="item"><strong>Total</strong> 1500</div>
        </div>

        <div class="item-card">
            <div class="item"><strong>ID</strong> 3</div>
            <div class="item"><strong>Supplier</strong> DEF</div>
            <div class="item"><strong>Product</strong> Product C</div>
            <div class="item"><strong>Qty</strong> 8</div>
            <div class="item"><strong>Base Price</strong> 200</div>
            <div class="item"><strong>Total</strong> 2400</div>
        </div>

    </div>

    <!-- ✅ RIGHT PAYMENT -->
    <div class="right-payment">

        <div class="payment-title">Payment Section</div>

        <form>
            <label>Total Payable Amount</label>
            <input type="text" readonly value="5400.00">

            <label>Payment Method</label>
            <select required>
                <option value="">-- Select Method --</option>
                <option>Cash</option>
                <option>Bank</option>
                <option>Bkash</option>
                <option>Nagad</option>
                <option>Rocket</option>
            </select>

            <button type="submit">Submit Payment</button>
        </form>

    </div>

</div>

</body>

@endsection