@extends('admin.layouts.layout')
@section('admin_page_title')
Product - Admin Panel
@endsection
@section('admin_layout')

<style>
* { box-sizing: border-box; margin:0; padding:0; font-family:'Poppins', sans-serif; }
body { background:#f4f6fb; }
.container { max-width:1100px; margin:auto; background:#fff; padding:30px; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,0.1);}
h1 { text-align:center; color:#111827; margin-bottom:25px; font-size:26px; }
.top-bar { display:flex; justify-content:flex-end; margin-bottom:15px; }
.top-bar input { padding:8px 12px; border:1px solid #ccc; border-radius:6px; outline:none; font-size:15px; width:250px; }
table { width:100%; border-collapse:collapse; }
th, td { border:1px solid #ddd; padding:12px; text-align:center; }
th { background:#2563eb; color:#fff; }
tr:hover { background:#f3f4f6; }
.status { padding:5px 10px; border-radius:6px; display:inline-block; font-weight:500; }
.pending { background:#fff7ed; color:#d97706; }
.approved { background:#dcfce7; color:#166534; }
.rejected { background:#fee2e2; color:#991b1b; }
.actions { display:flex; gap:5px; justify-content:center; flex-wrap:wrap; }
button { padding:6px 10px; border:none; border-radius:6px; cursor:pointer; font-size:14px; color:#fff; transition:.3s; }
button.approve { background:#22c55e; }
button.reject { background:#ef4444; }
button.view { background:#2563eb; }
button:hover { opacity:.9; }
@media (max-width:768px){ table{ display:block; overflow-x:auto; } }
</style>
</head>
<body>
<div class="container">
<h1>Vendor Purchase Requests</h1>
<div class="top-bar">
<input type="text" placeholder="Search vendor..." id="searchInput" onkeyup="filterTable()">
</div>
<table id="purchaseTable">
<thead>
<tr>
<th>ID</th>
<th>Vendor</th>
<th>Product</th>
<th>Qty</th>
<th>Request Date</th>
<th>Status</th>
<th>Actions</th>
</tr>
</thead>
<tbody></tbody>
</table>
</div>

<script>
// Sample purchase requests
const purchaseRequests = [
  {id:1, vendor:"Vendor A", product:"Wireless Earbuds", qty:3, date:"2025-10-25", status:"pending"},
  {id:2, vendor:"Vendor B", product:"Smart Watch", qty:2, date:"2025-10-26", status:"pending"},
  {id:3, vendor:"Vendor C", product:"Bluetooth Speaker", qty:1, date:"2025-10-24", status:"approved"},
];

// Stock simulation
let adminStock = {
  "Wireless Earbuds": 10,
  "Smart Watch": 5,
  "Bluetooth Speaker": 3
};
let vendorStock = {
  "Vendor A":0,
  "Vendor B":0,
  "Vendor C":1
};

function loadTable() {
  const tbody = document.querySelector("#purchaseTable tbody");
  tbody.innerHTML = "";
  purchaseRequests.forEach((req, i) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${req.id}</td>
      <td>${req.vendor}</td>
      <td>${req.product}</td>
      <td>${req.qty}</td>
      <td>${req.date}</td>
      <td><span class="status ${req.status}">${req.status.charAt(0).toUpperCase()+req.status.slice(1)}</span></td>
      <td class="actions">
        ${req.status==="pending" 
          ? `<button class="approve" onclick="approveRequest(${i})">Approve</button>
             <button class="reject" onclick="rejectRequest(${i})">Reject</button>`
          : ""}
        <button class="view" onclick="viewRequest(${i})">View</button>
      </td>
    `;
    tbody.appendChild(tr);
  });
}

function approveRequest(i){
  const req = purchaseRequests[i];
  if(adminStock[req.product]>=req.qty){
    adminStock[req.product]-=req.qty;
    vendorStock[req.vendor] = (vendorStock[req.vendor] || 0) + req.qty;
    req.status="approved";
    alert(`✅ Approved!\nAdmin Stock of ${req.product}: ${adminStock[req.product]}\nVendor Stock: ${vendorStock[req.vendor]}`);
  } else {
    alert(`❌ Not enough admin stock for ${req.product}`);
  }
  loadTable();
}

function rejectRequest(i){
  purchaseRequests[i].status="rejected";
  alert(`❌ Request rejected for ${purchaseRequests[i].vendor}`);
  loadTable();
}

function viewRequest(i){
  const r = purchaseRequests[i];
  alert(`Purchase Request Details:\n\nVendor: ${r.vendor}\nProduct: ${r.product}\nQty: ${r.qty}\nRequest Date: ${r.date}\nStatus: ${r.status.toUpperCase()}`);
}

function filterTable(){
  const filter = document.getElementById("searchInput").value.toLowerCase();
  const rows = document.querySelectorAll("#purchaseTable tbody tr");
  rows.forEach(row=>{
    const name = row.children[1].textContent.toLowerCase();
    row.style.display = name.includes(filter) ? "" : "none";
  });
}

loadTable();
</script>
</body>


@endsection