@extends('admin.layouts.layout')
@section('admin_page_title')
Payment - Admin Panel
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
    background: #f4f6fb;
  }

  .container {
    width: 100%;
    max-width: 1200px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    padding: 30px;
  }

  h1 {
    text-align: center;
    color: #111827;
    margin-bottom: 25px;
    font-size: 28px;
  }

  .search-bar {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 15px;
  }

  .search-bar input {
    padding: 10px 16px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    width: 280px;
    font-size: 15px;
    transition: 0.2s;
  }

  .search-bar input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 5px rgba(59,130,246,0.4);
  }

  table {
    width: 100%;
    border-collapse: collapse;
    min-width: 800px;
  }

  th, td {
    border: 1px solid #e5e7eb;
    text-align: center;
    padding: 12px 10px;
    font-size: 15px;
  }

  th {
    background: #f9fafb;
    color: #374151;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  tr:nth-child(even) {
    background: #f3f4f6;
  }

  tr:hover {
    background: #e0f2fe;
  }

  .status {
    padding: 5px 12px;
    border-radius: 8px;
    font-weight: 500;
    font-size: 14px;
    display: inline-block;
    min-width: 70px;
  }

  .pending { background: #fff7ed; color: #d97706; }
  .approved { background: #dcfce7; color: #166534; }
  .rejected { background: #fee2e2; color: #991b1b; }

  button.view-btn {
    padding: 5px 12px;
    border: none;
    border-radius: 6px;
    background-color: #3b82f6;
    color: #fff;
    cursor: pointer;
    transition: 0.2s;
  }

  button.view-btn:hover {
    background-color: #1d4ed8;
  }

  @media (max-width: 900px) {
    table {
      font-size: 13px;
    }
    .search-bar input {
      width: 200px;
    }
  }

  @media (max-width: 600px) {
    table {
      display: block;
      overflow-x: auto;
    }
  }
</style>
</head>
<body>

<div class="container">
  <h1>Transaction History</h1>
  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search by vendor/customer..." onkeyup="filterTable()">
  </div>
  <table id="transactionTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Vendor/Customer</th>
        <th>Order/Transaction ID</th>
        <th>Amount (৳)</th>
        <th>Method</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="transactionBody"></tbody>
  </table>
</div>

<script>
const transactions = [
  { id: 1, type: "Payout", name: "TechZone", orderId: "TRX101", amount: 2500, method: "bKash", status: "pending", date: "2025-10-20" },
  { id: 2, type: "Payment", name: "Customer A", orderId: "ORD202", amount: 1500, method: "Credit Card", status: "approved", date: "2025-10-19" },
  { id: 3, type: "Refund", name: "Customer B", orderId: "ORD203", amount: 1200, method: "bKash", status: "rejected", date: "2025-10-18" },
  { id: 4, type: "Payout", name: "Fashion Hub", orderId: "TRX102", amount: 1800, method: "Bank Transfer", status: "approved", date: "2025-10-17" },
];

function loadTable() {
  const tbody = document.getElementById("transactionBody");
  tbody.innerHTML = "";
  transactions.forEach(tx => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${tx.id}</td>
      <td>${tx.type}</td>
      <td>${tx.name}</td>
      <td>${tx.orderId}</td>
      <td>${tx.amount.toLocaleString()}৳</td>
      <td>${tx.method}</td>
      <td><span class="status ${tx.status}">${tx.status.charAt(0).toUpperCase() + tx.status.slice(1)}</span></td>
      <td>${tx.date}</td>
      <td><button class="view-btn" onclick='viewTransaction(${JSON.stringify(tx)})'>View</button></td>
    `;
    tbody.appendChild(tr);
  });
}

function viewTransaction(tx) {
  alert(
    `Transaction Details:\n\n` +
    `ID: ${tx.id}\n` +
    `Type: ${tx.type}\n` +
    `Vendor/Customer: ${tx.name}\n` +
    `Order/Transaction ID: ${tx.orderId}\n` +
    `Amount: ${tx.amount.toLocaleString()}৳\n` +
    `Method: ${tx.method}\n` +
    `Status: ${tx.status.charAt(0).toUpperCase() + tx.status.slice(1)}\n` +
    `Date: ${tx.date}`
  );
}

function filterTable() {
  const filter = document.getElementById("searchInput").value.toLowerCase();
  document.querySelectorAll("#transactionBody tr").forEach(row => {
    const name = row.children[2].textContent.toLowerCase();
    row.style.display = name.includes(filter) ? "" : "none";
  });
}

loadTable();
</script>

</body>




@endsection