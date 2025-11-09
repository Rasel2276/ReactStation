@extends('seller.layouts.layout')
@section('seller_page_title')
    Order History
@endsection
@section('seller_layout')
 
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #f5f6fa;
      margin: 0;
      padding: 0;
    }

    .order-container {
      width: 95%;
      max-width: 1200px;
      background: #fff;
      padding: 25px;
      margin: 10px auto;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .order-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .order-header h2 {
      font-size: 22px;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    thead {
      background-color: #3c91e6;
      color: #fff;
    }

    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #ddd;
    }

    tbody tr:hover {
      background-color: #f1f7ff;
    }

    .product-img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 8px;
    }

    .status-pending {
      background-color: #f1c40f;
      color: white;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
    }

    .status-processing {
      background-color: #3498db;
      color: white;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
    }

    .status-shipped {
      background-color: #9b59b6;
      color: white;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
    }

    .status-delivered {
      background-color: #28a745;
      color: white;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
    }

    .status-cancelled {
      background-color: #dc3545;
      color: white;
      padding: 4px 8px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 500;
    }

    .action-btns select {
      padding: 6px 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      cursor: pointer;
      font-size: 14px;
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

  <div class="order-container">
    <div class="order-header">
      <h2>Order Management</h2>
    </div>

    <table>
      <thead>
        <tr>
          <th>Order ID</th>
          <th>Product</th>
          <th>Customer</th>
          <th>Quantity</th>
          <th>Total Price (৳)</th>
          <th>Status</th>
          <th>Update Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Order ID">#1001</td>
          <td data-label="Product">
            <img src="https://via.placeholder.com/50" class="product-img" alt="Product">
            Smart Watch
          </td>
          <td data-label="Customer">Rahim H.</td>
          <td data-label="Quantity">2</td>
          <td data-label="Total Price">5000</td>
          <td data-label="Status"><span class="status-pending">Pending</span></td>
          <td data-label="Update Status">
            <div class="action-btns">
              <select>
                <option value="">Select</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </div>
          </td>
        </tr>

        <tr>
          <td data-label="Order ID">#1002</td>
          <td data-label="Product">
            <img src="https://via.placeholder.com/50" class="product-img" alt="Product">
            Ladies Bag
          </td>
          <td data-label="Customer">Sumi R.</td>
          <td data-label="Quantity">1</td>
          <td data-label="Total Price">1200</td>
          <td data-label="Status"><span class="status-processing">Processing</span></td>
          <td data-label="Update Status">
            <div class="action-btns">
              <select>
                <option value="">Select</option>
                <option value="pending">Pending</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </div>
          </td>
        </tr>

        <tr>
          <td data-label="Order ID">#1003</td>
          <td data-label="Product">
            <img src="https://via.placeholder.com/50" class="product-img" alt="Product">
            Running Shoes
          </td>
          <td data-label="Customer">Karim M.</td>
          <td data-label="Quantity">3</td>
          <td data-label="Total Price">5400</td>
          <td data-label="Status"><span class="status-shipped">Shipped</span></td>
          <td data-label="Update Status">
            <div class="action-btns">
              <select>
                <option value="">Select</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

</body>


@endsection