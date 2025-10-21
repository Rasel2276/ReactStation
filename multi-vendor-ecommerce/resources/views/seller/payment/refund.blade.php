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

    .refund-container {
      width: 95%;
      max-width: 900px;
      margin: 5px auto;
      background-color: #fff;
      padding: 25px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table thead {
      background-color: #3c91e6;
      color: #fff;
    }

    table th, table td {
      padding: 12px 15px;
      border: 1px solid #ddd;
      text-align: center;
    }

    table tbody tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .status {
      padding: 5px 10px;
      border-radius: 5px;
      font-weight: 500;
      font-size: 14px;
      color: #fff;
    }

    .approved {
      background-color: #28a745;
    }

    .pending {
      background-color: #ffc107;
      color: #333;
    }

    .rejected {
      background-color: #dc3545;
    }

    @media (max-width: 768px) {
      table th, table td {
        padding: 8px 10px;
        font-size: 14px;
      }
    }

    @media (max-width: 480px) {
      table, tbody, thead, tr, th, td {
        display: block;
      }
      tr {
        margin-bottom: 15px;
      }
      th {
        text-align: left;
      }
      td {
        text-align: right;
        position: relative;
        padding-left: 50%;
      }
      td::before {
        content: attr(data-label);
        position: absolute;
        left: 10px;
        width: 45%;
        font-weight: 500;
        text-align: left;
      }
    }
  </style>
</head>
<body>

  <div class="refund-container">
    <h2>Refund Requests</h2>
    <table>
      <thead>
        <tr>
          <th>Request ID</th>
          <th>Order ID</th>
          <th>Customer Name</th>
          <th>Amount (৳)</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Request ID">#R1001</td>
          <td data-label="Order ID">#O2001</td>
          <td data-label="Customer Name">Karim Ahmed</td>
          <td data-label="Amount">৳ 1,500</td>
          <td data-label="Date">2025-10-20</td>
          <td data-label="Status"><span class="status approved">Approved</span></td>
        </tr>
        <tr>
          <td data-label="Request ID">#R1002</td>
          <td data-label="Order ID">#O2005</td>
          <td data-label="Customer Name">Jamal Hossain</td>
          <td data-label="Amount">৳ 2,000</td>
          <td data-label="Date">2025-10-18</td>
          <td data-label="Status"><span class="status pending">Pending</span></td>
        </tr>
        <tr>
          <td data-label="Request ID">#R1003</td>
          <td data-label="Order ID">#O2010</td>
          <td data-label="Customer Name">Sadia Islam</td>
          <td data-label="Amount">৳ 500</td>
          <td data-label="Date">2025-10-15</td>
          <td data-label="Status"><span class="status rejected">Rejected</span></td>
        </tr>
      </tbody>
    </table>
  </div>

</body>

@endsection