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

    .search-box {
      margin-bottom: 20px;
      text-align: right;
    }

    .search-box input {
      padding: 8px 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      outline: none;
      width: 250px;
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
      cursor: pointer;
    }

    tbody tr:hover {
      background-color: #f1f1f1;
    }

    .status-paid {
      color: #28a745;
      font-weight: 500;
    }

    .status-pending {
      color: #ffc107;
      font-weight: 500;
    }

    .status-refunded {
      color: #dc3545;
      font-weight: 500;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
      background-color: #fff;
      margin: 10% auto;
      padding: 20px;
      border-radius: 12px;
      width: 80%;
      max-width: 500px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      position: relative;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 22px;
      font-weight: bold;
      cursor: pointer;
      color: #333;
    }

    @media (max-width: 768px) {
      .search-box input {
        width: 100%;
        margin-bottom: 10px;
      }
    }

  </style>
</head>
<body>

  <div class="dashboard-container">
    <h2>Transaction History</h2>

    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Search by Transaction ID..." onkeyup="searchTransaction()">
    </div>

    <table id="transactionTable">
      <thead>
        <tr>
          <th>Id</th>
          <th>Transaction ID</th>
          <th>Date</th>
          <th>Amount (৳)</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr onclick="viewTransaction(this)">
          <td>1</td>
          <td>TXN123456</td>
          <td>2025-10-18</td>
          <td>৳ 25,000</td>
          <td class="status-paid">Paid</td>
        </tr>
        <tr onclick="viewTransaction(this)">
          <td>2</td>
          <td>TXN123457</td>
          <td>2025-10-19</td>
          <td>৳ 15,000</td>
          <td class="status-pending">Pending</td>
        </tr>
        <tr onclick="viewTransaction(this)">
          <td>3</td>
          <td>TXN123458</td>
          <td>2025-10-20</td>
          <td>৳ 10,000</td>
          <td class="status-paid">Paid</td>
        </tr>
        <tr onclick="viewTransaction(this)">
          <td>4</td>
          <td>TXN123459</td>
          <td>2025-10-21</td>
          <td>৳ 5,000</td>
          <td class="status-refunded">Refunded</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Modal for transaction view -->
  <div id="transactionModal" class="modal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeModal()">&times;</span>
      <h3>Transaction Details</h3>
      <p id="modalContent"></p>
    </div>
  </div>

  <script>
    function searchTransaction() {
      const input = document.getElementById("searchInput").value.toUpperCase();
      const table = document.getElementById("transactionTable");
      const tr = table.getElementsByTagName("tr");

      for (let i = 1; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          const txtValue = td.textContent || td.innerText;
          tr[i].style.display = txtValue.toUpperCase().indexOf(input) > -1 ? "" : "none";
        }
      }
    }

    function viewTransaction(row) {
      const cells = row.getElementsByTagName("td");
      const details = `
        Transaction ID: ${cells[1].innerText} <br>
        Date: ${cells[2].innerText} <br>
        Amount: ${cells[3].innerText} <br>
        Status: ${cells[4].innerText}
      `;
      document.getElementById("modalContent").innerHTML = details;
      document.getElementById("transactionModal").style.display = "block";
    }

    function closeModal() {
      document.getElementById("transactionModal").style.display = "none";
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById("transactionModal");
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>




@endsection