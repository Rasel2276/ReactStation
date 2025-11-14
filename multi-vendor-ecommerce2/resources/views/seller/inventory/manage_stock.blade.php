@extends('seller.layouts.layout')
@section('seller_page_title')
    Purchased Products
@endsection
@section('seller_layout')

<style>
/* Container */
.container {
    width: 95%;
    margin: 40px auto;
    background: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}

.container h1 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 28px;
    color: #111827;
}

/* Search box */
#search {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 15px;
    margin-bottom: 20px;
    box-sizing: border-box;
}

#search:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
    outline: none;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
    table-layout: auto;
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: middle;
}

th {
    background-color: #f9fafb;
    font-weight: 600;
}

.product-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
}

/* Status */
.status.active { color: green; font-weight: bold; }
.status.inactive { color: red; font-weight: bold; }
.status.allocated { color: orange; font-weight: bold; }
.status.completed { color: blue; font-weight: bold; }

/* Action Buttons - Horizontal */
.action-buttons {
    display: flex;
    gap: 8px;
}

button {
    padding: 6px 12px;
    border: none;
    color: #fff;
    font-weight: 500;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
}

button:hover { transform: translateY(-1px); }

.btn-delete { background: #e74c3c; }
.btn-delete:hover { background: #c0392b; }

.btn-buy { background: #10b981; }
.btn-buy:hover { background: #059669; }

/* Responsive table */
@media (max-width: 768px) {
    table, thead, tbody, th, td, tr {
        display: block;
    }
    thead tr { display: none; }
    tr { margin-bottom: 15px; border-bottom: 2px solid #f3f4f6; padding-bottom: 10px; }
    td { padding-left: 50%; position: relative; text-align: right; }
    td::before { content: attr(data-label); position: absolute; left: 15px; width: 45%; padding-left: 10px; font-weight: 600; text-align: left; }
    .product-image { width: 40px; height: 40px; }
}
</style>

<div class="container">
    <h1>Purchased Products from Admin</h1>
    <input type="text" id="search" placeholder="Search product..." onkeyup="filterTable()">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Price (৳)</th>
                <th>Total (৳)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="purchaseBody">
            @foreach($purchases as $p)
            <tr>
                <td data-label="ID">{{ $p->id }}</td>
                <td data-label="Product Name">{{ $p->adminStock->product->product_name }}</td>
                <td data-label="Product Image">
                    <img class="product-image" 
                         src="{{ asset('product_images/' . $p->adminStock->product->product_image) }}" 
                         alt="{{ $p->adminStock->product->product_name }}">
                </td>
                <td data-label="Quantity">{{ $p->quantity }}</td>
                <td data-label="Price (৳)">{{ number_format($p->price) }}</td>
                <td data-label="Total (৳)">{{ number_format($p->price * $p->quantity) }}</td>
                <td data-label="Status">
                    <span class="status {{ strtolower($p->status) }}">{{ strtoupper($p->status) }}</span>
                </td>
                <td data-label="Actions">
                    <div class="action-buttons">
                        <form action="{{ route('inventory.delete_manage_stock', $p->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Delete</button>
                        </form>
                        <button class="btn-buy">Buy Now</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function filterTable() {
    const filter = document.getElementById('search').value.toLowerCase();
    const tr = document.querySelectorAll("#purchaseBody tr");
    tr.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
}
</script>

@endsection
