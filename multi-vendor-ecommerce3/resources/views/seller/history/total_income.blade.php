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

    .dashboard-container {
      max-width: 900px;
      margin: 0 auto;
    }

    .income-card {
      background-color: #3c91e6;
      color: #fff;
      padding: 30px 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .income-card:hover {
      transform: translateY(-5px);
    }

    .income-card h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .income-amount {
      font-size: 40px;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .income-subtitle {
      font-size: 16px;
      opacity: 0.9;
    }

    /* Additional cards example */
    .cards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .secondary-card {
      background-color: #28a745;
      color: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.3s ease;
    }

    .secondary-card:hover {
      transform: translateY(-5px);
    }

    .secondary-card h3 {
      font-size: 20px;
      margin-bottom: 8px;
    }

    .secondary-card p {
      font-size: 24px;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .income-card h2 {
        font-size: 20px;
      }
      .income-amount {
        font-size: 32px;
      }
      .secondary-card h3 {
        font-size: 18px;
      }
      .secondary-card p {
        font-size: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="dashboard-container">
    <!-- Main Income Card -->
    <div class="income-card">
      <h2>Total Income</h2>
      <div class="income-amount">৳ 125,000</div>
      <div class="income-subtitle">As of 21 October 2025</div>
    </div>

    <!-- Optional Additional Cards -->
    <div class="cards-grid">
      <div class="secondary-card">
        <h3>Pending Payouts</h3>
        <p>৳ 15,000</p>
      </div>
      <div class="secondary-card">
        <h3>Completed Payouts</h3>
        <p>৳ 110,000</p>
      </div>
      <div class="secondary-card">
        <h3>Refunds</h3>
        <p>৳ 5,000</p>
      </div>
    </div>
  </div>

</body>


@endsection