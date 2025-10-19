@extends('admin.layouts.layout')

@section('admin_page_title')
Dashboard - Admin Panel
@endsection

@section('admin_layout')
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #fce4ec);
      margin: 0;
    }

    .dashboard {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 15px;
    }

    .card {
      border-radius: 12px;
      padding: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
      text-align: center;
      backdrop-filter: blur(6px);
      transition: transform 0.2s ease;
      color: white;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .icon {
      font-size: 24px;
      margin-bottom: 8px;
    }

    .title {
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .value {
      font-size: 20px;
      font-weight: bold;
    }

    /* Colorful backgrounds */
    .sale    { background-color: rgba(103, 58, 183, 0.8); }   /* Deep Purple */
    .order   { background-color: rgba(244, 67, 54, 0.8); }    /* Red */
    .pending { background-color: rgba(255, 152, 0, 0.8); }    /* Orange */
    .vendor  { background-color: rgba(76, 175, 80, 0.8); }    /* Green */
    .customer{ background-color: rgba(33, 150, 243, 0.8); }   /* Blue */
    .income  { background-color: rgba(156, 39, 176, 0.8); }   /* Purple */
  </style>
</head>
<body>
  <div class="dashboard">
    <div class="card sale">
      <div class="icon">🛒</div>
      <div class="title">Total Sale</div>
      <div class="value">$12,450</div>
    </div>
    <div class="card order">
      <div class="icon">📦</div>
      <div class="title">Total Orders</div>
      <div class="value">1,245</div>
    </div>
    <div class="card pending">
      <div class="icon">⏳</div>
      <div class="title">Pending Orders</div>
      <div class="value">87</div>
    </div>
    <div class="card vendor">
      <div class="icon">🏪</div>
      <div class="title">Vendors</div>
      <div class="value">32</div>
    </div>
    <div class="card customer">
      <div class="icon">👥</div>
      <div class="title">Customers</div>
      <div class="value">2,345</div>
    </div>
    <div class="card income">
      <div class="icon">💰</div>
      <div class="title">Net Income</div>
      <div class="value">$5,045</div>
    </div>
  </div>
</body>

@endsection
