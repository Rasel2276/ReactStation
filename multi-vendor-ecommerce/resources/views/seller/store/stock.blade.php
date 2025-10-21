@extends('seller.layouts.layout')
@section('seller_page_title')
     Manage store
@endsection
@section('seller_layout')

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #f5f6fa;
      margin: 0;
      padding: 0;
    }

    .stock-container {
      width: 95%;
      max-width: 1200px;
      background: #fff;
      padding: 25px;
      margin: 40px auto;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .stock-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .stock-header h2 {
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
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
    }

    .stock-input {
      width: 80px;
      padding: 6px 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
      outline: none;
    }

    .btn-update {
      background-color: #28a745;
      color: white;
      padding: 6px 12px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .btn-update:hover {
      background-color: #218838;
    }

    .low-stock {
      color: #dc3545;
      font-weight: 600;
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
    }
  </style>
</head>
<body>

  <div class="stock-container">
    <div class="stock-header">
      <h2>Stock Management</h2>
    </div>

    <table>
      <thead>
        <tr>
          <th>Image</th>
          <th>Product Name</th>
          <th>Category</th>
          <th>Current Stock</th>
          <th>Update Stock</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Image"><img src="https://via.placeholder.com/60" class="product-img" alt="Product"></td>
          <td data-label="Product Name">Smart Watch</td>
          <td data-label="Category">Electronics</td>
          <td data-label="Current Stock" class="low-stock">5</td>
          <td data-label="Update Stock">
            <input type="number" class="stock-input" value="5">
            <button class="btn-update">Update</button>
          </td>
        </tr>

        <tr>
          <td data-label="Image"><img src="https://via.placeholder.com/60" class="product-img" alt="Product"></td>
          <td data-label="Product Name">Ladies Bag</td>
          <td data-label="Category">Fashion</td>
          <td data-label="Current Stock">25</td>
          <td data-label="Update Stock">
            <input type="number" class="stock-input" value="25">
            <button class="btn-update">Update</button>
          </td>
        </tr>

        <tr>
          <td data-label="Image"><img src="https://via.placeholder.com/60" class="product-img" alt="Product"></td>
          <td data-label="Product Name">Running Shoes</td>
          <td data-label="Category">Sports</td>
          <td data-label="Current Stock">12</td>
          <td data-label="Update Stock">
            <input type="number" class="stock-input" value="12">
            <button class="btn-update">Update</button>
          </td>
        </tr>

      </tbody>
    </table>
  </div>

</body>


@endsection