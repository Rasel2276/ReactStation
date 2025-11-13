@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')

<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
body { background: #f4f6fb; color: #333;}
.container { width: 100%; max-width: 500px; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 25px; }
h1 { text-align: center; margin-bottom: 25px; color: #111827; font-size: 26px; }
label { display: block; margin: 15px 0 5px; font-weight: 500; }
input, select { width: 100%; padding: 8px 10px; border-radius: 6px; border: 1px solid #ccc; font-size: 15px; }
button { margin-top: 20px; width: 100%; padding: 10px; background: #22c55e; color: #fff; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; }
button:hover { opacity: 0.9; }
.result { margin-top: 20px; padding: 12px; background: #f3f4f6; border-radius: 6px; font-size: 16px; }
</style>
</head>
<body>

<div class="container">
  <h1>Apply Discount to Product</h1>

  <label for="productSelect">Select Product</label>
  <select id="productSelect" onchange="updatePrice()">
    <!-- JS will populate options -->
  </select>

  <label for="discountInput">Discount (%)</label>
  <input type="number" id="discountInput" min="0" max="100" value="0" oninput="updatePrice()">

  <button onclick="applyDiscount()">Apply Discount</button>

  <div class="result" id="result">
    Discounted Price will appear here.
  </div>
</div>

<script>
const products = [
  {id: 1, name: 'Samsung Galaxy S21', price: 95000},
  {id: 2, name: 'Men T-Shirt', price: 1200},
  {id: 3, name: 'Rice Cooker', price: 4500},
];

// Populate product dropdown
const productSelect = document.getElementById('productSelect');
products.forEach(p => {
  const option = document.createElement('option');
  option.value = p.id;
  option.textContent = `${p.name} - ৳${p.price.toLocaleString()}`;
  productSelect.appendChild(option);
});

function updatePrice() {
  const selectedId = parseInt(productSelect.value);
  const discount = parseFloat(document.getElementById('discountInput').value) || 0;
  const product = products.find(p => p.id === selectedId);
  const discountedPrice = Math.round(product.price * (1 - discount/100));
  document.getElementById('result').textContent = `Original Price: ৳${product.price.toLocaleString()} | Discounted Price: ৳${discountedPrice.toLocaleString()}`;
}

function applyDiscount() {
  const selectedId = parseInt(productSelect.value);
  const discount = parseFloat(document.getElementById('discountInput').value) || 0;
  const product = products.find(p => p.id === selectedId);
  const discountedPrice = Math.round(product.price * (1 - discount/100));
  alert(`✅ Discount of ${discount}% applied on "${product.name}".\nDiscounted Price: ৳${discountedPrice.toLocaleString()}`);
  // Later: Laravel integration to save discount in database
}

updatePrice();
</script>

</body>




@endsection