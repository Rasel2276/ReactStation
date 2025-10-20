@extends('admin.layouts.layout')
@section('admin_page_title')
Product - Admin Panel
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
    .table-container {
      width: 100%;
      max-width: 1100px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0,0,0,0.1);
      padding: 25px;
    }
    h1 {
      text-align: center;
      color: #111827;
      margin-bottom: 20px;
      font-size: 26px;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }
    .top-bar input {
      width: 250px;
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      outline: none;
      font-size: 15px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
    }
    th {
      background-color: #2563eb;
      color: #fff;
      font-weight: 600;
    }
    tr:hover {
      background-color: #f9fafb;
    }
    .actions {
      display: flex;
      gap: 10px;
    }
    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
      transition: 0.2s;
    }
    .btn-view {
      background-color: #22c55e;
      color: #fff;
    }
    .btn-edit {
      background-color: #2563eb;
      color: #fff;
    }
    .btn-delete {
      background-color: #ef4444;
      color: #fff;
    }
    .btn:hover {
      opacity: 0.9;
    }
    @media (max-width: 768px) {
      table {
        display: block;
        overflow-x: auto;
      }
    }
  </style>
</head>
<body>
  <div class="table-container">
    <h1>Manage Products</h1>
    <div class="top-bar">
      <input type="text" id="search" placeholder="Search product..." onkeyup="filterTable()">
      <button class="btn btn-edit" onclick="addNewProduct()">+ Add Product</button>
    </div>
    <table id="productTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Category</th>
          <th>Price (৳)</th>
          <th>Stock</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="productBody">
        <!-- Demo data -->
      </tbody>
    </table>
  </div>

  <script>
    const products = [
      {id: 1, name: 'Samsung Galaxy S21', category: 'Electronics', price: 95000, stock: 20, status: 'Active'},
      {id: 2, name: 'Men T-Shirt', category: 'Fashion', price: 1200, stock: 50, status: 'Active'},
      {id: 3, name: 'Rice Cooker', category: 'Home & Kitchen', price: 4500, stock: 15, status: 'Inactive'},
    ];

    function renderTable() {
      const tbody = document.getElementById('productBody');
      tbody.innerHTML = '';
      products.forEach((p) => {
        const row = `
          <tr>
            <td>${p.id}</td>
            <td>${p.name}</td>
            <td>${p.category}</td>
            <td>${p.price.toLocaleString()}</td>
            <td>${p.stock}</td>
            <td style="color:${p.status === 'Active' ? 'green' : 'red'};">${p.status}</td>
            <td class="actions">
              <button class="btn btn-view" onclick="viewProduct(${p.id})">View</button>
              <button class="btn btn-edit" onclick="editProduct(${p.id})">Edit</button>
              <button class="btn btn-delete" onclick="deleteProduct(${p.id})">Delete</button>
            </td>
          </tr>`;
        tbody.innerHTML += row;
      });
    }

    function filterTable() {
      const searchValue = document.getElementById('search').value.toLowerCase();
      const filtered = products.filter(p => 
        p.name.toLowerCase().includes(searchValue) || 
        p.category.toLowerCase().includes(searchValue)
      );
      const tbody = document.getElementById('productBody');
      tbody.innerHTML = '';
      filtered.forEach((p) => {
        tbody.innerHTML += `
          <tr>
            <td>${p.id}</td>
            <td>${p.name}</td>
            <td>${p.category}</td>
            <td>${p.price.toLocaleString()}</td>
            <td>${p.stock}</td>
            <td style="color:${p.status === 'Active' ? 'green' : 'red'};">${p.status}</td>
            <td class="actions">
              <button class="btn btn-view" onclick="viewProduct(${p.id})">View</button>
              <button class="btn btn-edit" onclick="editProduct(${p.id})">Edit</button>
              <button class="btn btn-delete" onclick="deleteProduct(${p.id})">Delete</button>
            </td>
          </tr>`;
      });
    }

    function addNewProduct() {
      alert('Redirect to Add Product page (Laravel route later)');
    }

    function viewProduct(id) {
      const product = products.find(p => p.id === id);
      alert(`Product Details:\n\nName: ${product.name}\nCategory: ${product.category}\nPrice: ৳${product.price}\nStock: ${product.stock}`);
    }

    function editProduct(id) {
      alert(`Edit function for Product ID: ${id} (Laravel route later)`);
    }

    function deleteProduct(id) {
      if (confirm('Are you sure you want to delete this product?')) {
        const index = products.findIndex(p => p.id === id);
        products.splice(index, 1);
        renderTable();
        alert('Product deleted successfully!');
      }
    }

    renderTable();
  </script>
</body>
@endsection