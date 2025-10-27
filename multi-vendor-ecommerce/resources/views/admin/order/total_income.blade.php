@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout')

<style>
* { box-sizing:border-box; margin:0; padding:0; font-family:'Poppins', sans-serif; }
body { background:#f4f6fb; }
.container { max-width:1100px; margin:auto; }
h1 { text-align:center; color:#111827; margin-bottom:20px; font-size:26px; }
.income-cards { display:flex; justify-content:space-between; gap:20px; margin-bottom:25px; flex-wrap:wrap; }
.income-card { flex:1; background:#2563eb; color:#fff; padding:20px; border-radius:12px; text-align:center; font-size:20px; font-weight:600; box-shadow:0 4px 12px rgba(0,0,0,0.1);}
table { width:100%; border-collapse:collapse; background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 6px 18px rgba(0,0,0,0.1);}
th, td { border-bottom:1px solid #ddd; padding:12px; text-align:center; }
th { background:#2563eb; color:#fff; font-weight:600; }
tr:hover { background:#f3f4f6; }
.top-bar { display:flex; justify-content:flex-end; margin-bottom:10px; }
.top-bar input { padding:8px 12px; border:1px solid #ccc; border-radius:6px; outline:none; font-size:15px; width:250px; }
@media(max-width:768px){ .income-cards{flex-direction:column;} table{ display:block; overflow-x:auto; } }
</style>
</head>
<body>
<div class="container">
<h1>Admin & Vendor Income & Commission</h1>

<div class="income-cards">
  <div class="income-card" id="adminIncome">Admin Profit: ৳0</div>
  <div class="income-card" id="vendorIncome">Vendor Total Purchase: ৳0</div>
  <div class="income-card" id="adminCommission">Admin Commission: ৳0</div>
</div>

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
<th>Admin Profit (৳)</th>
<th>Commission (৳)</th>
<th>Date</th>
</tr>
</thead>
<tbody></tbody>
</table>
</div>

<script>
// Sample sales data (admin sells to vendor)
const salesData = [
  {id:1, product:"Wireless Earbuds", vendor:"Vendor A", qty:3, price:1500, date:"2025-10-20"},
  {id:2, product:"Smart Watch", vendor:"Vendor B", qty:2, price:3500, date:"2025-10-21"},
  {id:3, product:"Bluetooth Speaker", vendor:"Vendor C", qty:1, price:2500, date:"2025-10-22"},
  {id:4, product:"Wireless Earbuds", vendor:"Vendor B", qty:1, price:1500, date:"2025-10-23"},
];

// Admin cost price (for profit calculation)
const adminCostPrice = {
  "Wireless Earbuds":1200,
  "Smart Watch":3000,
  "Bluetooth Speaker":2000
};

// Commission % that admin takes from vendor sales
const commissionPercent = 10; // 10%

function renderTable(){
  const tbody = document.querySelector("#salesTable tbody");
  tbody.innerHTML = '';
  let totalAdminProfit = 0;
  let totalVendorPurchase = 0;
  let totalCommission = 0;

  salesData.forEach(sale=>{
    const totalAmount = sale.qty * sale.price;
    const adminProfit = sale.qty * (sale.price - (adminCostPrice[sale.product] || 0));
    const commission = totalAmount * (commissionPercent/100);

    totalAdminProfit += adminProfit;
    totalVendorPurchase += totalAmount;
    totalCommission += commission;

    tbody.innerHTML += `
      <tr>
        <td>${sale.id}</td>
        <td>${sale.product}</td>
        <td>${sale.vendor}</td>
        <td>${sale.qty}</td>
        <td>${sale.price.toLocaleString()}</td>
        <td>${totalAmount.toLocaleString()}</td>
        <td>${adminProfit.toLocaleString()}</td>
        <td>${commission.toLocaleString()}</td>
        <td>${sale.date}</td>
      </tr>
    `;
  });

  document.getElementById("adminIncome").textContent = `Admin Profit: ৳${totalAdminProfit.toLocaleString()}`;
  document.getElementById("vendorIncome").textContent = `Vendor Total Purchase: ৳${totalVendorPurchase.toLocaleString()}`;
  document.getElementById("adminCommission").textContent = `Admin Commission: ৳${totalCommission.toLocaleString()}`;
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