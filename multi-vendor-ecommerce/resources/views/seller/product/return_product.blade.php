@extends('seller.layouts.layout')
@section('seller_page_title')
     Manage product
@endsection
@section('seller_layout')

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #f5f6fa;
      margin: 0;
      padding: 0;
    }

    .return-container {
      width: 95%;
      max-width: 1100px;
      background: #fff;
      padding: 25px;
      margin: 40px auto;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .return-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .return-header h2 {
      font-size: 22px;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    thead {
      background-color: #f39c12;
      color: #fff;
    }

    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #ddd;
    }

    tbody tr:hover {
      background-color: #fdf5e6;
    }

    .product-img {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
    }

    .action-btns {
      display: flex;
      gap: 8px;
    }

    .btn-approve,
    .btn-reject {
      padding: 6px 12px;
      font-size: 14px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .btn-approve {
      background-color: #28a745;
      color: white;
    }

    .btn-approve:hover {
      background-color: #218838;
    }

    .btn-reject {
      background-color: #dc3545;
      color: white;
    }

    .btn-reject:hover {
      background-color: #c82333;
    }

    .status-pending {
      background-color: #f1c40f;
      color: white;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
    }

    .status-approved {
      background-color: #28a745;
      color: white;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
    }

    .status-rejected {
      background-color: #dc3545;
      color: white;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead {
        display: none;
      }

      tr {
        background: #fff;
        margin-bottom: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        padding: 10px;
      }

      td {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        border: none;
      }

      td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #333;
      }

      .action-btns {
        justify-content: flex-end;
      }
    }
  </style>
</head>
<body>

  <div class="return-container">
    <div class="return-header">
      <h2>Product Return Requests</h2>
    </div>

    <table>
      <thead>
        <tr>
          <th>Image</th>
          <th>Product Name</th>
          <th>Order ID</th>
          <th>Customer</th>
          <th>Reason</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Image"><img src="https://via.placeholder.com/60" class="product-img" alt="Product"></td>
          <td data-label="Product Name">Smart Watch</td>
          <td data-label="Order ID">#1023</td>
          <td data-label="Customer">Rahim H.</td>
          <td data-label="Reason">Wrong Size</td>
          <td data-label="Status"><span class="status-pending">Pending</span></td>
          <td data-label="Actions">
            <div class="action-btns">
              <button class="btn-approve">Approve</button>
              <button class="btn-reject">Reject</button>
            </div>
          </td>
        </tr>

        <tr>
          <td data-label="Image"><img src="https://via.placeholder.com/60" class="product-img" alt="Product"></td>
          <td data-label="Product Name">Ladies Bag</td>
          <td data-label="Order ID">#1025</td>
          <td data-label="Customer">Sumi R.</td>
          <td data-label="Reason">Damaged</td>
          <td data-label="Status"><span class="status-pending">Pending</span></td>
          <td data-label="Actions">
            <div class="action-btns">
              <button class="btn-approve">Approve</button>
              <button class="btn-reject">Reject</button>
            </div>
          </td>
        </tr>

      </tbody>
    </table>
  </div>

</body>


@endsection