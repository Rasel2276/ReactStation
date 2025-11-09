@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')
    <!DOCTYPE html>

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

    .form-container {
      background: #fff;
      width: 90%;
      max-width: 800px;
      margin: 40px auto;
      padding: 25px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 25px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .form-row {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .form-row label {
      font-weight: 500;
      color: #444;
    }

    .form-row input[type="text"],
    .form-row input[type="email"],
    .form-row input[type="file"],
    .form-row textarea {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      outline: none;
      width: 100%;
      transition: all 0.3s;
      background-color: #fafafa;
    }

    .form-row input[type="file"] {
      cursor: pointer;
    }

    .form-row input:focus,
    .form-row textarea:focus,
    .form-row select:focus,
    .form-row input[type="file"]:focus {
      border-color: #3c91e6;
      box-shadow: 0 0 5px rgba(60,145,230,0.3);
      background-color: #fff;
    }

    textarea {
      resize: none;
      height: 100px;
    }

    .btn-submit {
      background-color: #3c91e6;
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
      background-color: #2c76c3;
    }

    @media (max-width: 600px) {
      .form-row {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2>Create Your Store</h2>
    <form action="#" method="POST" enctype="multipart/form-data">

      <div class="form-row">
        <label for="store_name">Store Name</label>
        <input type="text" id="store_name" name="store_name" placeholder="Enter your store name" required>
      </div>

      <div class="form-row">
        <label for="store_email">Store Email</label>
        <input type="email" id="store_email" name="store_email" placeholder="Enter your store email" required>
      </div>

      <div class="form-row">
        <label for="store_phone">Store Phone</label>
        <input type="text" id="store_phone" name="store_phone" placeholder="Enter your store phone" required>
      </div>

      <div class="form-row">
        <label for="store_logo">Store Logo</label>
        <input type="file" id="store_logo" name="store_logo" accept="image/*" required>
      </div>

      <div class="form-row">
        <label for="store_banner">Store Banner</label>
        <input type="file" id="store_banner" name="store_banner" accept="image/*">
      </div>

      <div class="form-row">
        <label for="store_description">Store Description</label>
        <textarea id="store_description" name="store_description" placeholder="Write about your store..."></textarea>
      </div>

      <div class="form-row">
        <label for="store_address">Store Address</label>
        <textarea id="store_address" name="store_address" placeholder="Enter store address..."></textarea>
      </div>

      <button type="submit" class="btn-submit">Create Store</button>
    </form>
  </div>

</body>


@endsection