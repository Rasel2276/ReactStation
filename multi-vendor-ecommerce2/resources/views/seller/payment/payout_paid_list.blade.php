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

    .payout-list-container {
      width: 95%;
      max-width: 900px;
      margin: 40px auto;
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
      color: #fff;
      font-weight: 500;
      font-size: 14px;
    }

    .paid {
      background-color: #28a745;
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

  <div class="payout-list-container">
    <h2>Paid Payout List</h2>
    <table>
      <thead>
        <tr>
          <th>Request ID</th>
          <th>Vendor Name</th>
          <th>Amount (৳)</th>
          <th>Payment Method</th>
          <th>Account</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Only Paid Requests -->
        <tr>
          <td data-label="Request ID">#1001</td>
          <td data-label="Vendor Name">Rahim Hossain</td>
          <td data-label="Amount">৳ 5,000</td>
          <td data-label="Payment Method">Bank Transfer</td>
          <td data-label="Account">1234567890</td>
          <td data-label="Date">2025-10-20</td>
          <td data-label="Status"><span class="status paid">Paid</span></td>
        </tr>
        <tr>
          <td data-label="Request ID">#1004</td>
          <td data-label="Vendor Name">Rahim Hossain</td>
          <td data-label="Amount">৳ 2,500</td>
          <td data-label="Payment Method">PayPal</td>
          <td data-label="Account">rahim@paypal.com</td>
          <td data-label="Date">2025-10-10</td>
          <td data-label="Status"><span class="status paid">Paid</span></td>
        </tr>
        <tr>
          <td data-label="Request ID">#1005</td>
          <td data-label="Vendor Name">Rahim Hossain</td>
          <td data-label="Amount">৳ 1,500</td>
          <td data-label="Payment Method">Mobile Banking</td>
          <td data-label="Account">01712345678</td>
          <td data-label="Date">2025-10-05</td>
          <td data-label="Status"><span class="status paid">Paid</span></td>
        </tr>
      </tbody>
    </table>
  </div>

</body>

@endsection