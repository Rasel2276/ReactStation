@extends('seller.layouts.layout')
@section('seller_page_title')
    My Return Records
@endsection
@section('seller_layout')

<style>
body {
    font-family: 'Segoe UI', Tahoma, sans-serif;
    background: #f4f6f8;
    margin: 0;
}

.container {
    max-width: 1100px;
    margin: 0 auto;
    background: #fff;
    padding: 30px 35px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

h1 {
    text-align: center;
    margin-bottom: 25px;
    color: #111827;
    font-size: 28px;
}

#search {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-size: 15px;
    margin-bottom: 20px;
    box-sizing: border-box;
    transition: all 0.2s;
}

#search:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
    outline: none;
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
    table-layout: auto;
}

th, td {
    padding: 14px 15px;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
    vertical-align: middle;
}

th {
    background-color: #f9fafb;
    font-weight: 600;
    color: #374151;
}

.product-image {
    width: 55px;
    height: 55px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #d1d5db;
}

.status.Pending { color: #f97316; font-weight: bold; }
.status.Approved { color: #16a34a; font-weight: bold; }
.status.Rejected { color: #dc2626; font-weight: bold; }
.status.Completed { color: #2563eb; font-weight: bold; }

.action-buttons {
    display: flex;
    gap: 8px;
}

button {
    padding: 6px 14px;
    border: none;
    color: #fff;
    font-weight: 500;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s;
}

button:hover { transform: translateY(-2px); }

.btn-delete { background: #ef4444; }
.btn-delete:hover { background: #b91c1c; }

.btn-edit { background: #3b82f6; }
.btn-edit:hover { background: #1e40af; }

/* Responsive */
@media (max-width: 768px) {
    table, thead, tbody, th, td, tr { display: block; }
    thead tr { display: none; }
    tr { margin-bottom: 15px; border-bottom: 2px solid #f3f4f6; padding-bottom: 10px; }
    td { padding-left: 50%; position: relative; text-align: right; }
    td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: 45%;
        padding-left: 10px;
        font-weight: 600;
        text-align: left;
    }
    .product-image { width: 45px; height: 45px; }
}
</style>

<div class="container">
    <h1>My Return Records</h1>

    <input type="text" id="search" placeholder="Search return records..." onkeyup="filterTable()">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Return Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="returnBody">
            @foreach($returns as $return)
            <tr>
                <td>{{ $return->id }}</td>
                <td>{{ $return->product->product_name }}</td>
                <td><img src="{{ asset('product_images/'.$return->product->product_image) }}" width="50"></td>
                <td>{{ $return->quantity }}</td>
                <td>{{ $return->reason }}</td>
                <td>{{ $return->status }}</td>
                <td>{{ $return->return_date }}</td>
                <td>
                    <form action="{{ route('inventory.vendor_return_record_delete', $return->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function filterTable() {
    const filter = document.getElementById('search').value.toLowerCase();
    const tr = document.querySelectorAll("#returnBody tr");
    tr.forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(filter) ? "" : "none";
    });
}
</script>

@endsection
