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

    /* 🔹 Image style */
    td img {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #eee;
    }

    /* 🔹 Button styles */
    .action-btn {
        display: flex;
        gap: 8px;
        justify-content: flex-start;
        flex-wrap: wrap;
    }

    .btn {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 6px;
        border: none;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: 0.3s;
        text-decoration: none;
        color: #fff;
    }

    .btn-view {
        background-color: #007bff;
    }
    .btn-view:hover {
        background-color: #0056b3;
    }

    .btn-edit {
        background-color: #6c757d;
    }
    .btn-edit:hover {
        background-color: #495057;
    }

    .btn-delete {
        background-color: #dc3545;
    }
    .btn-delete:hover {
        background-color: #a71d2a;
    }

    @media(max-width: 768px){
        table th, table td { font-size: 13px; padding: 8px 10px; }
        .btn { font-size: 12px; padding: 5px 10px; }
    }
</style>

<div class="table-wrapper">
    <h2>Manage Categories</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->description }}</td>

                <!-- 🔹 Show image instead of path -->
               <td>
            @if($category->image)
               <img src="{{ asset($category->image) }}" alt="Category Image" style="width:60px; height:60px; object-fit:cover; border-radius:6px;">
            @else
              <span style="color:#888;">No Image</span>
            @endif
            </td>


                <td>{{ $category->status }}</td>
               
                <td class="action-btn">
                    <a class="btn btn-view" href="{{ route('categories.show',$category) }}">View</a>
                    <a class="btn btn-edit" href="{{ route('categories.edit',$category) }}">Edit</a>

                    <form action="{{ route('categories.destroy',$category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Delete</button>
                    </form>
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
