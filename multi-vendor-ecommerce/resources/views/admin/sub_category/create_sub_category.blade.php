@extends('admin.layouts.layout')

@section('admin_page_title')
Add Sub-Category - Admin Panel
@endsection

@section('admin_layout')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    .form-wrapper {
        background: #fff;
        width: 80%;
        max-width: 900px;
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        padding: 30px 40px;
        margin: 10px auto;
        font-family: 'Poppins', sans-serif;
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(-20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    h2 {
        text-align: center;
        color: #182848;
        font-weight: 600;
        margin-bottom: 25px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .form-row {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .form-row label {
        width: 180px;
        font-weight: 500;
        color: #182848;
    }

    .form-row input[type="text"],
    .form-row textarea,
    .form-row select,
    .form-row input[type="file"] {
        flex: 1;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        background-color: #f9fafc;
        transition: all 0.3s ease;
    }

    .form-row textarea {
        resize: none;
        height: 80px;
    }

    .form-row input:focus,
    .form-row select:focus,
    .form-row textarea:focus {
        border-color: #4b6cb7;
        box-shadow: 0 0 5px rgba(75,108,183,0.4);
        outline: none;
    }

    .form-row input[type="file"] {
        padding: 8px;
        border: 1px dashed #4b6cb7;
        background: #f0f4ff;
    }

    .form-row input[type="file"]:hover {
        background: #e6ecff;
    }

    .submit-btn {
        align-self: flex-end;
        background: linear-gradient(90deg, #4b6cb7, #182848);
        color: #fff;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
    }

    .submit-btn:hover {
        background: linear-gradient(90deg, #3f5fa8, #0f1f3a);
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            align-items: flex-start;
        }
        .form-row label {
            width: 100%;
        }
        .submit-btn {
            align-self: center;
            width: 100%;
        }
    }
</style>

<div class="form-wrapper">
    <h2>Add New Sub-Category</h2>

    <!-- Laravel route optional -->
    <form action="" method="POST" enctype="multipart/form-data">
        <!-- @csrf -->

        <div class="form-row">
            <label for="parent_category">Parent Category:</label>
            <select id="parent_category" name="parent_category" required>
                <option value="">-- Select Parent Category --</option>
                <option value="1">Electronics</option>
                <option value="2">Fashion</option>
                <option value="3">Mobile Accessories</option>
                <!-- Dynamically populate categories from DB in Laravel -->
            </select>
        </div>

        <div class="form-row">
            <label for="name">Sub-Category Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter sub-category name" required>
        </div>

        <div class="form-row">
            <label for="slug">Slug:</label>
            <input type="text" id="slug" name="slug" placeholder="auto or manual slug">
        </div>

        <div class="form-row">
            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="Write short description..."></textarea>
        </div>

        <div class="form-row">
            <label for="image">Sub-Category Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="form-row">
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="submit-btn">Add Sub-Category</button>
    </form>
</div>

@endsection
