@extends('customer.layouts.layout')
@section('admin_page_title')
History page
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
    width: 100%;
    max-width: 1000px;
    margin: 10px auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    padding: 25px;
  }
  h1 {
    text-align: center;
    font-size: 26px;
    margin-bottom: 25px;
    color: #111827;
  }
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    border: 1px solid #e5e7eb;
    padding: 12px;
    text-align: center;
  }
  th {
    background-color: #2563eb;
    color: #fff;
    font-weight: 600;
  }
  tr:hover {
    background-color: #f9fafb;
  }
  .status {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 14px;
  }
  .pending { background: #fef9c3; color: #854d0e; }
  .shipped { background: #dbeafe; color: #1e3a8a; }
  .delivered { background: #dcfce7; color: #166534; }
  .cancelled { background: #fee2e2; color: #991b1b; }
  .top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    flex-wrap: wrap;
  }
  .top-bar input {
    width: 250px;
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
  }
  @media (max-width: 768px) {
    table {
      display: block;
      overflow-x: auto;
      white-space: nowrap;
    }
    h1 {
      font-size: 22px;
    }
  }
</style>
</head>
<body>

<div class="container">
  <h1>My Order History</h1>
  <div class="top-bar">
    <input type="text" id="search" placeholder="Search by product..." onkeyup="filterOrders()">
  </div>

  <table>
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Product</th>
        <th>Date</th>
        <th>Quantity</th>
        <th>Total (৳)</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="orderBody"></tbody>
  </table>
</div>

<script>
// ✅ Demo order history (Later: Fetch from Laravel)
const orders = [
  {id:'ORD-1001', product:'Samsung Galaxy S24', date:'2025-10-12', qty:1, total:98000, status:'delivered'},
  {id:'ORD-1002', product:'Men’s Casual Shirt', date:'2025-10-14', qty:2, total:2400, status:'shipped'},
  {id:'ORD-1003', product:'Rice Cooker', date:'2025-10-18', qty:1, total:4200, status:'pending'},
  {id:'ORD-1004', product:'Bluetooth Headset', date:'2025-10-20', qty:1, total:2200, status:'cancelled'}
];

function renderOrders() {
  const tbody = document.getElementById('orderBody');
  tbody.innerHTML = '';
  orders.forEach(o => {
    tbody.innerHTML += `
      <tr>
        <td>${o.id}</td>
        <td>${o.product}</td>
        <td>${o.date}</td>
        <td>${o.qty}</td>
        <td>${o.total.toLocaleString()}</td>
        <td><span class="status ${o.status}">${o.status.toUpperCase()}</span></td>
      </tr>
    `;
  });
}

// ✅ Search filter
function filterOrders() {
  const filter = document.getElementById('search').value.toLowerCase();
  const tbody = document.getElementById('orderBody');
  tbody.innerHTML = '';
  orders.filter(o => o.product.toLowerCase().includes(filter)).forEach(o => {
    tbody.innerHTML += `
      <tr>
        <td>${o.id}</td>
        <td>${o.product}</td>
        <td>${o.date}</td>
        <td>${o.qty}</td>
        <td>${o.total.toLocaleString()}</td>
        <td><span class="status ${o.status}">${o.status.toUpperCase()}</span></td>
      </tr>
    `;
  });
}

renderOrders();
</script>

</body>

@endsection