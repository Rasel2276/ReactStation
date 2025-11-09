@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')


<style>
* { box-sizing:border-box; margin:0; padding:0; font-family:'Poppins', sans-serif; }
body { background:#f4f6fb; }
.container { max-width:1100px; margin:auto; background:#fff; padding:30px; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,0.1);}
h1 { text-align:center; color:#111827; margin-bottom:25px; font-size:26px; }
.top-bar { display:flex; justify-content:flex-end; margin-bottom:15px; }
.top-bar input { padding:8px 12px; border:1px solid #ccc; border-radius:6px; outline:none; font-size:15px; width:250px; }
table { width:100%; border-collapse:collapse; }
th, td { border:1px solid #ddd; padding:12px; text-align:center; }
th { background:#2563eb; color:#fff; font-weight:600; }
tr:hover { background:#f3f4f6; }
@media(max-width:768px){ table{ display:block; overflow-x:auto; } }
</style>
</head>
<body>
<div class="container">
<h1>Admin → Vendor Sales Report</h1>
<div class="top-bar">
<input type="text" id="searchInput" placeholder="Search product/vendor..." onkeyup="filterTable()">
</div>
<table id="salesTable">
<thead>
<tr>
<th>ID</th>
<th>Product</th>
<th>Vendor</th>
<th>Qty Sold</th>
<th>Price (৳)</th>
<th>Total Amount (৳)</th>
<th>Date</th>
</tr>
</thead>
<tbody></tbody>
</table>
</div>

<script>
// Sample sales data
const salesData = [
  {id:1, product:"Wireless Earbuds", vendor:"Vendor A", qty:3, price:1500, date:"2025-10-20"},
  {id:2, product:"Smart Watch", vendor:"Vendor B", qty:2, price:3500, date:"2025-10-21"},
  {id:3, product:"Bluetooth Speaker", vendor:"Vendor C", qty:1, price:2500, date:"2025-10-22"},
  {id:4, product:"Wireless Earbuds", vendor:"Vendor B", qty:1, price:1500, date:"2025-10-23"},
];

function renderTable() {
  const tbody = document.querySelector("#salesTable tbody");
  tbody.innerHTML = "";
  salesData.forEach(sale=>{
    tbody.innerHTML += `
      <tr>
        <td>${sale.id}</td>
        <td>${sale.product}</td>
        <td>${sale.vendor}</td>
        <td>${sale.qty}</td>
        <td>${sale.price.toLocaleString()}</td>
        <td>${(sale.qty*sale.price).toLocaleString()}</td>
        <td>${sale.date}</td>
      </tr>
    `;
  });
}

function filterTable(){
  const filter = document.getElementById("searchInput").value.toLowerCase();
  const rows = document.querySelectorAll("#salesTable tbody tr");
  rows.forEach(row=>{
    const product = row.children[1].textContent.toLowerCase();
    const vendor = row.children[2].textContent.toLowerCase();
    row.style.display = (product.includes(filter) || vendor.includes(filter)) ? "" : "none";
  });
}

renderTable();
</script>
</body>



@endsection