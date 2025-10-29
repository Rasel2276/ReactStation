@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')

<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
body { background: #f4f6fb; color: #333; }
.form-container { width: 100%; max-width: 600px; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 30px; }
h1 { text-align: center; color: #111827; margin-bottom: 25px; font-size: 26px; }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; margin-bottom: 6px; font-weight: 500; }
.form-group select, .form-group input { width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 15px; }
button { width: 100%; padding: 12px; background-color: #2563eb; color: #fff; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; transition: 0.3s; }
button:hover { opacity: 0.9; }
.purchase-summary { margin-top: 20px; background: #f9fafb; padding: 15px; border-radius: 8px; display: none; }
.purchase-summary p { margin-bottom: 8px; font-size: 15px; }
</style>
</head>
<body>

<div class="form-container">
  <h1>Purchase Product from Admin</h1>

  <div class="form-group">
    <label for="productSelect">Select Product</label>
    <select id="productSelect" onchange="updatePrice()">
      <option value="">-- Select a Product --</option>
    </select>
  </div>

  <div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" id="quantity" min="1" value="1" onchange="updatePrice()">
  </div>

  <button onclick="submitPurchase()">Submit Purchase</button>

  <div class="purchase-summary" id="summary">
    <h3>Purchase Summary</h3>
    <p id="summaryProduct"></p>
    <p id="summaryQty"></p>
    <p id="summaryPrice"></p>
  </div>
</div>

<script>
const products = [
  {id: 1, name: 'Samsung Galaxy S21', price: 95000, stock: 20, admin: 'Admin A'},
  {id: 2, name: 'Men T-Shirt', price: 1200, stock: 50, admin: 'Admin B'},
  {id: 3, name: 'Rice Cooker', price: 4500, stock: 15, admin: 'Admin A'},
];

// Populate select options
const productSelect = document.getElementById('productSelect');
products.forEach(p => {
  const option = document.createElement('option');
  option.value = p.id;
  option.textContent = `${p.name} - ৳${p.price.toLocaleString()} (Stock: ${p.stock})`;
  productSelect.appendChild(option);
});

function updatePrice() {
  const selectedId = parseInt(productSelect.value);
  const qty = parseInt(document.getElementById('quantity').value);
  if(!selectedId || !qty) return;

  const product = products.find(p => p.id === selectedId);
  if(qty > product.stock){
    alert(`Only ${product.stock} items available in stock!`);
    document.getElementById('quantity').value = product.stock;
    return;
  }

  const total = product.price * qty;
  document.getElementById('summary').style.display = 'block';
  document.getElementById('summaryProduct').textContent = `Product: ${product.name} (Admin: ${product.admin})`;
  document.getElementById('summaryQty').textContent = `Quantity: ${qty}`;
  document.getElementById('summaryPrice').textContent = `Total Price: ৳${total.toLocaleString()}`;
}

function submitPurchase() {
  const selectedId = parseInt(productSelect.value);
  const qty = parseInt(document.getElementById('quantity').value);
  if(!selectedId) { alert("Please select a product."); return; }
  if(!qty || qty < 1) { alert("Quantity must be at least 1."); return; }

  const product = products.find(p => p.id === selectedId);
  if(qty > product.stock) { alert(`Only ${product.stock} items available.`); return; }

  // Simulate stock update
  product.stock -= qty;

  alert(`✅ Purchase request submitted!\n\nProduct: ${product.name}\nQuantity: ${qty}\nTotal Price: ৳${(product.price*qty).toLocaleString()}`);

  // Reset form
  productSelect.value = '';
  document.getElementById('quantity').value = 1;
  document.getElementById('summary').style.display = 'none';

  // Update select options to reflect new stock
  productSelect.innerHTML = '<option value="">-- Select a Product --</option>';
  products.forEach(p => {
    const option = document.createElement('option');
    option.value = p.id;
    option.textContent = `${p.name} - ৳${p.price.toLocaleString()} (Stock: ${p.stock})`;
    productSelect.appendChild(option);
  });
}
</script>
</body>


@endsection