@extends('admin.layouts.layout')
@section('admin_page_title')
Payment - Admin Panel
@endsection
@section('admin_layout')

<style>
  * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
  body { background: #f4f6fb; }
  .container { width: 100%; max-width: 1100px; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 30px; }
  h1 { text-align: center; margin-bottom: 20px; color: #111827; }
  table { width: 100%; border-collapse: collapse; margin-top: 10px; }
  th, td { border: 1px solid #e5e7eb; text-align: center; padding: 12px; font-size: 15px; }
  th { background: #f9fafb; color: #374151; }
  tr:nth-child(even) { background: #f3f4f6; }
  .status-select { padding: 5px 10px; border-radius: 6px; border: 1px solid #ccc; font-size: 14px; }
  .actions { display: flex; gap: 8px; justify-content: center; }
  .actions a { text-decoration: none; padding: 6px 12px; border-radius: 6px; font-size: 13px; color: #fff; transition: 0.3s; }
  .edit-btn { background: #4b6cb7; }
  .delete-btn { background: #b71c1c; }
  .actions a:hover { opacity: 0.8; }
  img.vendor-image { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
  @media (max-width: 768px) {
      th, td { font-size: 12px; padding: 8px; }
  }
</style>
</head>
<body>

<div class="container">
  <h1>Vendor Payout Requests</h1>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Vendor</th>
        <th>Amount (৳)</th>
        <th>Method</th>
        <th>Account</th>
        <th>Status</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="requestTable">
      <tr>
        <td>1</td>
        <td><img src="https://via.placeholder.com/40" alt="TechZone" class="vendor-image"> TechZone</td>
        <td>2500</td>
        <td>bKash</td>
        <td>01712345678</td>
        <td>
          <select class="status-select">
            <option value="Pending" selected>Pending</option>
            <option value="Approved">Approved</option>
            <option value="Rejected">Rejected</option>
            <option value="Paid">Paid</option>
          </select>
        </td>
        <td>2025-10-20</td>
        <td class="actions">
          <a href="#" class="edit-btn">Edit</a>
          <a href="#" class="delete-btn">Delete</a>
        </td>
      </tr>

      <tr>
        <td>2</td>
        <td><img src="https://via.placeholder.com/40" alt="Fashion Hub" class="vendor-image"> Fashion Hub</td>
        <td>1800</td>
        <td>Bank</td>
        <td>DBBL - 4587963</td>
        <td>
          <select class="status-select">
            <option value="Pending">Pending</option>
            <option value="Approved" selected>Approved</option>
            <option value="Rejected">Rejected</option>
            <option value="Paid">Paid</option>
          </select>
        </td>
        <td>2025-10-19</td>
        <td class="actions">
          <a href="#" class="edit-btn">Edit</a>
          <a href="#" class="delete-btn">Delete</a>
        </td>
      </tr>

      <tr>
        <td>3</td>
        <td><img src="https://via.placeholder.com/40" alt="KitchenMart" class="vendor-image"> KitchenMart</td>
        <td>3100</td>
        <td>Nagad</td>
        <td>01887654321</td>
        <td>
          <select class="status-select">
            <option value="Pending">Pending</option>
            <option value="Approved">Approved</option>
            <option value="Rejected" selected>Rejected</option>
            <option value="Paid">Paid</option>
          </select>
        </td>
        <td>2025-10-18</td>
        <td class="actions">
          <a href="#" class="edit-btn">Edit</a>
          <a href="#" class="delete-btn">Delete</a>
        </td>
      </tr>
    </tbody>
  </table>
</div>

</body>



@endsection