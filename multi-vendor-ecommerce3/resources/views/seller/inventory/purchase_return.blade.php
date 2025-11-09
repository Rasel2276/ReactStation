@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')

<style>
* { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
body { background: #f4f6fb; color: #333;}
.container { width: 100%; max-width: 800px; background: #fff; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.1); padding: 25px; }
h1 { text-align: center; margin-bottom: 25px; color: #111827; font-size: 26px; }
.form-group { margin-bottom: 15px; }
label { display: block; margin-bottom: 6px; font-weight: 500; }
select, input, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 15px; }
button { padding: 12px; width: 100%; border: none; border-radius: 6px; background-color: #2563eb; color: #fff; font-size: 16px; cursor: pointer; margin-top: 10px; transition: 0.3s; }
button:hover { opacity: 0.9; }

table { width: 100%; border-collapse: collapse; margin-top: 30px; }
th, td { border: 1px solid #e5e7eb; padding: 10px; text-align: center; }
th { background-color: #2563eb; color: #fff; }
.status { padding: 5px 10px; border-radius: 5px; display: inline-block; font-weight: 500; }
.pending { background: #fff7ed; color: #d97706; }
.approved { background: #dcfce7; color: #166534; }
.rejected { background: #fee2e2; color: #991b1b; }
.actions button { margin: 0 5px; padding: 5px 10px; font-size: 14px; border-radius: 5px; cursor: pointer; border: none; }
.approve { background: #22c55e; color: #fff; }
.reject { background: #ef4444; color: #fff; }
</style>
</head>
<body>

<div class="container">
  <h1>Vendor Product Return Request</h1>

  <div class="form-group">
    <label for="product">Select Product</label>
    <select id="product">
      <option value="">-- Select Product --</option>
    </select>
  </div>

  <div class="form-group">
    <label for="qty">Quantity to Return</label>
    <input type="number" id="qty" min="1" value="1">
  </div>

  <div class="form-group">
    <label for="reason">Reason for Return</label>
    <textarea id="reason" rows="3" placeholder="Enter reason..."></textarea>
  </div>

  <button onclick="submitReturn()">Submit Return Request</button>

  <h2 style="margin-top: 30px;">Your Return Requests</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Quantity</th>
        <th>Reason</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="returnTableBody"></tbody>
  </table>
</div>

<script>
// Demo vendor products purchased from admin
const vendorProducts = [
  {id:1, name:'Samsung Galaxy S21', admin:'Admin A', stock:5},
  {id:2, name:'Men T-Shirt', admin:'Admin B', stock:10},
  {id:3, name:'Rice Cooker', admin:'Admin A', stock:3},
];

// Populate product select
const productSelect = document.getElementById('product');
vendorProducts.forEach(p => {
  const option = document.createElement('option');
  option.value = p.id;
  option.textContent = `${p.name} (Stock: ${p.stock})`;
  productSelect.appendChild(option);
});

let returnRequests = [];

function submitReturn() {
  const productId = parseInt(productSelect.value);
  const qty = parseInt(document.getElementById('qty').value);
  const reason = document.getElementById('reason').value.trim();

  if(!productId) { alert('Select a product.'); return; }
  if(!qty || qty < 1) { alert('Quantity must be at least 1.'); return; }
  const product = vendorProducts.find(p => p.id === productId);
  if(qty > product.stock) { alert(`You only have ${product.stock} in stock.`); return; }
  if(!reason) { alert('Provide a reason.'); return; }

  const request = {
    id: returnRequests.length+1,
    product: product.name,
    qty,
    reason,
    status: 'pending',
    productId: productId
  };
  returnRequests.push(request);
  product.stock -= qty; // remove from vendor stock until approved
  renderReturnTable();
  document.getElementById('qty').value = 1;
  document.getElementById('reason').value = '';
  productSelect.value = '';
  alert('✅ Return request submitted!');
}

function renderReturnTable() {
  const tbody = document.getElementById('returnTableBody');
  tbody.innerHTML = '';
  returnRequests.forEach((r, i) => {
    tbody.innerHTML += `
      <tr>
        <td>${r.id}</td>
        <td>${r.product}</td>
        <td>${r.qty}</td>
        <td>${r.reason}</td>
        <td><span class="status ${r.status}">${r.status.toUpperCase()}</span></td>
        <td class="actions">
          ${r.status === 'pending' ? `
            <button class="approve" onclick="approveReturn(${i})">Approve</button>
            <button class="reject" onclick="rejectReturn(${i})">Reject</button>
          `: ''}
        </td>
      </tr>
    `;
  });
}

// Simulate admin approve/reject
function approveReturn(i) {
  returnRequests[i].status = 'approved';
  const product = vendorProducts.find(p => p.id === returnRequests[i].productId);
  // Return product quantity to admin stock (here we just alert for now)
  alert(`✅ Return approved for ${returnRequests[i].product}.\nQuantity: ${returnRequests[i].qty} added back to admin stock.`);
  renderReturnTable();
}

function rejectReturn(i) {
  returnRequests[i].status = 'rejected';
  // Restore vendor stock since admin rejected return
  const product = vendorProducts.find(p => p.id === returnRequests[i].productId);
  product.stock += returnRequests[i].qty;
  renderReturnTable();
}

renderReturnTable();
</script>

</body>


@endsection