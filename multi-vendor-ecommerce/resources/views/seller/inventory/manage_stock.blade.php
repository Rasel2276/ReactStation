@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')

<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
body { background: #f4f6fb; color: #333;}
.container { width: 100%; max-width: 900px; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 25px; }
h1 { text-align: center; margin-bottom: 25px; color: #111827; font-size: 26px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #e5e7eb; padding: 12px; text-align: center; }
th { background-color: #2563eb; color: #fff; font-weight: 600; }
tr:hover { background-color: #f9fafb; }
.status { padding: 5px 10px; border-radius: 5px; display: inline-block; font-weight: 500; }

.inactive { background: #fee2e2; color: #991b1b; }
button { padding: 6px 12px; border: none; border-radius: 6px; cursor: pointer; transition: 0.3s; font-size: 14px; }
.btn-return { background-color: #ef4444; color: #fff; }
.btn-return:hover { opacity: 0.9; }
.top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
.top-bar input { width: 250px; padding: 8px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 15px; }
@media (max-width: 768px) { table { display: block; overflow-x: auto; } }
</style>
</head>
<body>

<div class="container">
  <h1>Purchased Products from Admin</h1>
  <div class="top-bar">
    <input type="text" id="search" placeholder="Search product..." onkeyup="filterTable()">
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price (৳)</th>
        <th>Total (৳)</th>
        <th>Status</th>
        <th>Return</th>
      </tr>
    </thead>
    <tbody id="purchaseBody"></tbody>
  </table>
</div>

<script>
// Sample purchased products by vendor from admin
const purchases = [
  {id:1, product:'Samsung Galaxy S21', qty:5, price:95000, status:'active'},
  {id:2, product:'Men T-Shirt', qty:10, price:1200, status:'active'},
  {id:3, product:'Rice Cooker', qty:3, price:4500, status:'inactive'}
];

function renderTable() {
  const tbody = document.getElementById('purchaseBody');
  tbody.innerHTML = '';
  purchases.forEach(p => {
    tbody.innerHTML += `
      <tr>
        <td>${p.id}</td>
        <td>${p.product}</td>
        <td>${p.qty}</td>
        <td>${p.price.toLocaleString()}</td>
        <td>${(p.qty * p.price).toLocaleString()}</td>
        <td><span class="status ${p.status === 'active' ? 'active' : 'inactive'}">${p.status.toUpperCase()}</span></td>
        <td><button class="btn-return" onclick="returnProduct(${p.id})">Return</button></td>
      </tr>
    `;
  });
}

function filterTable() {
  const filter = document.getElementById('search').value.toLowerCase();
  const tbody = document.getElementById('purchaseBody');
  tbody.innerHTML = '';
  purchases.filter(p => p.product.toLowerCase().includes(filter)).forEach(p => {
    tbody.innerHTML += `
      <tr>
        <td>${p.id}</td>
        <td>${p.product}</td>
        <td>${p.qty}</td>
        <td>${p.price.toLocaleString()}</td>
        <td>${(p.qty * p.price).toLocaleString()}</td>
        <td><span class="status ${p.status === 'active' ? 'active' : 'inactive'}">${p.status.toUpperCase()}</span></td>
        <td><button class="btn-return" onclick="returnProduct(${p.id})">Return</button></td>
      </tr>
    `;
  });
}

function returnProduct(id) {
  const product = purchases.find(p => p.id === id);
  if(confirm(`Do you want to return ${product.qty} of ${product.product}?`)) {
    alert(`Return request sent to Admin for ${product.product} (Qty: ${product.qty})`);
    // Later Laravel integration: save request in DB
  }
}

renderTable();
</script>

</body>


@endsection