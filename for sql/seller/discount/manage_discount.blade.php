@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')

<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
body { background: #f4f6fb; color: #333; }
.container { width: 100%; max-width: 800px; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 25px; }
h1 { text-align: center; margin-bottom: 25px; color: #111827; font-size: 26px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #e5e7eb; padding: 12px; text-align: center; }
th { background-color: #2563eb; color: #fff; font-weight: 600; }
tr:hover { background-color: #f9fafb; }
input[type="number"] { width: 60px; padding: 5px; border-radius: 5px; border: 1px solid #ccc; }
button { padding: 6px 10px; border: none; border-radius: 6px; cursor: pointer; transition: 0.3s; font-size: 14px; }
.btn-apply { background: #22c55e; color: #fff; }
.btn-update { background: #2563eb; color: #fff; }
.btn-remove { background: #ef4444; color: #fff; }
button:hover { opacity: 0.9; }
.top-bar { display: flex; justify-content: flex-end; margin-bottom: 15px; }
.top-bar input { width: 200px; padding: 8px; border: 1px solid #ccc; border-radius: 6px; font-size: 15px; }
@media (max-width:768px){ table{display:block; overflow-x:auto;} }
</style>
</head>
<body>

<div class="container">
  <h1>Manage Discounts</h1>
  <div class="top-bar">
    <input type="text" id="search" placeholder="Search product..." onkeyup="filterTable()">
  </div>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Original Price (৳)</th>
        <th>Discount (%)</th>
        <th>Discounted Price (৳)</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="discountBody"></tbody>
  </table>
</div>

<script>
const products = [
  {id:1, name:'Samsung Galaxy S21', price:95000, discount:10},
  {id:2, name:'Men T-Shirt', price:1200, discount:0},
  {id:3, name:'Rice Cooker', price:4500, discount:5}
];

function renderTable() {
  const tbody = document.getElementById('discountBody');
  tbody.innerHTML = '';
  products.forEach(p=>{
    const discountedPrice = Math.round(p.price*(1-p.discount/100));
    tbody.innerHTML += `
      <tr>
        <td>${p.id}</td>
        <td>${p.name}</td>
        <td>${p.price.toLocaleString()}</td>
        <td><input type="number" min="0" max="100" value="${p.discount}" id="disc-${p.id}"></td>
        <td id="discPrice-${p.id}">${discountedPrice.toLocaleString()}</td>
        <td>
          <button class="btn btn-update" onclick="updateDiscount(${p.id})">Update</button>
          <button class="btn btn-remove" onclick="removeDiscount(${p.id})">Remove</button>
        </td>
      </tr>
    `;
  });
}

function updateDiscount(id){
  const input = document.getElementById(`disc-${id}`);
  const product = products.find(p=>p.id===id);
  product.discount = parseFloat(input.value)||0;
  document.getElementById(`discPrice-${id}`).innerText = Math.round(product.price*(1-product.discount/100)).toLocaleString();
  alert(`✅ Discount updated to ${product.discount}% for ${product.name}`);
}

function removeDiscount(id){
  const product = products.find(p=>p.id===id);
  product.discount = 0;
  document.getElementById(`disc-${id}`).value = 0;
  document.getElementById(`discPrice-${id}`).innerText = product.price.toLocaleString();
  alert(`❌ Discount removed for ${product.name}`);
}

function filterTable(){
  const filter = document.getElementById('search').value.toLowerCase();
  const tbody = document.getElementById('discountBody');
  tbody.innerHTML = '';
  products.filter(p=>p.name.toLowerCase().includes(filter)).forEach(p=>{
    const discountedPrice = Math.round(p.price*(1-p.discount/100));
    tbody.innerHTML += `
      <tr>
        <td>${p.id}</td>
        <td>${p.name}</td>
        <td>${p.price.toLocaleString()}</td>
        <td><input type="number" min="0" max="100" value="${p.discount}" id="disc-${p.id}"></td>
        <td id="discPrice-${p.id}">${discountedPrice.toLocaleString()}</td>
        <td>
          <button class="btn btn-update" onclick="updateDiscount(${p.id})">Update</button>
          <button class="btn btn-remove" onclick="removeDiscount(${p.id})">Remove</button>
        </td>
      </tr>
    `;
  });
}

renderTable();
</script>

</body>


@endsection