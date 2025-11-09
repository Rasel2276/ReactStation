@extends('admin.layouts.layout')

@section('admin_page_title')
Manage Attributes - Admin Panel
@endsection

@section('admin_layout')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    .table-wrapper {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        padding: 20px 30px;
        margin: 10px auto;
        max-width: 1100px;
        overflow-x: auto;
        font-family: 'Poppins', sans-serif;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #182848;
        font-weight: 600;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: auto;
    }

    table thead {
        background: linear-gradient(90deg, #4b6cb7, #182848);
        color: #fff;
    }

    table th, table td {
        padding: 12px 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }

    table tr:hover {
        background-color: #f5f5f5;
    }

    .status-badge {
        color: #fff;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        user-select: none;
    }

    .status-active { background-color: #28a745; }
    .status-inactive { background-color: #dc3545; }

    .action-btn {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .btn-view, .btn-toggle, .btn-edit, .btn-delete {
        padding: 6px 12px;
        border: none;
        border-radius: 6px;
        color: #fff;
        font-weight: 500;
        cursor: pointer;
        transition: 0.2s;
        font-size: 13px;
    }

    .btn-view { background-color: #007bff; }
    .btn-view:hover { background-color: #0056b3; }

    .btn-toggle { background-color: #6c757d; }
    .btn-toggle:hover { background-color: #495057; }

    .btn-edit { background-color: #17a2b8; }
    .btn-edit:hover { background-color: #117a8b; }

    .btn-delete { background-color: #dc3545; }
    .btn-delete:hover { background-color: #a71d2a; }

    @media(max-width: 768px){
        table th, table td { font-size: 13px; padding: 8px 10px; }
        .btn-view, .btn-toggle, .btn-edit, .btn-delete { font-size: 11px; padding: 4px 8px; }
    }
</style>

<div class="table-wrapper">
    <h2>Manage Attributes</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Attribute Name</th>
                <th>Type</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attributes as $attr)
            <tr>
                <td>{{ $attr->id }}</td>
                <td>{{ $attr->name }}</td>
                <td>{{ ucfirst($attr->type) }}</td>
                <td>{{ $attr->description }}</td>
                <td>
                    <a href="{{ route('product_attribute.toggle_status', $attr->id) }}">
                        <span class="status-badge {{ strtolower($attr->status) }}">{{ $attr->status }}</span>
                    </a>
                </td>
                <td class="actions">
                    <a href="{{ route('product_attribute.view', $attr->id) }}">
                        <button class="btn-view">View</button>
                    </a>
                    <a href="{{ route('product_attribute.edit', $attr->id) }}">
                        <button class="btn-edit">Edit</button>
                    </a>
                    <a href="{{ route('product_attribute.toggle_status', $attr->id) }}">
                        <button class="btn-toggle">Toggle Status</button>
                    </a>
                    <a href="{{ route('product_attribute.delete', $attr->id) }}" onclick="return confirm('Are you sure?')">
                        <button class="btn-delete">Delete</button>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No attributes found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


<script>
    function toggleStatus(element) {
        if(element.classList.contains('status-active')) {
            element.classList.remove('status-active');
            element.classList.add('status-inactive');
            element.textContent = 'Inactive';
        } else {
            element.classList.remove('status-inactive');
            element.classList.add('status-active');
            element.textContent = 'Active';
        }
    }

    function deleteRow(button) {
        if(confirm('Are you sure you want to delete this attribute?')) {
            button.closest('tr').remove();
            alert('Attribute deleted!');
        }
    }
</script>

@endsection
