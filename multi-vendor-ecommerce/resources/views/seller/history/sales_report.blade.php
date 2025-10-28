@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      background-color: #f5f6fa;
    }

    .dashboard-container {
      max-width: 1000px;
      margin: 0 auto;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    .filter-box {
      margin-bottom: 20px;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      flex-wrap: wrap;
    }

    .filter-box input,
    .filter-box select {
      padding: 8px 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      outline: none;
      font-size: 15px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    thead {
      background-color: #3c91e6;
      color: #fff;
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
    }

    tbody tr {
      border-bottom: 1px solid #ddd;
      transition: background 0.3s;
    }

    tbody tr:hover {
      background-color: #f1f1f1;
    }

    .status-completed {
      color: #28a745;
      font-weight: 500;
    }

    .status-pending {
      color: #ffc107;
      font-weight: 500;
    }

    .status-cancelled {
      color: #dc3545;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .filter-box {
        justify-content: flex-start;
      }
      th, td {
        padding: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="dashboard-container">
    <h2>Sales Report</h2>

    <div class="filter-box">
      <input type="text" id="searchInput" placeholder="Search by Product Name..." onkeyup="searchSales()">
      <select id="statusFilter" onchange="searchSales()">
        <option value="">All Status</option>
        <option value="Completed">Completed</option>
        <option value="Pending">Pending</option>
        <option value="Cancelled">Cancelled</option>
      </select>
    </div>

    <table id="salesTable">
      <thead>
        <tr>
          <th>Id</th>
          <th>Product Name</th>
          <th>Date</th>
          <th>Quantity</th>
          <th>Amount (৳)</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Smartphone X</td>
          <td>2025-10-18</td>
          <td>3</td>
          <td>৳ 75,000</td>
          <td class="status-completed">Completed</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Wireless Headphones</td>
          <td>2025-10-19</td>
          <td>5</td>
          <td>৳ 25,000</td>
          <td class="status-pending">Pending</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Running Shoes</td>
          <td>2025-10-20</td>
          <td>2</td>
          <td>৳ 10,000</td>
          <td class="status-completed">Completed</td>
        </tr>
        <tr>
          <td>4</td>
          <td>Smartwatch Z</td>
          <td>2025-10-21</td>
          <td>1</td>
          <td>৳ 15,000</td>
          <td class="status-cancelled">Cancelled</td>
        </tr>
      </tbody>
    </table>
  </div>

  <script>
    function searchSales() {
      const input = document.getElementById("searchInput").value.toUpperCase();
      const statusFilter = document.getElementById("statusFilter").value;
      const table = document.getElementById("salesTable");
      const tr = table.getElementsByTagName("tr");

      for (let i = 1; i < tr.length; i++) {
        const tdName = tr[i].getElementsByTagName("td")[1];
        const tdStatus = tr[i].getElementsByTagName("td")[5];
        let show = true;

        if (tdName && tdName.textContent.toUpperCase().indexOf(input) === -1) {
          show = false;
        }

        if (statusFilter !== "" && tdStatus && tdStatus.textContent !== statusFilter) {
          show = false;
        }

        tr[i].style.display = show ? "" : "none";
      }
    }
  </script>

</body>


@endsection