@extends('admin.layouts.layout')
@section('admin_page_title')
Product - Admin Panel
@endsection
@section('admin_layout')

<style>
* { box-sizing: border-box; margin:0; padding:0; font-family:'Poppins', sans-serif; }
body { background:#f4f6fb; }
.container { max-width:1100px; margin:auto; background:#fff; padding:30px; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,0.1);}
h1 { text-align:center; color:#111827; margin-bottom:25px; }

table { width:100%; border-collapse:collapse; }
th, td { border:1px solid #ddd; padding:12px; text-align:center; }
th { background:#f9fafb; }
tr:nth-child(even) { background:#f3f4f6; }
tr:hover { background:#e0f2fe; }

.status { padding:5px 12px; border-radius:6px; font-weight:500; font-size:14px; display:inline-block;}
.pending { background:#fff7ed; color:#d97706; }
.approved { background:#dcfce7; color:#166534; }
.rejected { background:#fee2e2; color:#991b1b; }

.action-buttons { display:flex; justify-content:center; gap:8px; flex-wrap:wrap; }
button { padding:7px 12px; border:none; border-radius:6px; color:#fff; font-size:14px; cursor:pointer; transition:.3s; }
.approve { background:#22c55e; }
.approve:hover { background:#15803d; }
.reject { background:#ef4444; }
.reject:hover { background:#991b1b; }
.view { background:#3b82f6; }
.view:hover { background:#1e40af; }

.search-bar { display:flex; justify-content:flex-end; margin-bottom:15px; }
.search-bar input { padding:8px 14px; border:1px solid #d1d5db; border-radius:8px; width:250px; font-size:15px; }
@media (max-width:768px){ table{font-size:13px;} .search-bar input{width:200px;} }
</style>
</head>
<body>
<div class="container">
<h1>Vendor Product Return Requests</h1>

<div class="search-bar">
<input type="text" id="searchInput" placeholder="Search by vendor..." onkeyup="filterTable()">
</div>

<table id="returnTable">
<thead>
<tr>
<th>ID</th>
<th>Vendor</th>
<th>Product</th>
<th>Order ID</th>
<th>Qty</th>
<th>Reason</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody></tbody>
</table>
</div>

<script>
// Vendor return requests
const returns = [
  { id: 1, vendor: "Vendor A", product: "Wireless Earbuds", orderId: "ORD1001", qty: 1, reason: "Defective sound", status: "pending" },
  { id: 2, vendor: "Vendor B", product: "Smart Watch", orderId: "ORD1002", qty: 2, reason: "Strap broken", status: "pending" },
  { id: 3, vendor: "Vendor C", product: "Bluetooth Speaker", orderId: "ORD1003", qty: 1, reason: "Wrong description", status: "approved" },
];

// Admin & Vendor stock simulation
let adminStock = {
  "Wireless Earbuds": 10,
  "Smart Watch": 5,
  "Bluetooth Speaker": 3
};

let vendorStock = {
  "Vendor A": 0,
  "Vendor B": 0,
  "Vendor C": 1
};

function loadTable() {
  const tbody = document.querySelector("#returnTable tbody");
  tbody.innerHTML = "";
  returns.forEach((item, i) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${item.id}</td>
      <td>${item.vendor}</td>
      <td>${item.product}</td>
      <td>${item.orderId}</td>
      <td>${item.qty}</td>
      <td>${item.reason}</td>
      <td><span class="status ${item.status}">${item.status.charAt(0).toUpperCase() + item.status.slice(1)}</span></td>
      <td>
        <div class="action-buttons">
          ${item.status === "pending" 
            ? `<button class="approve" onclick="approveReturn(${i})">Approve</button>
               <button class="reject" onclick="rejectReturn(${i})">Reject</button>` 
            : ""}
          <button class="view" onclick="viewReturn(${i})">View</button>
        </div>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function approveReturn(i) {
  const item = returns[i];
  if(adminStock[item.product] >= item.qty){
    adminStock[item.product] -= item.qty;
    vendorStock[item.vendor] = (vendorStock[item.vendor] || 0) + item.qty;
    item.status = "approved";
    alert(`✅ Approved!\nAdmin stock: ${adminStock[item.product]}\nVendor stock: ${vendorStock[item.vendor]}`);
  } else {
    alert(`❌ Not enough admin stock for ${item.product}`);
  }
  loadTable();
}

function rejectReturn(i) {
  returns[i].status = "rejected";
  alert(`❌ Return rejected for ${returns[i].vendor}`);
  loadTable();
}

function viewReturn(i) {
  const r = returns[i];
  alert(`
📦 Vendor Return Details:
--------------------------
Vendor: ${r.vendor}
Product: ${r.product}
Order ID: ${r.orderId}
Qty: ${r.qty}
Reason: ${r.reason}
Status: ${r.status.toUpperCase()}
  `);
}

function filterTable() {
  const filter = document.getElementById("searchInput").value.toLowerCase();
  const rows = document.querySelectorAll("#returnTable tbody tr");
  rows.forEach(row => {
    const name = row.children[1].textContent.toLowerCase();
    row.style.display = name.includes(filter) ? "" : "none";
  });
}

loadTable();
</script>
</body>





@endsection