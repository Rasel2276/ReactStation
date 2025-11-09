@extends('admin.layouts.layout')
@section('admin_page_title')
Payment - Admin Panel
@endsection
@section('admin_layout')

<style>
  * { box-sizing: border-box; margin:0; padding:0; font-family:'Poppins', sans-serif; }
  body { background:#f4f6fb; }
  .container { width:100%; max-width:1200px; background:#fff; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,0.1); padding:30px; }
  h1 { text-align:center; margin-bottom:25px; color:#111827; font-size:28px; }
  .controls { display:flex; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:10px; }
  select, button { padding:10px 15px; font-size:15px; border-radius:8px; border:1px solid #d1d5db; cursor:pointer; }
  button { background:#3b82f6; color:white; border:none; transition:0.2s; }
  button:hover { background:#2563eb; }
  table { width:100%; border-collapse:collapse; min-width:800px; }
  th, td { border:1px solid #e5e7eb; padding:12px; text-align:center; font-size:15px; }
  th { background:#f9fafb; color:#374151; text-transform:uppercase; letter-spacing:0.5px; }
  tr:nth-child(even) { background:#f3f4f6; }
  tr:hover { background:#e0f2fe; }
  .status { padding:5px 12px; border-radius:8px; font-weight:500; font-size:14px; display:inline-block; min-width:70px; }
  .pending { background:#fff7ed; color:#d97706; }
  .approved { background:#dcfce7; color:#166534; }
  .rejected { background:#fee2e2; color:#991b1b; }
</style>
</head>
<body>

<div class="container">
  <h1>Monthly Transaction Report</h1>
  <div class="controls">
    <select id="monthSelect" onchange="filterMonth()">
      <option value="">-- Select Month --</option>
      <option value="01">January</option>
      <option value="02">February</option>
      <option value="03">March</option>
      <option value="04">April</option>
      <option value="05">May</option>
      <option value="06">June</option>
      <option value="07">July</option>
      <option value="08">August</option>
      <option value="09">September</option>
      <option value="10">October</option>
      <option value="11">November</option>
      <option value="12">December</option>
    </select>
    <button onclick="printReport()">Print Report</button>
  </div>
  <table id="reportTable">
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
      </tr>
    </thead>
    <tbody id="reportBody"></tbody>
  </table>
</div>

<script>
const transactions = [
  { id:1, type:"Payout", name:"TechZone", orderId:"TRX101", amount:2500, method:"bKash", status:"pending", date:"2025-10-20" },
  { id:2, type:"Payment", name:"Customer A", orderId:"ORD202", amount:1500, method:"Credit Card", status:"approved", date:"2025-10-19" },
  { id:3, type:"Refund", name:"Customer B", orderId:"ORD203", amount:1200, method:"bKash", status:"rejected", date:"2025-09-28" },
  { id:4, type:"Payout", name:"Fashion Hub", orderId:"TRX102", amount:1800, method:"Bank Transfer", status:"approved", date:"2025-10-17" },
  { id:5, type:"Payment", name:"Customer C", orderId:"ORD204", amount:2000, method:"Nagad", status:"approved", date:"2025-08-12" },
];

function loadTable(filtered=transactions) {
  const tbody = document.getElementById("reportBody");
  tbody.innerHTML = "";
  filtered.forEach(tx => {
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
    `;
    tbody.appendChild(tr);
  });
}

function filterMonth() {
  const month = document.getElementById("monthSelect").value;
  if(!month) {
    loadTable();
    return;
  }
  const filtered = transactions.filter(tx => tx.date.split('-')[1] === month);
  loadTable(filtered);
}

function printReport() {
  const printContents = document.querySelector('.container').innerHTML;
  const w = window.open('', '', 'height=600,width=800');
  w.document.write('<html><head><title>Print Report</title></head><body>');
  w.document.write(printContents);
  w.document.write('</body></html>');
  w.document.close();
  w.print();
}

loadTable();
</script>

</body>


@endsection