@extends('seller.layouts.layout')
@section('seller_page_title')
    Guest Customers
@endsection
@section('seller_layout')

<style>
/* ===== Body & Container ===== */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 0;
}

.table-container {
    width: 95%;
    margin: 30px auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    overflow-x: auto; /* For horizontal scroll on small screens */
}

/* ===== Heading ===== */
h2 {
    text-align: center;
    font-size: 26px;
    color: #34495e;
    margin-bottom: 25px;
}

/* ===== Table ===== */
.custom-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
    min-width: 1200px; /* Prevent squeezing */
}

.custom-table th {
    background-color: #007bff;
    color: #fff;
    font-weight: 700;
    padding: 14px 10px;
    text-align: center;
    text-transform: uppercase;
    white-space: nowrap; /* Prevent heading wrap */
}

.custom-table td {
    padding: 10px 8px;
    border-bottom: 1px solid #e0e0e0;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap; /* Keep text in one line */
    color: #444;
}

.custom-table tbody tr:hover {
    background-color: #e8f3ff; /* Hover effect */
}

/* ===== Action Buttons ===== */
.action-buttons-group {
    display: flex;
    justify-content: center;
    gap: 8px;
}

.action-btn {
    padding: 7px 12px;
    border: none;
    border-radius: 4px;
    font-size: 13px;
    cursor: pointer;
    text-transform: uppercase;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.view-btn { 
    background-color: #1abc9c; 
    color: #fff; 
}
.view-btn:hover { 
    background-color: #16a085; 
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.delete-btn { 
    background-color: #e74c3c; 
    color: #fff; 
}
.delete-btn:hover { 
    background-color: #c0392b; 
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
</style>

<div class="table-container">
    <h2>Guest Customers</h2>

    @if(session('success'))
        <p style="color:green; text-align:center; font-weight: bold;">{{ session('success') }}</p>
    @endif

    <table class="custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company Name</th>
                <th>Country</th>
                <th>Street Address</th>
                <th>Street Address 2</th>
                <th>City</th>
                <th>State</th>
                <th>Postcode</th>
                <th>Order Notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $guest)
            <tr>
                <td>{{ $guest->id }}</td>
                <td>{{ $guest->first_name }}</td>
                <td>{{ $guest->last_name }}</td>
                <td>{{ $guest->email }}</td>
                <td>{{ $guest->phone }}</td>
                <td>{{ $guest->company_name ?? '-' }}</td>
                <td>{{ $guest->country }}</td>
                <td>{{ $guest->street_address }}</td>
                <td>{{ $guest->street_address2 ?? '-' }}</td>
                <td>{{ $guest->city }}</td>
                <td>{{ $guest->state }}</td>
                <td>{{ $guest->postcode }}</td>
                <td>{{ $guest->order_notes ?? '-' }}</td>
                <td>
                    <div class="action-buttons-group">
                        <button class="action-btn view-btn">View</button>
                        
                        <form action="{{ route('guest.delete', $guest->id) }}" method="POST" onsubmit="return confirm('Are you sure to delete this guest?');">
                            @csrf
                            <button type="submit" class="action-btn delete-btn">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
