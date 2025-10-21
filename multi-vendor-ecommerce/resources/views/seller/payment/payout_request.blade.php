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

    .payout-container {
      background: #fff;
      width: 90%;
      max-width: 700px;
      margin: 5px auto;
      padding: 25px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
    }

    .balance-box {
      background-color: #3c91e6;
      color: #fff;
      padding: 15px 20px;
      border-radius: 8px;
      font-size: 18px;
      text-align: center;
      margin-bottom: 20px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .form-row {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .form-row label {
      width: 150px;
      font-weight: 500;
      color: #444;
    }

    .form-row input[type="text"],
    .form-row input[type="email"],
    .form-row input[type="number"],
    .form-row select {
      flex: 1;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      outline: none;
      font-size: 15px;
      background-color: #fafafa;
      transition: all 0.3s;
    }

    .form-row input:focus,
    .form-row select:focus {
      border-color: #3c91e6;
      box-shadow: 0 0 5px rgba(60,145,230,0.3);
      background-color: #fff;
    }

    .btn-submit {
      background-color: #28a745;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
      margin-top: 10px;
      transition: background 0.3s ease;
    }

    .btn-submit:hover {
      background-color: #218838;
    }

    @media (max-width: 600px) {
      .form-row {
        flex-direction: column;
        align-items: flex-start;
      }

      .form-row label {
        width: 100%;
        margin-bottom: 5px;
      }

      .form-row input,
      .form-row select {
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="payout-container">
    <h2>Payout Request</h2>
    
    <div class="balance-box">
      Available Balance: ৳ 12,500
    </div>

    <form action="#" method="POST">
      <!-- Vendor Info -->
      <div class="form-row">
        <label for="vendor_name">Vendor Name</label>
        <input type="text" id="vendor_name" name="vendor_name" placeholder="Enter your full name" required>
      </div>

      <div class="form-row">
        <label for="vendor_email">Vendor Email</label>
        <input type="email" id="vendor_email" name="vendor_email" placeholder="Enter your email" required>
      </div>

      <div class="form-row">
        <label for="vendor_phone">Vendor Phone</label>
        <input type="text" id="vendor_phone" name="vendor_phone" placeholder="Enter your phone number" required>
      </div>

      <!-- Payout Details -->
      <div class="form-row">
        <label for="payout_amount">Payout Amount (৳)</label>
        <input type="number" id="payout_amount" name="payout_amount" placeholder="Enter amount to request" required>
      </div>

      <div class="form-row">
        <label for="payment_method">Payment Method</label>
        <select id="payment_method" name="payment_method" required>
          <option value="">-- Select Payment Method --</option>
          <option value="bank">Bank Transfer</option>
          <option value="mobile">Mobile Banking</option>
          <option value="paypal">PayPal</option>
        </select>
      </div>

      <div class="form-row">
        <label for="account_details">Account Details</label>
        <input type="text" id="account_details" name="account_details" placeholder="Enter account number / mobile number / PayPal email" required>
      </div>

      <button type="submit" class="btn-submit">Request Payout</button>
    </form>
  </div>

</body>



@endsection