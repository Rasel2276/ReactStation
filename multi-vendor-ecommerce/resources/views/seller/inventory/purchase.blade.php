@extends('seller.layouts.layout')
@section('seller_page_title')
     create store
@endsection
@section('seller_layout')


<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f4f6fb;
    margin: 0;
}
.form-container {
    background: #fff;
    padding: 30px 25px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
}
h1 {
    text-align: center;
    margin-bottom: 25px;
    color: #111827;
}
.form-group {
    margin-bottom: 15px;
}
.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
}
.form-group input,
.form-group select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 15px;
}
button {
    width: 100%;
    padding: 12px;
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}
button:hover {
    background: #1e40af;
}
.purchase-summary {
    margin-top: 20px;
    background: #f9fafb;
    padding: 15px;
    border-radius: 8px;
    display: none;
}
.purchase-summary p {
    margin-bottom: 8px;
    font-size: 15px;
}
</style>
</head>
<body>

<div class="form-container">
    <h1>Purchase Product</h1>

    <!-- Success or error message -->
    <p id="message" style="display:none;"></p>

    <form id="purchaseForm">
        <div class="form-group">
            <label for="productSelect">Select Product</label>
            <select id="productSelect" required>
                <option value="">-- Select Product --</option>
                <option value="1">Laptop - ৳80000 (Stock: 12)</option>
                <option value="2">Headphone - ৳1500 (Stock: 30)</option>
                <option value="3" disabled>Mouse - ৳500 (Stock: 0)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" min="1" value="1" required>
        </div>

        <button type="submit">Submit Purchase</button>
    </form>
</div>

<script>
document.getElementById("purchaseForm").addEventListener("submit", function(e){
    e.preventDefault();
    const message = document.getElementById("message");
    message.style.display = "block";
    message.style.color = "green";
    message.textContent = "Purchase submitted successfully!";
});
</script>

</body>

@endsection