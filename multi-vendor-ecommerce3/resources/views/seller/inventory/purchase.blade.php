@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')


<style>

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f4f6fb;
    margin: 0;
}


.form-container {
    max-width: 650px;
    margin: 40px auto;
    background: #fff;
    padding: 30px 35px;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.form-container:hover {
    transform: translateY(-5px);
}


.form-container h1 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 28px;
    color: #111827;
}


.form-container p {
    font-weight: 500;
    margin-bottom: 15px;
    text-align: center;
    font-size: 16px;
}


.form-row {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}


.form-group {
    flex: 1;
    display: flex;
    flex-direction: column;
}


label {
    margin-bottom: 8px;
    font-weight: 500;
    color: #374151;
}


select, input[type="number"] {
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 15px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

select:focus, input[type="number"]:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
    outline: none;
}


button {
    padding: 12px 25px;
    border: none;
    background: #2563eb;
    color: #fff;
    font-weight: 600;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
    width: 100%; 
    margin-top: 20px; 
}

button:hover {
    background: #1e40af;
    transform: translateY(-2px);
}


@media (max-width: 600px) {
    .form-row {
        flex-direction: column;
    }

    .form-group {
        width: 100%;
    }

    .form-group[style] {
        margin-top: 15px;
    }
}
</style>

<div class="form-container">
    <h1>Purchase Product</h1>

    @if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
    @endif

    @if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
    @endif

    <form action="{{ route('inventory.vendor_purchase_store') }}" method="POST">
        @csrf

        <div class="form-row">

            <div class="form-group">
                <label>Select Product</label>
                <select name="admin_stock_id" required>
                    <option value="">-- Select Product --</option>
                    @foreach($stocks as $stock)
                        <option value="{{ $stock->id }}" @if($stock->quantity==0) disabled @endif>
                            {{ $stock->product->name }} - ৳{{ number_format($stock->vendor_sale_price ?? $stock->purchase_price, 2) }}
                            (Stock: {{ $stock->quantity }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" min="1" value="1" required>
            </div>

        </div>
        
        <button type="submit">Purchase</button>

    </form>
</div>

@endsection