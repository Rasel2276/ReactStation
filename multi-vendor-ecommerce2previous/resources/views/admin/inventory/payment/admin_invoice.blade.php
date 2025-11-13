@extends('admin.layouts.layout')
@section('admin_page_title')
Purchase Invoice - Admin Panel
@endsection
@section('admin_layout')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<!-- Font Awesome for Print Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background: #f9f9f9;
        margin: 0;
    }

    .print-button-container {
        max-width: 900px;
        margin: 20px auto;
        text-align: right;
    }
    .print-btn {
        padding: 10px 25px;
        background: #caa45f;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background 0.3s;
        box-shadow: 0 4px 10px rgba(202, 164, 95, 0.4);
    }
    .print-btn:hover {
        background: #a98547;
    }

    .invoice-container {
        max-width: 900px;
        margin: auto;
        background: #ffffff;
        padding: 50px 60px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
    }

    h1, h2, h3, h4 { margin: 0; padding: 0; }

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
    .terms {
        margin-top: 60px;
        font-size: 14px;
        line-height: 1.6;
    }
    .terms h4 {
        color: #caa45f;
        margin-bottom: 5px;
    }

    /* --- PRINT STYLES --- */
    @media print {
        body {
            background: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .invoice-container {
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
        }
        .print-button-container, .upload-logo-box {
            display: none !important;
        }
        table, tbody td {
            border-color: #000 !important; 
        }
        tr { page-break-inside: avoid; }
        table { page-break-after: auto; }
    }
</style>



<div class="invoice-container" id="invoice-content"> 

    @php
        $firstPurchase = $purchases->first();
        $supplier = $firstPurchase->supplier ?? null;
        $admin = $firstPurchase->admin ?? null;
        $invoiceIds = $purchases->pluck('id')->implode(', ');
        
        $displayStatus = $firstPurchase->status;
        if ($displayStatus === 'Completed') {
            $displayStatus = 'Paid';
        }
    @endphp

    <!-- TOP SECTION -->
    <div class="top-section">
        <div class="company-info">
            <strong>Your Company Inc. (Admin Purchase)</strong><br>
            Processed by: {{ $admin->name ?? 'System Admin' }}<br>
            {{ $admin->email ?? 'N/A' }}
        </div>

        <div class="upload-logo-box">
            ☁ Company Logo Placeholder
        </div>
    </div>

    <!-- TITLE -->
    <div class="invoice-title">
        <h2>PURCHASE<br>INVOICE</h2>
    </div>

    <!-- BILL TO SECTION -->
    <div class="bill-section">
        <div class="bill-left">
            <h4>Billed From (Supplier)</h4>
            @if($supplier)
                <p><strong>{{ $supplier->supplier_name }}</strong></p>
                <p>Phone: {{ $supplier->phone ?? 'N/A' }}</p>
                <p>Email: {{ $supplier->email ?? 'N/A' }}</p>
            @else
                <p>Supplier Not Found</p>
            @endif
        </div>

        <div class="bill-right">
            <p><span>Invoice ID(s) #</span> {{ $invoiceIds }}</p>
            <p><span>Payment Date</span> {{ $firstPurchase->updated_at->format('d-m-Y') }}</p>
            <p><span>Status</span> {{ $displayStatus }}</p>
            <p><span>Total Qty</span> {{ $total_quantity }}</p> 
        </div>
    </div>

    <!-- PRODUCT TABLE -->
    <table>
        <thead>
            <tr>
                <th>Description (Product)</th>
                <th>QTY</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
        </thead>

        <tbody>
            @foreach($purchases as $purchase)
            <tr>
                <td>{{ $purchase->product->product_name ?? 'Product Deleted' }}</td>
                <td>{{ $purchase->quantity }}</td>
                <td>৳{{ number_format($purchase->purchase_price, 2) }}</td>
                <td>৳{{ number_format($purchase->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- TOTALS -->
    <div class="totals-section">
        <p><span>Subtotal</span> ৳{{ number_format($total_amount, 2) }}</p>
        <p><span>Payment Method</span> {{ $firstPurchase->payment_method ?? 'N/A' }}</p>
        <p class="total-row"><span>Total Payable</span> ৳{{ number_format($total_amount, 2) }}</p>
    </div>

    <!-- TERMS -->
    <div class="terms">
        <h4>Note</h4>
        <p>This document confirms the purchase and payment completion for the listed items. Status: **{{ $displayStatus }}**.</p>
    </div>

</div>

<script>
    document.getElementById('printButton').addEventListener('click', function() {
        window.print();
    });
</script>
<!-- Print Button -->
<div class="print-button-container">
    <button id="printButton" class="print-btn">
        <i class="fa-solid fa-print"></i> Print Invoice
    </button>
</div>

@endsection
