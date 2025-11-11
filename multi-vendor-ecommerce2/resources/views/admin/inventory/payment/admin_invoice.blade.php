@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')


<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #f9f9f9;
        margin: 0;
    }

    .invoice-container {
        max-width: 900px;
        margin: auto;
        background: #ffffff;
        padding: 50px 60px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }

    h1, h2, h3, h4 {
        margin: 0;
        padding: 0;
    }

    /* Header */
    .top-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .company-info {
        font-size: 14px;
        line-height: 1.7;
    }

    .upload-logo-box {
        border: 2px dashed #d8c08a;
        padding: 30px 40px;
        border-radius: 10px;
        text-align: center;
        color: #caa45f;
        font-weight: 600;
        font-size: 14px;
    }

    /* Invoice title */
    .invoice-title {
        margin-top: 40px;
        text-align: right;
    }

    .invoice-title h2 {
        font-size: 40px;
        font-weight: 700;
        color: #caa45f;
        letter-spacing: 3px;
        line-height: 1.1;
    }

    /* Bill to + invoice info */
    .bill-section {
        margin-top: 50px;
        display: flex;
        justify-content: space-between;
    }

    .bill-left h4 {
        color: #caa45f;
        margin-bottom: 5px;
        font-size: 14px;
        font-weight: 600;
    }

    .bill-left p {
        font-size: 15px;
        margin: 2px 0;
    }

    .bill-right p {
        font-size: 14px;
        margin: 4px 0;
    }

    .bill-right span {
        font-weight: 600;
        display: inline-block;
        width: 120px;
    }

    /* TABLE */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 40px;
        font-size: 15px;
    }

    thead {
        background: #caa45f;
        color: white;
    }

    thead th {
        padding: 14px;
        text-align: left;
        font-weight: 600;
    }

    tbody td {
        padding: 14px;
        border-bottom: 1px solid #ddd;
    }

    /* Totals */
    .totals-section {
        margin-top: 40px;
        width: 300px;
        margin-left: auto;
        font-size: 15px;
    }

    .totals-section p {
        display: flex;
        justify-content: space-between;
        margin: 8px 0;
    }

    .totals-section .total-row {
        font-weight: 800;
        color: #caa45f;
        border-top: 2px solid #caa45f;
        padding-top: 10px;
        margin-top: 10px;
    }

    /* Terms */
    .terms {
        margin-top: 60px;
        font-size: 14px;
        line-height: 1.6;
    }

    .terms h4 {
        color: #caa45f;
        margin-bottom: 5px;
    }
</style>

</head>
<body>

<div class="invoice-container">

    <!-- TOP SECTION -->
    <div class="top-section">
        <div class="company-info">
            <strong>Your Company Inc.</strong><br>
            1234 Company St,<br>
            Company Town, ST 12345
        </div>

        <div class="upload-logo-box">
            ☁ Upload Logo
        </div>
    </div>

    <!-- TITLE -->
    <div class="invoice-title">
        <h2>ECOMMERCE<br>INVOICE</h2>
    </div>

    <!-- BILL TO SECTION -->
    <div class="bill-section">
        <div class="bill-left">
            <h4>Bill To</h4>
            <p><strong>Customer Name</strong></p>
            <p>1234 Customer St,</p>
            <p>Customer Town, ST 12345</p>
        </div>

        <div class="bill-right">
            <p><span>Invoice #</span> 0000007</p>
            <p><span>Invoice date</span> 10-02-2025</p>
            <p><span>Due date</span> 10-16-2025</p>
            <p><span>Total Quantity</span> 7</p> <!-- ✅ Added Total Quantity -->
        </div>
    </div>

    <!-- PRODUCT TABLE -->
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>QTY</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Wireless earbuds</td>
                <td>2</td>
                <td>50.00</td>
                <td>$100.00</td>
            </tr>

            <tr>
                <td>Smartwatch</td>
                 <td>1</td>
                <td>120.00</td>
                <td>$120.00</td>
            </tr>

            <tr>
                <td>Phone charging cables</td>
                <td>3</td>
                <td>15.00</td>
                <td>$45.00</td>
            </tr>

            <tr>
                <td>Laptop backpack</td>
                <td>1</td>
                <td>80.00</td>
                <td>$80.00</td>
            </tr>
        </tbody>
    </table>

    <!-- TOTALS -->
    <div class="totals-section">
        <p><span>Subtotal</span> $345.00</p>
        <p><span>Sales Tax (5%)</span> $17.25</p>

        <p class="total-row"><span>Total (USD)</span> $362.25</p>
    </div>

    <!-- TERMS -->
    <div class="terms">
        <h4>Terms and Conditions</h4>
        <p>Payment is due in 14 days.</p>
        <p>Please make checks payable to: Your Company Inc.</p>
    </div>

</div>

</body>

@endsection