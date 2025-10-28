@extends('admin.layouts.layout')

@section('admin_page_title')
Manage Categories - Admin Panel
@endsection

@section('admin_layout')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    .table-wrapper {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        padding: 20px 30px;
        margin: 30px auto;
        max-width: 1000px;
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

    .status-active {
        background-color: #28a745;
    }

    .status-inactive {
        background-color: #dc3545;
    }

    .action-btn {
        display: flex;
        gap: 8px;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .btn-view, .btn-toggle, .btn-delete {
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

    .btn-delete { background-color: #dc3545; }
    .btn-delete:hover { background-color: #a71d2a; }

    @media(max-width: 768px){
        table th, table td { font-size: 13px; padding: 8px 10px; }
        .btn-view, .btn-toggle, .btn-delete { font-size: 11px; padding: 4px 8px; }
    }
</style>

<div class="table-wrapper">
    <h2>Manage Categories</h2>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- Example static data --}}
            <tr>
                <td>1</td>
                <td>Electronics</td>
                <td>electronics</td>
                <td>
                    <span class="status-badge status-active" onclick="toggleStatus(this)">Active</span>
                </td>
                <td>
                    <div class="action-btn">
                        <button class="btn-view" onclick="alert('Viewing Electronics')">View</button>
                        <button class="btn-toggle" onclick="toggleStatus(this.closest('tr').querySelector('.status-badge'))">Toggle Status</button>
                        <button class="btn-delete" onclick="deleteRow(this)">Delete</button>
                    </div>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Fashion</td>
                <td>fashion</td>
                <td>
                    <span class="status-badge status-inactive" onclick="toggleStatus(this)">Inactive</span>
                </td>
                <td>
                    <div class="action-btn">
                        <button class="btn-view" onclick="alert('Viewing Fashion')">View</button>
                        <button class="btn-toggle" onclick="toggleStatus(this.closest('tr').querySelector('.status-badge'))">Toggle Status</button>
                        <button class="btn-delete" onclick="deleteRow(this)">Delete</button>
                    </div>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>Mobile Accessories</td>
                <td>mobile-accessories</td>
                <td>
                    <span class="status-badge status-active" onclick="toggleStatus(this)">Active</span>
                </td>
                <td>
                    <div class="action-btn">
                        <button class="btn-view" onclick="alert('Viewing Mobile Accessories')">View</button>
                        <button class="btn-toggle" onclick="toggleStatus(this.closest('tr').querySelector('.status-badge'))">Toggle Status</button>
                        <button class="btn-delete" onclick="deleteRow(this)">Delete</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<script>
    // Toggle status badge
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

    // Delete row
    function deleteRow(button) {
        if(confirm('Are you sure you want to delete this category?')) {
            button.closest('tr').remove();
            alert('Category deleted!');
        }
    }
</script>

@endsection
