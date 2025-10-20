@extends('admin.layouts.layout')
@section('admin_page_title')
Add product
@endsection
@section('admin_layout')
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }
    body {
      background-color: #f4f6fb;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
    }
    .form-container {
      width: 100%;
      max-width: 900px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }
    h1 {
      text-align: center;
      font-size: 26px;
      margin-bottom: 10px;
      color: black;
    }
    p.subtitle {
      text-align: center;
      color: #6b7280;
      margin-bottom: 30px;
    }
    form {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }
    label {
      display: block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #374151;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 15px;
      transition: 0.2s ease;
    }
    input:focus, select:focus, textarea:focus {
      border-color: #2563eb;
      outline: none;
      box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }
    textarea {
      resize: vertical;
      min-height: 120px;
    }
    .file-upload {
      border: 2px dashed #a5b4fc;
      padding: 20px;
      text-align: center;
      border-radius: 10px;
      background-color: #f9fafb;
      cursor: pointer;
    }
    .file-upload:hover {
      background-color: #eef2ff;
    }
    .preview {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 10px;
    }
    .preview img {
      width: 80px;
      height: 80px;
      border-radius: 8px;
      object-fit: cover;
      border: 1px solid #e5e7eb;
    }
    .checkbox-group {
      display: flex;
      gap: 20px;
      align-items: center;
    }
    .checkbox-group label {
      display: flex;
      align-items: center;
      gap: 8px;
      font-weight: 500;
      cursor: pointer;
    }
    .btn-group {
      grid-column: 1 / -1;
      display: flex;
      justify-content: flex-end;
      gap: 15px;
      margin-top: 20px;
    }
    button {
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      cursor: pointer;
      transition: 0.2s;
    }
    .btn-primary {
      background-color: #2563eb;
      color: #fff;
    }
    .btn-primary:hover {
      background-color: #1e40af;
    }
    .btn-secondary {
      background-color: #f3f4f6;
      color: #111827;
    }
    .btn-secondary:hover {
      background-color: #e5e7eb;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Add New Product</h1>
    <p class="subtitle"></p>

    <form id="productForm" onsubmit="handleSubmit(event)">
      <div>
        <label>Product Name *</label>
        <input type="text" id="name" name="name" placeholder="e.g., Samsung Galaxy S21" required>
      </div>
      <div>
        <label>SKU / Model</label>
        <input type="text" id="sku" name="sku" placeholder="S21-BD-001">
      </div>
      <div>
        <label>Category *</label>
        <select id="category" name="category" required>
          <option value="">-- Select Category --</option>
          <option>Electronics</option>
          <option>Fashion</option>
          <option>Home & Kitchen</option>
          <option>Beauty</option>
        </select>
      </div>
      <div>
        <label>Price (৳) *</label>
        <input type="number" id="price" name="price" placeholder="0.00" step="0.01" required>
      </div>
      <div>
        <label>Stock Quantity</label>
        <input type="number" id="stock" name="stock" placeholder="10">
      </div>
      <div style="grid-column: 1 / -1;">
        <label>Description</label>
        <textarea id="description" name="description" placeholder="Enter full product details here..."></textarea>
      </div>
      <div style="grid-column: 1 / -1;">
        <label>Product Images</label>
        <label class="file-upload" for="images">Drop or click to select images
          <input type="file" id="images" name="images" accept="image/*" multiple style="display:none" onchange="previewImages(event)">
        </label>
        <div class="preview" id="preview"></div>
      </div>
      <div>
        <label>Color</label>
        <input type="text" id="color" name="color" placeholder="Black">
      </div>
      <div>
        <label>Size</label>
        <input type="text" id="size" name="size" placeholder="M, L, XL">
      </div>
      <div class="checkbox-group" style="grid-column: 1 / -1; margin-top: 10px;">
        <label><input type="checkbox" id="featured"> Featured</label>
        <label><input type="checkbox" id="active" checked> Active</label>
      </div>
      <div class="btn-group">
        <button type="button" class="btn-secondary" onclick="resetForm()">Reset</button>
        <button type="submit" class="btn-primary">Save</button>
      </div>
    </form>
  </div>

  <script>
    function previewImages(event) {
      const files = event.target.files;
      const preview = document.getElementById('preview');
      preview.innerHTML = '';
      Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
          const img = document.createElement('img');
          img.src = e.target.result;
          preview.appendChild(img);
        };
        reader.readAsDataURL(file);
      });
    }

    function resetForm() {
      document.getElementById('productForm').reset();
      document.getElementById('preview').innerHTML = '';
    }

    function handleSubmit(e) {
      e.preventDefault();
      const form = document.getElementById('productForm');
      const formData = new FormData(form);
      formData.set('featured', document.getElementById('featured').checked ? '1' : '0');
      formData.set('active', document.getElementById('active').checked ? '1' : '0');

      const obj = {};
      formData.forEach((v, k) => obj[k] = v);
      console.log('Form Data Preview:', obj);
      alert('Form data is printed in console. Use POST request to send it to Laravel backend.');
    }
  </script>
</body>

@endsection