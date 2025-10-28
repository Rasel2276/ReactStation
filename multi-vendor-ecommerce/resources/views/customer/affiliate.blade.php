@extends('customer.layouts.layout')
@section('admin_page_title')
payment page
@endsection
@section('customer_layout')

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
  }
  body {
    background: #f4f6fb;
    color: #333;
  }
  .container {
    max-width: 800px;
    background: #fff;
    margin: 10px auto;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
  }
  h1 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 26px;
    color: #111827;
  }
  .referral-box {
    background: #f9fafb;
    border: 2px dashed #2563eb;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
    margin-bottom: 25px;
  }
  .referral-box input {
    width: 80%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    margin-right: 10px;
  }
  .copy-btn {
    padding: 10px 16px;
    background-color: #2563eb;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
  }
  .copy-btn:hover {
    background-color: #1d4ed8;
  }
  .stats {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-top: 25px;
  }
  .card {
    flex: 1 1 45%;
    background: #f3f4f6;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    margin-bottom: 15px;
  }
  .card h3 {
    color: #2563eb;
    font-size: 24px;
    margin-bottom: 8px;
  }
  .card p {
    color: #555;
    font-size: 15px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 25px;
  }
  th, td {
    border: 1px solid #e5e7eb;
    padding: 10px;
    text-align: center;
  }
  th {
    background-color: #2563eb;
    color: #fff;
  }
  tr:hover {
    background-color: #f9fafb;
  }
</style>
</head>
<body>

<div class="container">
  <h1>Affiliate Dashboard</h1>

  <div class="referral-box">
    <h3>Your Referral Link</h3>
    <div style="margin-top:10px;">
      <input type="text" id="refLink" readonly value="https://yourshop.com/ref?code=CUST12345">
      <button class="copy-btn" onclick="copyReferral()">Copy</button>
    </div>
    <p style="margin-top:10px; color:#555;">Share this link with friends and earn commission for every purchase!</p>
  </div>

  <div class="stats">
    <div class="card">
      <h3 id="clicks">125</h3>
      <p>Total Clicks</p>
    </div>
    <div class="card">
      <h3 id="signups">34</h3>
      <p>Total Signups</p>
    </div>
    <div class="card">
      <h3 id="sales">18</h3>
      <p>Successful Sales</p>
    </div>
    <div class="card">
      <h3 id="commission">৳2,450</h3>
      <p>Total Commission</p>
    </div>
  </div>

  <h2 style="margin-top:30px; color:#111827;">Commission History</h2>
  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Referral User</th>
        <th>Order ID</th>
        <th>Commission (৳)</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="commissionTable"></tbody>
  </table>
</div>

<script>
const commissions = [
  {date: '2025-10-10', user: 'Jahid Hasan', orderId: '#ORD1021', amount: 150, status: 'Paid'},
  {date: '2025-10-15', user: 'Sabbir Ahmed', orderId: '#ORD1042', amount: 200, status: 'Pending'},
  {date: '2025-10-20', user: 'Nusrat Jahan', orderId: '#ORD1078', amount: 300, status: 'Paid'}
];

function renderCommissionTable() {
  const tbody = document.getElementById('commissionTable');
  tbody.innerHTML = commissions.map(c => `
    <tr>
      <td>${c.date}</td>
      <td>${c.user}</td>
      <td>${c.orderId}</td>
      <td>${c.amount}</td>
      <td style="color:${c.status==='Paid' ? 'green':'orange'}; font-weight:600;">${c.status}</td>
    </tr>
  `).join('');
}

function copyReferral() {
  const refInput = document.getElementById('refLink');
  refInput.select();
  refInput.setSelectionRange(0, 99999);
  document.execCommand('copy');
  alert('✅ Referral link copied!');
}

renderCommissionTable();
</script>

</body>

@endsection