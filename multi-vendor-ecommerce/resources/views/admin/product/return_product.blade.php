@extends('admin.layouts.layout')
@section('admin_page_title')
Product - Admin Panel
@endsection
@section('admin_layout')

<style>
  * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
  body { background: #f4f6fb;}
  .container { width: 100%; max-width: 1100px; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 30px; }
  h1 { text-align: center; color: #111827; margin-bottom: 25px; font-size: 26px; }

  table { width: 100%; border-collapse: collapse; }
  th, td { border: 1px solid #e5e7eb; text-align: center; padding: 12px; font-size: 15px; }
  th { background: #f9fafb; color: #374151; }
  tr:nth-child(even) { background: #f3f4f6; }
  tr:hover { background: #e0f2fe; }

  .status {
    padding: 5px 12px;
    border-radius: 6px;
    font-weight: 500;
    font-size: 14px;
    display: inline-block;
  }
  .pending { background: #fff7ed; color: #d97706; }
  .approved { background: #dcfce7; color: #166534; }
  .rejected { background: #fee2e2; color: #991b1b; }

  .action-buttons {
    display: flex;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
  }

  button {
    padding: 7px 12px;
    border: none;
    border-radius: 6px;
    color: #fff;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s;
  }

  .approve { background: #22c55e; }
  .approve:hover { background: #15803d; }

  .reject { background: #ef4444; }
  .reject:hover { background: #991b1b; }

  .view { background: #3b82f6; }
  .view:hover { background: #1e40af; }

  .search-bar {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 15px;
  }
  .search-bar input {
    padding: 8px 14px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    width: 250px;
    font-size: 15px;
  }

  @media (max-width: 768px) {
    table { font-size: 13px; }
    .search-bar input { width: 200px; }
  }
</style>
</head>
<body>

<div class="container">
  <h1>Product Return Requests</h1>

  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search by customer..." onkeyup="filterTable()">
  </div>

  <table id="returnTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Product</th>
        <th>Order ID</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<script>
const returns = [
  { id: 1, customer: "Hasan", product: "Wireless Earbuds", orderId: "ORD1001", reason: "Defective sound", status: "pending", date: "2025-10-20" },
  { id: 2, customer: "Sumi", product: "Smart Watch", orderId: "ORD1002", reason: "Strap broken", status: "approved", date: "2025-10-18" },
  { id: 3, customer: "Rafi", product: "Bluetooth Speaker", orderId: "ORD1003", reason: "Didn’t match description", status: "rejected", date: "2025-10-17" },
];

function loadTable() {
  const tbody = document.querySelector("#returnTable tbody");
  tbody.innerHTML = "";
  returns.forEach((item, i) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${item.id}</td>
      <td>${item.customer}</td>
      <td>${item.product}</td>
      <td>${item.orderId}</td>
      <td>${item.reason}</td>
      <td><span class="status ${item.status}">${item.status.charAt(0).toUpperCase() + item.status.slice(1)}</span></td>
      <td>${item.date}</td>
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
  returns[i].status = "approved";
  alert(`✅ Return approved for ${returns[i].customer}`);
  loadTable();
}

function rejectReturn(i) {
  returns[i].status = "rejected";
  alert(`❌ Return rejected for ${returns[i].customer}`);
  loadTable();
}

function viewReturn(i) {
  const r = returns[i];
  alert(`
📦 Product Return Details:
--------------------------
Customer: ${r.customer}
Product: ${r.product}
Order ID: ${r.orderId}
Reason: ${r.reason}
Status: ${r.status.toUpperCase()}
Date: ${r.date}
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