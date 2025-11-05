@extends('admin.layouts.layout')
@section('admin_page_title')
Order - Admin Panel
@endsection
@section('admin_layout') 

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f2f5;
}
h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
}
form {
    max-width: 1000px;
    margin: 0 auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.total-amount {
    text-align: right;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 15px;
}
select, input {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 1rem;
}
#product_wrapper {
    margin-bottom: 15px;
}
.product-row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    background: #f9f9f9;
    padding: 15px;
    border: 1px dashed #ccc;
    margin-bottom: 10px;
    border-radius: 5px;
    position: relative;
}
.product-row select,
.product-row input {
    flex: 1;
    min-width: 150px;
}
.remove-btn {
    background: #e74c3c;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    align-self: flex-start;
    margin-left: auto;
}
.add-btn {
    background: #2ecc71;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 15px;
    float: right;
}
.submit-btn {
    width: 100%;
    padding: 12px;
    background: #3498db;
    color: #fff;
    font-size: 1.1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.submit-btn:hover, .add-btn:hover, .remove-btn:hover {
    opacity: 0.9;
}
.clearfix::after {
    content: "";
    display: table;
    clear: both;
}
</style>
</head>
<body>

<h2>Admin Purchase - Multiple Products</h2>

<form id="purchaseForm">
    <div class="total-amount">
        Total Amount: ৳<span id="totalAmount">0.00</span>
    </div>

    <div id="product_wrapper">
        <div class="product-row">
            <!-- Supplier -->
            <select name="products[0][supplier_id]" required>
                <option value="">-- Supplier --</option>
                <option value="1">Supplier A</option>
                <option value="2">Supplier B</option>
                <option value="3">Supplier C</option>
            </select>
            <!-- Product -->
            <select name="products[0][product_id]" required>
                <option value="">-- Product --</option>
                <option value="1">Product A</option>
                <option value="2">Product B</option>
                <option value="3">Product C</option>
            </select>
            <input type="number" name="products[0][quantity]" placeholder="Qty" min="1" required>
            <input type="number" step="0.01" name="products[0][purchase_price]" placeholder="Purchase Price" required>
            <input type="number" step="0.01" name="products[0][vendor_sale_price]" placeholder="Vendor Sale" required>
            <button type="button" class="remove-btn">Remove</button>
        </div>
    </div>

    <div class="clearfix">
        <button type="button" class="add-btn" id="add_product_btn">Add Another Product</button>
    </div>

    <button type="submit" class="submit-btn">Submit Purchase</button>
</form>

<script>
let productIndex = 1;

// Add new product row
document.getElementById('add_product_btn').addEventListener('click', function() {
    const wrapper = document.getElementById('product_wrapper');
    const newRow = document.createElement('div');
    newRow.classList.add('product-row');
    newRow.innerHTML = `
        <select name="products[${productIndex}][supplier_id]" required>
            <option value="">-- Supplier --</option>
            <option value="1">Supplier A</option>
            <option value="2">Supplier B</option>
            <option value="3">Supplier C</option>
        </select>
        <select name="products[${productIndex}][product_id]" required>
            <option value="">-- Product --</option>
            <option value="1">Product A</option>
            <option value="2">Product B</option>
            <option value="3">Product C</option>
        </select>
        <input type="number" name="products[${productIndex}][quantity]" placeholder="Qty" min="1" required>
        <input type="number" step="0.01" name="products[${productIndex}][purchase_price]" placeholder="Purchase Price" required>
        <input type="number" step="0.01" name="products[${productIndex}][vendor_sale_price]" placeholder="Vendor Sale" required>
        <button type="button" class="remove-btn">Remove</button>
    `;
    wrapper.appendChild(newRow);
    productIndex++;
    updateTotal();
});

// Remove product row
document.addEventListener('click', function(e){
    if(e.target && e.target.classList.contains('remove-btn')){
        e.target.closest('.product-row').remove();
        updateTotal();
    }
});

// Calculate total amount
function updateTotal(){
    let total = 0;
    const rows = document.querySelectorAll('.product-row');
    rows.forEach(row => {
        const qty = parseFloat(row.querySelector('[name*="[quantity]"]').value) || 0;
        const price = parseFloat(row.querySelector('[name*="[purchase_price]"]').value) || 0;
        total += qty * price;
    });
    document.getElementById('totalAmount').textContent = total.toFixed(2);
}

// Update total on input change
document.getElementById('product_wrapper').addEventListener('input', function(e){
    if(e.target && (e.target.name.includes('quantity') || e.target.name.includes('purchase_price'))){
        updateTotal();
    }
});

// Handle form submit
document.getElementById('purchaseForm').addEventListener('submit', function(e){
    e.preventDefault();
    alert('Form submitted! Laravel backend will handle saving data.');
});
</script>

</body>



@endsection