@extends('admin.layouts.layout')
@section('admin_page_title')
Product - Admin Panel
@endsection
@section('admin_layout')

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
        flex-direction: column;
    }

    .admin-table {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .table-header, .table-row {
        display: flex;
        background: #ffffff;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        font-size: 14px;
        align-items: center;
    }

    .table-header {
        background: #e9ecef;
        font-weight: 700;
        color: #2c3e50;
        padding: 18px 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-radius: 12px;
    }

    .table-row:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }

    /* Column widths */
    .col-id { flex: 0.5; min-width: 40px; }
    .col-supplier { flex: 1.5; min-width: 100px; }
    .col-image { flex: 1; min-width: 100px; }
    .col-product { flex: 2; min-width: 150px; }
    .col-qty { flex: 1; min-width: 80px; text-align: center; }
    .col-total { flex: 1; min-width: 100px; text-align: right; padding-right: 15px; }
    .col-status { flex: 1; min-width: 100px; }
    .col-action { flex: 2; min-width: 180px; text-align: right; display: flex; justify-content: flex-end; gap: 8px; }

    .status-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 13px;
    }
    .status-paid { background-color: #d4edda; color: #155724; }
    .status-pending { background-color: #fff3cd; color: #856404; }
    .status-confirmed { background-color: #cce5ff; color: #004085; }
    .status-rejected { background-color: #f8d7da; color: #721c24; }

    .action-btn {
        border: none;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        transition: background 0.2s;
    }
    .btn-delete { background: #e74c3c; color: white; }
    .btn-delete:hover { background: #c0392b; }

    .btn-accept { background: #2ecc71; color: white; }
    .btn-accept:hover { background: #27ae60; }

    .btn-reject { background: #f39c12; color: white; }
    .btn-reject:hover { background: #e67e22; }

    .btn-reopen { background: #3498db; color: white; }
    .btn-reopen:hover { background: #2980b9; }

</style>

<h2>📑 Admin Purchase Management Dashboard</h2>

@if(session('success'))
    <div style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 15px;">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;">{{ session('error') }}</div>
@endif

<div class="layout">
    <div class="admin-table">

        <div class="table-header">
            <div class="col-id">ID</div>
            <div class="col-supplier">Vendor</div>
            <div class="col-image">Image</div>
            <div class="col-product">Product</div>
            <div class="col-qty">Qty</div>
            <div class="col-total">Total Price</div>
            <div class="col-status">Status</div>
            <div class="col-action">Actions</div>
        </div>

        @forelse($pendingRequests as $request)
        <div class="table-row">
            <div class="col-id">{{ $request->id }}</div>

            <div class="col-supplier">{{ $request->vendor->name ?? 'N/A' }}</div>

            <div class="col-image">
                @if($request->adminStock->product->product_image ?? false)
                    <img src="{{ asset('product_images/' . ($request->adminStock->product->product_image ?? '')) }}" width="55" height="55" style="border-radius:6px; object-fit:cover;">
                @else
                    N/A
                @endif
            </div>

            <div class="col-product">
                {{ $request->adminStock->product->product_name ?? 'N/A' }}
            </div>

            <div class="col-qty">
                {{ $request->quantity }}
            </div>

            <div class="col-total">
                ৳{{ number_format($request->total, 2) }}
            </div>

            <div class="col-status">
                <span class="status-badge status-pending">{{ $request->status }}</span>
            </div>

            <div class="col-action">
                <form action="{{ route('admin.product.purchase_request.accept', $request->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="action-btn btn-accept">Accept</button>
                </form>

                <form action="{{ route('admin.product.purchase_request.reject', $request->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="action-btn btn-reject">Reject</button>
                </form>
            </div>
        </div>
        @empty
        <div class="table-row">
            <div style="padding:15px; text-align:center; width:100%;">No pending purchase requests found.</div>
        </div>
        @endforelse

    </div>
</div>

@endsection
