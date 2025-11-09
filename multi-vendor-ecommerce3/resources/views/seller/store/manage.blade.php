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

    .store-container {
      width: 95%;
      max-width: 1100px;
      background: #fff;
      padding: 25px;
      margin: 40px auto;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .store-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }

    .store-header h2 {
      font-size: 22px;
      color: #333;
    }

    .btn-add {
      background-color: #3c91e6;
      color: #fff;
      padding: 10px 18px;
      border-radius: 8px;
      border: none;
      text-decoration: none;
      font-size: 15px;
      transition: background 0.3s ease;
    }

    .btn-add:hover {
      background-color: #2c76c3;
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

    .store-logo {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
    }

    .action-btns {
      display: flex;
      gap: 8px;
    }

    .btn-edit,
    .btn-delete {
      padding: 6px 12px;
      font-size: 14px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .btn-edit {
      background-color: #28a745;
      color: white;
    }

    .btn-edit:hover {
      background-color: #218838;
    }

    .btn-delete {
      background-color: #dc3545;
      color: white;
    }

    .btn-delete:hover {
      background-color: #c82333;
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

  <div class="store-container">
    <div class="store-header">
      <h2>Manage Your Stores</h2>
      <a href="create-store.html" class="btn-add">+ Create New Store</a>
    </div>

    <table>
      <thead>
        <tr>
          <th>Logo</th>
          <th>Store Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td data-label="Logo"><img src="https://via.placeholder.com/60" class="store-logo" alt="Store Logo"></td>
          <td data-label="Store Name">Tech World</td>
          <td data-label="Email">techworld@example.com</td>
          <td data-label="Phone">01712345678</td>
          <td data-label="Status">Active</td>
          <td data-label="Actions">
            <div class="action-btns">
              <button class="btn-edit">Edit</button>
              <button class="btn-delete">Delete</button>
            </div>
          </td>
        </tr>

        <tr>
          <td data-label="Logo"><img src="https://via.placeholder.com/60" class="store-logo" alt="Store Logo"></td>
          <td data-label="Store Name">Fashion Hub</td>
          <td data-label="Email">fashionhub@example.com</td>
          <td data-label="Phone">01812345678</td>
          <td data-label="Status">Inactive</td>
          <td data-label="Actions">
            <div class="action-btns">
              <button class="btn-edit">Edit</button>
              <button class="btn-delete">Delete</button>
            </div>
          </td>
        </tr>

        <tr>
          <td data-label="Logo"><img src="https://via.placeholder.com/60" class="store-logo" alt="Store Logo"></td>
          <td data-label="Store Name">Sports Arena</td>
          <td data-label="Email">sportsarena@example.com</td>
          <td data-label="Phone">01912345678</td>
          <td data-label="Status">Active</td>
          <td data-label="Actions">
            <div class="action-btns">
              <button class="btn-edit">Edit</button>
              <button class="btn-delete">Delete</button>
            </div>
          </td>
        </tr>

      </tbody>
    </table>
  </div>

</body>


@endsection