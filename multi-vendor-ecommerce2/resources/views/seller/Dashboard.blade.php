@extends('seller.layouts.layout')
@section('seller_page_title')
    Dashboard
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

   

    .dashboard-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .dashboard-card {
      background-color: #fff;
      padding: 25px 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .card-title {
      font-size: 16px;
      font-weight: 500;
      color: #666;
      margin-bottom: 10px;
      text-align: center;
    }

    .card-value {
      font-size: 28px;
      font-weight: 700;
      color: #3c91e6;
    }

    .card-icon {
      font-size: 40px;
      color: #3c91e6;
      margin-bottom: 10px;
    }

    @media (max-width: 600px) {
      .dashboard-container {
        grid-template-columns: 1fr;
      }
    }
  </style>
  <!-- Optional: FontAwesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

  <div class="dashboard-container">
    <!-- Total Sales -->
    <div class="dashboard-card">
      <div class="card-icon"><i class="fas fa-shopping-cart"></i></div>
      <div class="card-title">Total Sales</div>
      <div class="card-value">150</div>
    </div>

    <!-- Total Orders -->
    <div class="dashboard-card">
      <div class="card-icon"><i class="fas fa-boxes"></i></div>
      <div class="card-title">Total Orders</div>
      <div class="card-value">320</div>
    </div>

    <!-- Pending Orders -->
    <div class="dashboard-card">
      <div class="card-icon"><i class="fas fa-hourglass-half"></i></div>
      <div class="card-title">Pending Orders</div>
      <div class="card-value">25</div>
    </div>

    <!-- Stock -->
    <div class="dashboard-card">
      <div class="card-icon"><i class="fas fa-warehouse"></i></div>
      <div class="card-title">Stock Quantity</div>
      <div class="card-value">1200</div>
    </div>

    <!-- Total Income -->
    <div class="dashboard-card">
      <div class="card-icon"><i class="fas fa-dollar-sign"></i></div>
      <div class="card-title">Total Income</div>
      <div class="card-value">৳ 1,25,000</div>
    </div>
  </div>

</body>


@endsection