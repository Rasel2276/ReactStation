@extends('admin.layouts.layout')

@section('admin_page_title')
Manage Product Discounts - Admin Panel
@endsection

@section('admin_layout')


  <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

      body {
          font-family: 'Poppins', sans-serif;
          background-color: #f0f2f5;
          margin: 0;
      }

      .container {
          background: #fff;
          width: 95%;
          max-width: 1200px;
          margin: 0 auto;
          border-radius: 16px;
          box-shadow: 0 8px 25px rgba(0,0,0,0.1);
          padding: 30px 40px;
          animation: fadeIn 0.6s ease;
      }

      @keyframes fadeIn {
          from {opacity: 0; transform: translateY(-20px);}
          to {opacity: 1; transform: translateY(0);}
      }

      h2 {
          text-align: center;
          color: #182848;
          font-weight: 600;
          margin-bottom: 25px;
      }

      table {
          width: 100%;
          border-collapse: collapse;
          border-radius: 12px;
          overflow: hidden;
      }

      thead {
          background: linear-gradient(90deg, #4b6cb7, #182848);
          color: #fff;
      }

      th, td {
          padding: 12px 16px;
          border-bottom: 1px solid #ddd;
          text-align: left;
          font-size: 14px;
      }

      tbody tr:hover {
          background-color: #f9f9ff;
      }

      .product-image {
          width: 60px;
          height: 60px;
          object-fit: cover;
          border-radius: 8px;
      }

      .status-select {
          padding: 5px 8px;
          border-radius: 6px;
          border: 1px solid #ccc;
          font-size: 14px;
          cursor: pointer;
      }

      .actions {
          display: flex;
          gap: 10px;
      }

      .actions a {
          text-decoration: none;
          padding: 6px 12px;
          border-radius: 6px;
          color: #fff;
          font-size: 13px;
          transition: 0.3s;
      }

      .edit-btn {
          background: #4b6cb7;
      }

      .delete-btn {
          background: #b71c1c;
      }

      .actions a:hover {
          opacity: 0.8;
      }

      @media (max-width: 768px) {
          th, td {
              font-size: 12px;
              padding: 8px;
          }
          .product-image {
              width: 40px;
              height: 40px;
          }
      }
  </style>
</head>
<body>

<div class="container">
    <h2>Product Discount List</h2>
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Discount For</th>
                <th>Discount Type</th>
                <th>Discount Value</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($discounts as $discount)
            <tr>
                <td>{{ $discount->id }}</td>
                <td>{{ $discount->product->product_name }}</td>
                <td>{{ $discount->discount_for }}</td>
                <td>{{ $discount->discount_type }}</td>
                <td>{{ $discount->discount_value }} {{ $discount->discount_type == 'Percentage' ? '%' : '৳' }}</td>
                <td>{{ $discount->start_date }}</td>
                <td>{{ $discount->end_date }}</td>
                <td>
                    <select class="status-select">
                        <option value="Active" {{ $discount->status=='Active'?'selected':'' }}>Active</option>
                        <option value="Inactive" {{ $discount->status=='Inactive'?'selected':'' }}>Inactive</option>
                    </select>
                </td>
                <td class="actions">
                    <a href="{{ route('discount.edit_discount',$discount->id) }}" class="edit-btn">Edit</a>
                    <a href="{{ route('discount.delete_discount',$discount->id) }}" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>

@endsection
