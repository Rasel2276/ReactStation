@extends('customer.layouts.layout')
@section('admin_page_title')
payment page
@endsection
@section('customer_layout')

<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
  }
  body {
    background: #f4f6fb;
    color: #333;
  }
  .container {
    width: 100%;
    max-width: 700px;
    margin: 10px auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    padding: 25px;
  }
  h1 {
    text-align: center;
    font-size: 26px;
    color: #111827;
    margin-bottom: 25px;
  }
  label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
  }
  input, select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 15px;
    font-size: 15px;
  }
  .payment-methods {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 10px;
  }
  .method {
    flex: 1 1 45%;
    background: #f3f4f6;
    border-radius: 8px;
    text-align: center;
    padding: 12px;
    border: 2px solid transparent;
    cursor: pointer;
    transition: 0.3s;
  }
  .method:hover {
    background: #e0e7ff;
  }
  .method.active {
    border: 2px solid #2563eb;
    background: #eff6ff;
  }
  .btn {
    width: 100%;
    background-color: #2563eb;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
  }
  .btn:hover {
    opacity: 0.9;
  }
  .summary {
    background: #f9fafb;
    border-radius: 8px;
    padding: 15px;
    margin-top: 15px;
    font-size: 15px;
  }
  .summary strong {
    color: #111827;
  }
  .payment-info {
    background: #eef2ff;
    border-radius: 8px;
    padding: 15px;
    margin-top: 10px;
    display: none;
  }
</style>
</head>
<body>

<div class="container">
  <h1>Make a Payment</h1>
  
  <label for="orderId">Order ID</label>
  <input type="text" id="orderId" placeholder="Enter your Order ID">

  <label for="amount">Total Amount (৳)</label>
  <input type="number" id="amount" placeholder="Enter total amount">

  <label>Select Payment Method</label>
  <div class="payment-methods">
    <div class="method" onclick="selectMethod('Card')" id="card">💳 Card</div>
    <div class="method" onclick="selectMethod('bKash')" id="bkash">📱 bKash</div>
    <div class="method" onclick="selectMethod('Nagad')" id="nagad">💰 Nagad</div>
    <div class="method" onclick="selectMethod('COD')" id="cod">📦 Cash on Delivery</div>
  </div>

  <div class="payment-info" id="paymentInfo"></div>

  <div class="summary" id="summary">
    <p><strong>Selected Method:</strong> None</p>
    <p><strong>Payable Amount:</strong> ৳0</p>
  </div>

  <button class="btn" onclick="makePayment()">Confirm Payment</button>
</div>

<script>
let selectedMethod = '';

function selectMethod(method) {
  selectedMethod = method;
  document.querySelectorAll('.method').forEach(m => m.classList.remove('active'));
  document.getElementById(method.toLowerCase()).classList.add('active');
  updateSummary();
  showPaymentDetails(method);
}

function showPaymentDetails(method) {
  const info = document.getElementById('paymentInfo');
  info.style.display = 'block';

  if (method === 'bKash') {
    info.innerHTML = `
      <h4>📱 bKash Payment Details</h4>
      <p>Send your payment to <strong>017XXXXXXXX</strong></p>
      <label>Enter bKash Transaction ID</label>
      <input type="text" placeholder="e.g. TX1234ABC">
    `;
  } else if (method === 'Nagad') {
    info.innerHTML = `
      <h4>💰 Nagad Payment Details</h4>
      <p>Send your payment to <strong>018XXXXXXXX</strong></p>
      <label>Enter Nagad Transaction ID</label>
      <input type="text" placeholder="e.g. NG1234XYZ">
    `;
  } else if (method === 'Card') {
    info.innerHTML = `
      <h4>💳 Card Payment</h4>
      <label>Card Number</label>
      <input type="text" placeholder="xxxx-xxxx-xxxx-xxxx">
      <label>Expiry Date</label>
      <input type="text" placeholder="MM/YY">
      <label>CVV</label>
      <input type="text" placeholder="123">
    `;
  } else if (method === 'COD') {
    info.innerHTML = `
      <h4>📦 Cash on Delivery</h4>
      <p>You will pay the amount in cash when the product is delivered.</p>
    `;
  }
}

function updateSummary() {
  const amount = document.getElementById('amount').value || 0;
  const summary = document.getElementById('summary');
  summary.innerHTML = `
    <p><strong>Selected Method:</strong> ${selectedMethod || 'None'}</p>
    <p><strong>Payable Amount:</strong> ৳${parseFloat(amount).toLocaleString()}</p>
  `;
}

function makePayment() {
  const orderId = document.getElementById('orderId').value.trim();
  const amount = parseFloat(document.getElementById('amount').value);
  
  if (!orderId || !amount || !selectedMethod) {
    alert('⚠️ Please fill all fields and select a payment method.');
    return;
  }

  alert(`✅ Payment Successful!\n\nOrder ID: ${orderId}\nMethod: ${selectedMethod}\nAmount: ৳${amount.toLocaleString()}`);
}
</script>

</body>

@endsection