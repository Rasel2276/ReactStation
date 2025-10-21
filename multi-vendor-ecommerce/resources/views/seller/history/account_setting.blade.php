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

    .settings-container {
      max-width: 700px;
      margin: 0 auto;
      background-color: #fff;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .form-row {
      display: flex;
      align-items: center;
      gap: 20px;
      flex-wrap: wrap;
    }

    .form-row label {
      flex: 1;
      min-width: 150px;
      font-weight: 500;
      color: #444;
    }

    .form-row input {
      flex: 2;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      outline: none;
      font-size: 15px;
      width: 100%;
      background-color: #fafafa;
      transition: all 0.3s;
    }

    .form-row input:focus {
      border-color: #3c91e6;
      box-shadow: 0 0 5px rgba(60,145,230,0.3);
      background-color: #fff;
    }

    .btn-submit {
      background-color: #3c91e6;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
      transition: background 0.3s ease;
      width: 150px;
      align-self: flex-end;
    }

    .btn-submit:hover {
      background-color: #2c76c3;
    }

    @media (max-width: 600px) {
      .form-row {
        flex-direction: column;
        align-items: flex-start;
      }

      .form-row label {
        min-width: 100%;
      }

      .btn-submit {
        width: 100%;
        align-self: center;
      }
    }
  </style>
</head>
<body>

  <div class="settings-container">
    <h2>Account Settings</h2>

    <form action="#" method="POST">
      <!-- Personal Info -->
      <div class="form-row">
        <label for="vendor_name">Full Name</label>
        <input type="text" id="vendor_name" name="vendor_name" placeholder="Enter your full name" required>
      </div>

      <div class="form-row">
        <label for="vendor_email">Email</label>
        <input type="email" id="vendor_email" name="vendor_email" placeholder="Enter your email" required>
      </div>

      <div class="form-row">
        <label for="vendor_phone">Phone</label>
        <input type="tel" id="vendor_phone" name="vendor_phone" placeholder="Enter your phone number" required>
      </div>

      <!-- Password Change -->
      <div class="form-row">
        <label for="current_password">Current Password</label>
        <input type="password" id="current_password" name="current_password" placeholder="Enter current password" required>
      </div>

      <div class="form-row">
        <label for="new_password">New Password</label>
        <input type="password" id="new_password" name="new_password" placeholder="Enter new password" required>
      </div>

      <div class="form-row">
        <label for="confirm_password">Confirm New Password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
      </div>

      <button type="submit" class="btn-submit">Update Account</button>
    </form>
  </div>

</body>



@endsection