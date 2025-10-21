@extends('seller.layouts.layout')
@section('seller_page_title')
     create product
@endsection
@section('seller_layout')

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }



  .form-container {
    background: #fff;
    width: 90%;
    max-width: 800px;
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
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
  }

  .form-row label {
    flex: 1;
    min-width: 180px;
    font-weight: 500;
    color: #444;
  }

  .form-row input[type="text"],
  .form-row input[type="number"],
  .form-row select,
  .form-row textarea,
  .form-row input[type="file"] {
    flex: 2;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
    outline: none;
    width: 100%;
    transition: all 0.3s;
    background-color: #fafafa;
  }

  /* 🔹 File input এর custom look */
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

  .form-row textarea {
    resize: none;
    height: 80px;
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
      align-items: flex-start;
    }

    .form-row label {
      min-width: 100%;
    }

    .form-row input,
    .form-row select,
    .form-row textarea {
      width: 100%;
    }
  }
</style>

</head>
<body>
  <div class="form-container">
    <h2>Add New Product</h2>
    <form action="#" method="POST" enctype="multipart/form-data">
      
      <div class="form-row">
        <label for="name">Product Name</label>
        <input type="text" id="name" name="product_name" placeholder="Enter product name" required />
      </div>

      <div class="form-row">
        <label for="category">Category</label>
        <select id="category" name="category" required>
          <option value="">-- Select Category --</option>
          <option value="electronics">Electronics</option>
          <option value="fashion">Fashion</option>
          <option value="home">Home & Living</option>
          <option value="beauty">Beauty</option>
          <option value="sports">Sports</option>
        </select>
      </div>

      <div class="form-row">
        <label for="price">Price (৳)</label>
        <input type="number" id="price" name="price" placeholder="Enter product price" required />
      </div>

      <div class="form-row">
        <label for="stock">Stock Quantity</label>
        <input type="number" id="stock" name="stock" placeholder="Enter stock quantity" required />
      </div>

      <div class="form-row">
        <label for="description">Product Description</label>
        <textarea id="description" name="description" placeholder="Write about your product..."></textarea>
      </div>

      <div class="form-row">
        <label for="image">Product Image</label>
        <input type="file" id="image" name="product_image" accept="image/*" required />
      </div>

      <button type="submit" class="btn-submit">Add Product</button>
    </form>
  </div>
</body>




@endsection