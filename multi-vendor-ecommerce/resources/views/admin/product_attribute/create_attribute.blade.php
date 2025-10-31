@extends('admin.layouts.layout')

@section('admin_page_title')
Add Attribute - Admin Panel
@endsection

@section('admin_layout')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    .form-wrapper {
        background: #fff;
        width: 80%;
        max-width: 700px;
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
    .form-row select {
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
    <h2>Add New Product Attribute</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('product_attribute.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <label for="name">Attribute Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter attribute name" value="{{ old('name') }}" required>
            @error('name')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <label for="type">Attribute Type:</label>
            <select id="type" name="type" required>
                <option value="">-- Select Type --</option>
                <option value="text" {{ old('type')=='text'?'selected':'' }}>Text</option>
                <option value="number" {{ old('type')=='number'?'selected':'' }}>Number</option>
                <option value="select" {{ old('type')=='select'?'selected':'' }}>Select</option>
                <option value="textarea" {{ old('type')=='textarea'?'selected':'' }}>Textarea</option>
            </select>
            @error('type')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="Write short description...">{{ old('description') }}</textarea>
            @error('description')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="1" {{ old('status')=='1'?'selected':'' }}>Active</option>
                <option value="0" {{ old('status')=='0'?'selected':'' }}>Inactive</option>
            </select>
            @error('status')
                <div style="color:red">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="submit-btn">Add Attribute</button>
    </form>
</div>

@endsection
