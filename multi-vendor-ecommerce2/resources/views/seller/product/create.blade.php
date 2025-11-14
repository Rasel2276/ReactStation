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
    max-width: 900px;
    padding: 25px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin: auto;
  }

  h2 {
    text-align: center;
    color: #333;
    margin-bottom: 25px;
  }

  form {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  /* Two-column layout */
  .form-group {
    flex: 1 1 calc(50% - 20px);
    display: flex;
    flex-direction: column;
  }

  .form-group label {
    font-weight: 600;
    margin-bottom: 6px;
    color: #444;
  }

  .form-group input,
  .form-group select,
  .form-group textarea {
    padding: 10px 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background: #fafafa;
    font-size: 15px;
    transition: 0.3s;
  }

  .form-group textarea {
    height: 90px;
    resize: none;
  }

  .form-group input:focus,
  .form-group textarea:focus,
  .form-group select:focus {
    border-color: #3c91e6;
    background: #fff;
    box-shadow: 0 0 5px rgba(60,145,230,0.3);
  }

  /* Full width for description and image */
  .full-row {
    flex: 1 1 100%;
  }

  .btn-submit {
    background: #3c91e6;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
    margin-top: 10px;
    transition: 0.3s;
  }

  .btn-submit:hover {
    background: #2c76c3;
  }

  @media(max-width: 600px) {
    .form-group {
      flex: 1 1 100%;
    }
  }
</style>

<div class="form-container">
  <h2>Add New Product</h2>

    {{-- Success message --}}
  @if(session('success'))
      <div style="background: #36d75c; color: #f9fff5; padding: 10px 15px; border-radius: 6px; margin-bottom: 15px;">
          {{ session('success') }}
      </div>
  @endif

  <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group full-row">
        <label>Select Product From Purchased Stock</label>
        <select name="vendor_stock_id" id="vendorStockSelect" required>
            <option value="">-- Select Product --</option>
            @foreach($stocks as $stock)
                <option value="{{ $stock->id }}" 
                        data-max="{{ $stock->quantity }}" 
                        data-purchase="{{ $stock->price }}">
                    {{ $stock->adminStock->product->product_name }} 
                    (Purchased Qty: {{ $stock->quantity }}, Purchase Price: ৳{{ number_format($stock->price, 2) }})
                </option>
            @endforeach
        </select>
      </div>

      <div class="form-group">
        <label>Sell Price (৳)</label>
        <input type="number" name="price" id="priceInput" required>
      </div>

      <div class="form-group">
        <label>Stock Quantity</label>
        <input type="number" name="quantity" id="quantityInput" min="1" required placeholder="Enter quantity">
      </div>

      <div class="form-group full-row">
        <label>Details</label>
        <textarea name="details" required></textarea>
      </div>

      <div class="form-group full-row">
        <label>Image</label>
        <input type="file" name="product_image" accept="image/*" required>
      </div>

      <button type="submit" class="btn-submit">Add Product</button>
  </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const stockSelect = document.getElementById('vendorStockSelect');
    const qtyInput = document.getElementById('quantityInput');
    const priceInput = document.getElementById('priceInput');

    stockSelect.addEventListener('change', function() {
        const selectedOption = stockSelect.options[stockSelect.selectedIndex];
        const maxQty = selectedOption.getAttribute('data-max');
        const purchasePrice = selectedOption.getAttribute('data-purchase');

        qtyInput.max = maxQty;
        qtyInput.placeholder = "Max: " + maxQty;

        // Optional: auto set sell price to purchase price
        priceInput.value = purchasePrice;
        if(qtyInput.value > maxQty){
            qtyInput.value = maxQty;
        }
    });
});
</script>

@endsection
