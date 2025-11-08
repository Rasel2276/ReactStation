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
    padding: 25px 25px;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 900px;
    margin: 40px auto;
}

h1 {
    text-align: center;
    margin-bottom: 25px;
    color: #111827;
}

/* ✅ Horizontal Form Wrapper */
.form-row {
    display: flex;
    align-items: center;
    gap: 20px;
}

/* Each group */
.form-group {
    flex: 1;
}

/* Label styling */
.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
}

/* Input + Select */
.form-group input,
.form-group select {
    width: 100%;
    padding: 10px 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 15px;
}

/* Submit Button */
button {
    padding: 12px 22px;
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    white-space: nowrap;
    transition: 0.3s;
    height: 45px;
}

button:hover {
    background: #1e40af;
}

/* ✅ Mobile Responsive */
@media(max-width: 700px){
    .form-row{
        flex-direction: column;
    }
    button {
        width: 100%;
    }
}

</style>

</head>
<body>

<div class="form-container">
    <h1>Purchase Product</h1>

    <!-- Success or error message -->
    <p id="message" style="display:none;"></p>

    <form id="purchaseForm">

        <div class="form-row">

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

            <div class="form-group" style="flex:0.4; margin-top:25px;">
                <button type="submit">Submit</button>
            </div>

        </div>

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