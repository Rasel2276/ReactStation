@extends('admin.layouts.layout')
@section('admin_page_title')
Payment - Admin Panel
@endsection
@section('admin_layout')
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
  body { background: #f4f6fb; display: flex; justify-content: center; }
  .container { width: 100%; max-width: 1100px; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 30px; }
  h1 { text-align: center; margin-bottom: 20px; color: #111827; }
  table { width: 100%; border-collapse: collapse; margin-top: 10px; }
  th, td { border: 1px solid #e5e7eb; text-align: center; padding: 12px; font-size: 15px; }
  th { background: #f9fafb; color: #374151; }
  tr:nth-child(even) { background: #f3f4f6; }
  .status { padding: 5px 10px; border-radius: 6px; font-weight: 500; font-size: 14px; }
  .pending { background: #fff7ed; color: #d97706; }
  .approved { background: #dcfce7; color: #166534; }
  .rejected { background: #fee2e2; color: #991b1b; }
</style>
</head>
<body>
<div class="container">
  <h1>Vendor Payout Requests</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Vendor Name</th>
        <th>Amount (৳)</th>
        <th>Method</th>
        <th>Account</th>
        <th>Status</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody id="requestTable"></tbody>
  </table>
</div>

<script>
const payoutRequests = [
  { id: 1, vendor: "TechZone", amount: 2500, method: "bKash", account: "01712345678", status: "pending", date: "2025-10-20" },
  { id: 2, vendor: "Fashion Hub", amount: 1800, method: "Bank", account: "DBBL - 4587963", status: "approved", date: "2025-10-19" },
  { id: 3, vendor: "KitchenMart", amount: 3100, method: "Nagad", account: "01887654321", status: "rejected", date: "2025-10-18" },
];

function loadTable() {
  const tbody = document.getElementById("requestTable");
  tbody.innerHTML = "";
  payoutRequests.forEach(req => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${req.id}</td>
      <td>${req.vendor}</td>
      <td>${req.amount}</td>
      <td>${req.method}</td>
      <td>${req.account}</td>
      <td><span class="status ${req.status}">${req.status}</span></td>
      <td>${req.date}</td>
    `;
    tbody.appendChild(row);
  });
}
loadTable();
</script>
</body>


 




@endsection