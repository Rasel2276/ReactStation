@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
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
      background-color: #f4f6fb;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
    }
    .table-container {
      width: 100%;
      max-width: 1100px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
      padding: 25px;
    }
    h1 {
      text-align: center;
      color: #111827;
      margin-bottom: 20px;
      font-size: 26px;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }
    .top-bar input {
      width: 250px;
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      outline: none;
      font-size: 15px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
    }
    th {
      background-color: #2563eb;
      color: #fff;
      font-weight: 600;
    }
    tr:hover {
      background-color: #f9fafb;
    }
    .actions {
      display: flex;
      gap: 10px;
    }
    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
      transition: 0.2s;
    }
    .btn-view {
      background-color: #22c55e;
      color: #fff;
    }
    .btn-update {
      background-color: #2563eb;
      color: #fff;
    }
    .btn-delete {
      background-color: #ef4444;
      color: #fff;
    }
    .btn:hover {
      opacity: 0.9;
    }
    .status {
      font-weight: 600;
    }
    .paid {
      color: green;
    }
    .unpaid {
      color: red;
    }
    .delivered {
      color: green;
    }
    .pending {
      color: orange;
    }
    .canceled {
      color: red;
    }
    @media (max-width: 768px) {
      table {
        display: block;
        overflow-x: auto;
      }
    }
  </style>
</head>
<body>
  <div class="table-container">
    <h1>Manage Orders</h1>
    <div class="top-bar">
      <input type="text" id="search" placeholder="Search order..." onkeyup="filterOrders()">
      <button class="btn btn-update" onclick="addNewOrder()">+ Add Order</button>
    </div>
    <table id="orderTable">
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Customer</th>
          <th>Date</th>
          <th>Total (৳)</th>
          <th>Payment</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="orderBody"></tbody>
    </table>
  </div>

  <script>
    const orders = [
      {id: 'ORD-1001', customer: 'John Doe', date: '2025-10-10', total: 95000, payment: 'Paid', status: 'Delivered'},
      {id: 'ORD-1002', customer: 'Sarah Khan', date: '2025-10-12', total: 1200, payment: 'Unpaid', status: 'Pending'},
      {id: 'ORD-1003', customer: 'David Roy', date: '2025-10-14', total: 4500, payment: 'Paid', status: 'Canceled'},
    ];

    function renderOrders() {
      const tbody = document.getElementById('orderBody');
      tbody.innerHTML = '';
      orders.forEach(o => {
        tbody.innerHTML += `
          <tr>
            <td>${o.id}</td>
            <td>${o.customer}</td>
            <td>${o.date}</td>
            <td>${o.total.toLocaleString()}</td>
            <td class="status ${o.payment === 'Paid' ? 'paid' : 'unpaid'}">${o.payment}</td>
            <td class="status ${o.status.toLowerCase()}">${o.status}</td>
            <td class="actions">
              <button class="btn btn-view" onclick="viewOrder('${o.id}')">View</button>
              <button class="btn btn-update" onclick="updateStatus('${o.id}')">Update</button>
              <button class="btn btn-delete" onclick="deleteOrder('${o.id}')">Delete</button>
            </td>
          </tr>`;
      });
    }

    function filterOrders() {
      const value = document.getElementById('search').value.toLowerCase();
      const filtered = orders.filter(o =>
        o.id.toLowerCase().includes(value) ||
        o.customer.toLowerCase().includes(value)
      );
      const tbody = document.getElementById('orderBody');
      tbody.innerHTML = '';
      filtered.forEach(o => {
        tbody.innerHTML += `
          <tr>
            <td>${o.id}</td>
            <td>${o.customer}</td>
            <td>${o.date}</td>
            <td>${o.total.toLocaleString()}</td>
            <td class="status ${o.payment === 'Paid' ? 'paid' : 'unpaid'}">${o.payment}</td>
            <td class="status ${o.status.toLowerCase()}">${o.status}</td>
            <td class="actions">
              <button class="btn btn-view" onclick="viewOrder('${o.id}')">View</button>
              <button class="btn btn-update" onclick="updateStatus('${o.id}')">Update</button>
              <button class="btn btn-delete" onclick="deleteOrder('${o.id}')">Delete</button>
            </td>
          </tr>`;
      });
    }

    function addNewOrder() {
      alert('Redirect to Add Order page (Laravel route later)');
    }

    function viewOrder(id) {
      const o = orders.find(x => x.id === id);
      alert(`Order Details:\n\nOrder ID: ${o.id}\nCustomer: ${o.customer}\nDate: ${o.date}\nTotal: ৳${o.total}\nPayment: ${o.payment}\nStatus: ${o.status}`);
    }

    function updateStatus(id) {
      const o = orders.find(x => x.id === id);
      const newStatus = prompt(`Enter new status for Order ${id} (Delivered / Pending / Canceled):`, o.status);
      if (newStatus && ['Delivered', 'Pending', 'Canceled'].includes(newStatus)) {
        o.status = newStatus;
        renderOrders();
        alert('Order status updated!');
      } else {
        alert('Invalid status input.');
      }
    }

    function deleteOrder(id) {
      if (confirm('Are you sure you want to delete this order?')) {
        const index = orders.findIndex(o => o.id === id);
        orders.splice(index, 1);
        renderOrders();
        alert('Order deleted successfully!');
      }
    }

    renderOrders();
  </script>
</body>

@endsection