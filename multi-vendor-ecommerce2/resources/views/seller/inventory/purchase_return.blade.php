@extends('seller.layouts.layout')

@section('seller_page_title')
    Return Purchased Product
@endsection

@section('seller_layout')

<style>
.container {
    width: 95%;
    max-width: 1000px;
    margin: 40px auto;
    background: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    font-family: Arial, sans-serif;
}

.container h1 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 28px;
    color: #111827;
}

.return-form {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: center;
}

.return-form select,
.return-form input[type="number"],
.return-form textarea,
.return-form button {
    padding: 8px 12px;
    font-size: 15px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
}

.return-form select,
.return-form input[type="number"],
.return-form textarea {
    flex: 1 1 auto;
}

.return-form textarea {
    resize: vertical;
    min-height: 40px;
}

.return-form button {
    background: #2563eb;
    color: #fff;
    border: none;
    cursor: pointer;
    flex: 0 0 auto;
    transition: all 0.2s;
}

.return-form button:hover {
    background: #1e40af;
    transform: translateY(-1px);
}

.alert {
    padding: 10px 15px;
    margin-bottom: 20px;
    border-radius: 6px;
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
}

.alert-error {
    background: #fee2e2;
    color: #991b1b;
}

@media (max-width: 768px) {
    .return-form {
        flex-direction: column;
        align-items: stretch;
    }
}
</style>

<div class="container">
    <h1>Return Purchased Product</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form class="return-form" action="{{ route('inventory.vendor_purchase_return_store') }}" method="POST">
        @csrf

        <!-- Product Dropdown -->
        <select name="vendor_stock_id" required>
            <option value="">Select Product to Return</option>
            @foreach($stocks as $stock)
                <option value="{{ $stock->id }}">
                    {{ $stock->adminStock->product->product_name }}
                    (Available: {{ $stock->quantity }})
                </option>
            @endforeach
        </select>

        <!-- Quantity -->
        <input type="number" name="quantity" min="1" placeholder="Quantity" required>

        <!-- Reason -->
        <textarea name="reason" placeholder="Reason for return" required></textarea>

        <!-- Submit Button -->
        <button type="submit">Submit Return</button>
    </form>
</div>

@endsection
