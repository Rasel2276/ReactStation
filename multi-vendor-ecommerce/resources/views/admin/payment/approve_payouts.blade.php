@extends('admin.layouts.layout')
@section('admin_page_title')
Payment - Admin Panel
@endsection
@section('admin_layout')

<style>
  * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
  body { background: #f4f6fb; display: flex; justify-content: center; }
  .container { width: 100%; max-width: 1000px; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 30px; }
  h1 { text-align: center; margin-bottom: 20px; color: #111827; }
  table { width: 100%; border-collapse: collapse; }
  th, td { border: 1px solid #e5e7eb; text-align: center; padding: 12px; }
  th { background: #f9fafb; color: #374151; }
  tr:nth-child(even) { background: #f3f4f6; }
  button { padding: 8px 14px; border: none; border-radius: 6px; color: #fff; cursor: pointer; }
  .approve { background: #22c55e; }
  .approve:hover { background: #15803d; }
  .reject { background: #ef4444; }
  .reject:hover { background: #991b1b; }
</style>
</head>
<body>
<div class="container">
  <h1>Approve / Reject Payout Requests</h1>
  <table id="approveTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Vendor</th>
        <th>Amount</th>
        <th>Method</th>
        <th>Account</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div>

<script>
const requests = [
  { id: 101, vendor: "ElectroMart", amount: 4000, method: "Bank", account: "Sonali Bank 54122", status: "pending" },
  { id: 102, vendor: "Fashion Villa", amount: 2200, method: "bKash", account: "01799999999", status: "pending" },
];

function loadTable() {
  const tbody = document.querySelector("#approveTable tbody");
  tbody.innerHTML = "";
  requests.forEach((r, i) => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${r.id}</td>
      <td>${r.vendor}</td>
      <td>${r.amount}৳</td>
      <td>${r.method}</td>
      <td>${r.account}</td>
      <td>
        <button class="approve" onclick="approve(${i})">Approve</button>
        <button class="reject" onclick="reject(${i})">Reject</button>
      </td>`;
    tbody.appendChild(tr);
  });
}

function approve(i) {
  alert(`✅ Approved payout for ${requests[i].vendor}`);
  requests.splice(i, 1);
  loadTable();
}

function reject(i) {
  alert(`❌ Rejected payout for ${requests[i].vendor}`);
  requests.splice(i, 1);
  loadTable();
}

loadTable();
</script>
</body>


@endsection