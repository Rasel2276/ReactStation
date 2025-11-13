@extends('admin.layouts.layout')
@section('admin_page_title')
Product - Admin Panel
@endsection
@section('admin_layout')

  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }
    body {
      background-color: #f4f6fb;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
    }
    .table-container {
      width: 100%;
      max-width: 1100px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
      padding: 25px;
    }
    h1 {
      text-align: center;
      color: #111827;
      margin-bottom: 20px;
      font-size: 26px;
    }
    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
    }
    .top-bar input {
      width: 250px;
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      outline: none;
      font-size: 15px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
    }
    th {
      background-color: #2563eb;
      color: #fff;
      font-weight: 600;
    }
    tr:hover {
      background-color: #f9fafb;
    }
    .actions {
      display: flex;
      gap: 10px;
    }
    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 6px;
      font-size: 14px;
      cursor: pointer;
      transition: 0.2s;
    }
    .btn-view {
      background-color: #22c55e;
      color: #fff;
    }
    .btn-approve {
      background-color: #2563eb;
      color: #fff;
    }
    .btn-delete {
      background-color: #ef4444;
      color: #fff;
    }
    .btn:hover {
      opacity: 0.9;
    }
    .rating {
      color: #facc15;
      font-size: 16px;
    }
    @media (max-width: 768px) {
      table {
        display: block;
        overflow-x: auto;
      }
    }
  </style>
</head>
<body>
  <div class="table-container">
    <h1>Manage Product Reviews</h1>
    <div class="top-bar">
      <input type="text" id="search" placeholder="Search by product or user..." onkeyup="filterReviews()">
      <button class="btn btn-approve" onclick="addNewReview()">+ Add Review</button>
    </div>
    <table id="reviewTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Product</th>
          <th>Reviewer</th>
          <th>Rating</th>
          <th>Comment</th>
          <th>Date</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="reviewBody"></tbody>
    </table>
  </div>

  <script>
    const reviews = [
      {id: 1, product: 'Samsung Galaxy S21', reviewer: 'John Doe', rating: 5, comment: 'Excellent phone!', date: '2025-10-10', status: 'Approved'},
      {id: 2, product: 'Rice Cooker', reviewer: 'Sarah Khan', rating: 4, comment: 'Good quality and fast heating.', date: '2025-10-12', status: 'Pending'},
      {id: 3, product: 'Men T-Shirt', reviewer: 'David Roy', rating: 3, comment: 'Size was a bit small.', date: '2025-10-14', status: 'Approved'},
    ];

    function renderReviews() {
      const tbody = document.getElementById('reviewBody');
      tbody.innerHTML = '';
      reviews.forEach(r => {
        const stars = '★'.repeat(r.rating) + '☆'.repeat(5 - r.rating);
        const row = `
          <tr>
            <td>${r.id}</td>
            <td>${r.product}</td>
            <td>${r.reviewer}</td>
            <td class="rating">${stars}</td>
            <td>${r.comment}</td>
            <td>${r.date}</td>
            <td style="color:${r.status === 'Approved' ? 'green' : 'orange'};">${r.status}</td>
            <td class="actions">
              <button class="btn btn-view" onclick="viewReview(${r.id})">View</button>
              <button class="btn btn-approve" onclick="approveReview(${r.id})">Approve</button>
              <button class="btn btn-delete" onclick="deleteReview(${r.id})">Delete</button>
            </td>
          </tr>`;
        tbody.innerHTML += row;
      });
    }

    function filterReviews() {
      const value = document.getElementById('search').value.toLowerCase();
      const filtered = reviews.filter(r =>
        r.product.toLowerCase().includes(value) || r.reviewer.toLowerCase().includes(value)
      );
      const tbody = document.getElementById('reviewBody');
      tbody.innerHTML = '';
      filtered.forEach(r => {
        const stars = '★'.repeat(r.rating) + '☆'.repeat(5 - r.rating);
        tbody.innerHTML += `
          <tr>
            <td>${r.id}</td>
            <td>${r.product}</td>
            <td>${r.reviewer}</td>
            <td class="rating">${stars}</td>
            <td>${r.comment}</td>
            <td>${r.date}</td>
            <td style="color:${r.status === 'Approved' ? 'green' : 'orange'};">${r.status}</td>
            <td class="actions">
              <button class="btn btn-view" onclick="viewReview(${r.id})">View</button>
              <button class="btn btn-approve" onclick="approveReview(${r.id})">Approve</button>
              <button class="btn btn-delete" onclick="deleteReview(${r.id})">Delete</button>
            </td>
          </tr>`;
      });
    }

    function addNewReview() {
      alert('Redirect to Add Review Page (Laravel route later)');
    }

    function viewReview(id) {
      const r = reviews.find(r => r.id === id);
      alert(`Review Details:\n\nProduct: ${r.product}\nReviewer: ${r.reviewer}\nRating: ${r.rating}/5\nComment: ${r.comment}\nDate: ${r.date}`);
    }

    function approveReview(id) {
      const review = reviews.find(r => r.id === id);
      if (review.status !== 'Approved') {
        review.status = 'Approved';
        renderReviews();
        alert('Review approved successfully!');
      } else {
        alert('This review is already approved.');
      }
    }

    function deleteReview(id) {
      if (confirm('Are you sure you want to delete this review?')) {
        const index = reviews.findIndex(r => r.id === id);
        reviews.splice(index, 1);
        renderReviews();
        alert('Review deleted successfully!');
      }
    }

    renderReviews();
  </script>
</body>


@endsection