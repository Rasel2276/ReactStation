@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: #f4f6f9;
            margin: 0;
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

        .alert {
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-weight: 600;
            color: #fff;
        }
        .alert-success { background: #27ae60; }
        .alert-error { background: #e74c3c; }

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
</head>
<body>

   <h2>Purchase List & Payment Section</h2>

{{-- SUCCESS/ERROR MESSAGE BLOCK --}}
@if(session('success'))
    <div class="alert alert-success" style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 15px;">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-error" style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;">{{ session('error') }}</div>
@endif
{{-- END MESSAGE BLOCK --}}


<div class="layout" style="display: flex; gap: 20px;">
    <div class="left-table" style="flex: 2;">
        <h3 style="margin-bottom: 10px;">Pending Purchases ({{ $pendingPurchases->count() }})</h3>
        
        {{-- ডাইনামিক ভ্যারিয়েবল তৈরি --}}
        @php
            // Pending Purchase ID গুলি কমা সেপারেটেড স্ট্রিং হিসেবে তৈরি করা
            $purchaseIds = $pendingPurchases->pluck('id')->implode(',');
        @endphp

        @forelse($pendingPurchases as $purchase)
        <div class="item-card" style="border: 1px solid #ccc; padding: 10px; margin-bottom: 8px; border-radius: 5px;">
            <div class="item"><strong>ID:</strong> {{ $purchase->id }}</div>
            {{-- Product নাম অ্যাক্সেস করতে .with('adminStock.product') প্রয়োজন --}}
            <div class="item"><strong>Product:</strong> {{ $purchase->adminStock->product->name ?? 'N/A' }}</div>
            <div class="item"><strong>Quantity:</strong> {{ $purchase->quantity }} pcs</div>
            <div class="item"><strong>Price/Unit:</strong> ৳{{ number_format($purchase->price, 2) }}</div>
            <div class="item"><strong>Total:</strong> ৳{{ number_format($purchase->total, 2) }}</div> 
        </div>
        @empty
        <p style="padding: 15px; text-align: center; color: #555; background: #f9f9f9; border-radius: 5px;">No pending purchase requests found to pay for.</p>
        @endforelse

    </div>

    <div class="right-payment" style="flex: 1; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f4f4f4;">

        <div class="payment-title" style="font-size: 1.2em; font-weight: bold; margin-bottom: 20px;">Payment Section</div>

        {{-- Controller ফাংশনের দিকে ফর্ম অ্যাকশন --}}
        <form action="{{ route('purchase.submit.payment') }}" method="POST">
            @csrf
            
            {{-- ডাইনামিকালি তৈরি করা Pending purchase ID স্ট্রিং পাঠানো --}}
            <input type="hidden" name="purchase_ids_string" value="{{ $purchaseIds }}"> 

            <div style="margin-bottom: 15px;">
                <label for="total_amount" style="display: block; margin-bottom: 5px; font-weight: 500;">Total Payable Amount</label>
                {{-- Controller থেকে আসা মোট মূল্য দেখানো --}}
                <input type="text" id="total_amount" readonly value="৳{{ number_format($totalPayable, 2) }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 1.1em; background-color: #e9e9e9;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label for="payment_method" style="display: block; margin-bottom: 5px; font-weight: 500;">Payment Method</label>
                <select name="payment_method" id="payment_method" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">-- Select Method --</option>
                    <option value="Cash">Cash</option>
                    <option value="Bank">Bank Transfer</option>
                    <option value="Bkash">Bkash</option>
                    <option value="Nagad">Nagad</option>
                    <option value="Rocket">Rocket</option>
                </select>
            </div>
            
            {{-- যদি কোনো Pending Purchase না থাকে, তবে বাটন disabled হবে --}}
            <button type="submit" 
                    style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;"
                    {{ $pendingPurchases->isEmpty() ? 'disabled' : '' }}>
                Submit Payment
            </button>
            @if($pendingPurchases->isEmpty())
                <p style="color: red; text-align: center; margin-top: 10px;">No requests to submit.</p>
            @endif
        </form>
    </div>
</div>
@endsection