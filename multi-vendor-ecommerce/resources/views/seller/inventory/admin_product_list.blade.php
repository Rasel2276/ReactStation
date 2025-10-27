@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')

<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
body { background-color: #f4f6fb; color: #333;}
.table-container { width: 100%; max-width: 1200px; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 25px; margin:20px auto; }
h1 { text-align: center; color: #111827; margin-bottom: 20px; font-size: 26px; }
.top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
.top-bar input { width: 250px; padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; outline: none; font-size: 15px; }
table { width: 100%; border-collapse: collapse; margin-top: 10px; }
th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e5e7eb; }
th { background-color: #2563eb; color: #fff; font-weight: 600; }
tr:hover { background-color: #f9fafb; }
.actions { display: flex; gap: 10px; }
.btn { padding: 6px 12px; border: none; border-radius: 6px; font-size: 14px; cursor: pointer; transition: 0.2s; }
.btn-view { background-color: #22c55e; color: #fff; }
.btn-purchase { background-color: #2563eb; color: #fff; }
.btn:hover { opacity: 0.9; }
@media (max-width:768px) { table{ display:block; overflow-x:auto; } }
</style>
</head>
<body>
<div class="table-container">
  <h1>Admin Products - Vendor View</h1>
  <div class="top-bar">
    <input type="text" id="search" placeholder="Search product..." onkeyup="filterTable()">
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
        <th>Admin Info</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="productBody"></tbody>
  </table>
</div>

<script>
const products = [
  {id: 1, name: 'Samsung Galaxy S21', category: 'Electronics', price: 95000, stock: 20, status: 'Active', admin: 'Admin A'},
  {id: 2, name: 'Men T-Shirt', category: 'Fashion', price: 1200, stock: 50, status: 'Active', admin: 'Admin B'},
  {id: 3, name: 'Rice Cooker', category: 'Home & Kitchen', price: 4500, stock: 15, status: 'Inactive', admin: 'Admin A'},
];

function renderTable() {
  const tbody = document.getElementById('productBody');
  tbody.innerHTML = '';
  products.forEach(p => {
    tbody.innerHTML += `
      <tr>
        <td>${p.id}</td>
        <td>${p.name}</td>
        <td>${p.category}</td>
        <td>${p.price.toLocaleString()}</td>
        <td>${p.stock}</td>
        <td style="color:${p.status === 'Active' ? 'green':'red'};">${p.status}</td>
        <td>${p.admin}</td>
        <td class="actions">
          <button class="btn btn-view" onclick="viewProduct(${p.id})">View</button>
          <button class="btn btn-purchase" onclick="purchaseProduct(${p.id})">Purchase</button>
        </td>
      </tr>
    `;
  });
}

function filterTable() {
  const searchValue = document.getElementById('search').value.toLowerCase();
  const tbody = document.getElementById('productBody');
  tbody.innerHTML = '';
  products.filter(p => 
    p.name.toLowerCase().includes(searchValue) || 
    p.category.toLowerCase().includes(searchValue) ||
    p.admin.toLowerCase().includes(searchValue)
  ).forEach(p => {
    tbody.innerHTML += `
      <tr>
        <td>${p.id}</td>
        <td>${p.name}</td>
        <td>${p.category}</td>
        <td>${p.price.toLocaleString()}</td>
        <td>${p.stock}</td>
        <td style="color:${p.status === 'Active' ? 'green':'red'};">${p.status}</td>
        <td>${p.admin}</td>
        <td class="actions">
          <button class="btn btn-view" onclick="viewProduct(${p.id})">View</button>
          <button class="btn btn-purchase" onclick="purchaseProduct(${p.id})">Purchase</button>
        </td>
      </tr>
    `;
  });
}

function viewProduct(id) {
  const p = products.find(prod => prod.id === id);
  alert(`Product Details:\n\nName: ${p.name}\nCategory: ${p.category}\nPrice: ৳${p.price}\nStock: ${p.stock}\nStatus: ${p.status}\nAdded by: ${p.admin}`);
}

function purchaseProduct(id) {
  const p = products.find(prod => prod.id === id);
  alert(`Redirecting to purchase form for: ${p.name} (Implement Laravel route later)`);
}

renderTable();
</script>
</body>


@endsection