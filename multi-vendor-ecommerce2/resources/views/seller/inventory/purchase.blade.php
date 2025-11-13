@extends('seller.layouts.layout')
@section('seller_page_title')
    Multi Purchase Store
@endsection
@section('seller_layout')

<style>

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f6fb;
        margin: 0;
    }


    .form-container {
        max-width: 900px; /* Max-width বাড়ানো হয়েছে */
        margin: 40px auto;
        background: #fff;
        padding: 30px 35px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .form-container:hover {
        transform: translateY(-5px);
    }


    .form-container h1 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 28px;
        color: #111827;
    }


    .form-container p {
        font-weight: 500;
        margin-bottom: 15px;
        text-align: center;
        font-size: 16px;
    }

    /* নতুন রো-এর জন্য স্টাইল */
    .product-row {
        display: flex;
        gap: 15px;
        align-items: flex-end; /* নিচের দিকে অ্যালাইন করার জন্য */
        margin-bottom: 15px;
        padding: 15px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background-color: #f9fafb;
    }


    .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .form-group-full {
        flex-basis: 100%;
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 8px;
        font-weight: 500;
        color: #374151;
        font-size: 14px;
    }


    select, input[type="number"], .display-price {
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 15px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff;
    }

    select:focus, input[type="number"]:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        outline: none;
    }

    .display-price {
        background-color: #eef2ff;
        color: #1e40af;
        font-weight: 600;
        text-align: right;
    }

    .remove-btn {
        background: #ef4444 !important;
        width: 40px !important;
        height: 40px;
        padding: 8px;
        border-radius: 8px;
        margin: 0 !important;
        align-self: flex-end;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .remove-btn:hover {
        background: #dc2626 !important;
    }
    
    .add-btn {
        background: #10b981;
        width: auto !important;
        margin-top: 10px;
        padding: 8px 15px;
        font-size: 14px;
        display: inline-block;
    }
    .add-btn:hover {
        background: #059669;
    }

    .grand-total-display {
        text-align: right;
        font-size: 20px;
        font-weight: 700;
        color: #2563eb;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 2px dashed #d1d5db;
    }


    .submit-button {
        padding: 12px 25px;
        border: none;
        background: #2563eb;
        color: #fff;
        font-weight: 600;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
        width: 100%; 
        margin-top: 25px; 
    }

    .submit-button:hover {
        background: #1e40af;
        transform: translateY(-2px);
    }


    @media (max-width: 768px) {
        .product-row {
            flex-direction: column;
            align-items: stretch;
        }

        .form-group {
            width: 100%;
        }

        .remove-btn {
            width: 100% !important;
            height: auto;
            margin-top: 10px !important;
        }
    }
</style>

<div class="form-container">
    <h1>Multi-Product Purchase</h1>
    <p>Select multiple products and quantities to purchase from Admin Stock.</p>

    @if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
    @endif

    @if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
    @endif

    <form action="{{ route('inventory.vendor_purchase_store') }}" method="POST" id="purchase-form">
        @csrf
        
        <!-- Product Rows Container -->
        <div id="product-rows-container">
            <!-- Initial Row will be cloned here -->
        </div>

        <!-- Add New Row Button -->
        <button type="button" class="add-btn" onclick="addProductRow()">+ Add Another Product</button>

        <!-- Grand Total Display -->
        <div class="grand-total-display">
            Grand Total: <span id="grand-total">৳ 0.00</span>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" class="submit-button">Confirm Multi-Purchase</button>

    </form>
</div>

<!-- TEMPLATE FOR DYNAMIC ROW CLONING (Hidden from view) -->
<div id="product-row-template" style="display: none;">
    <div class="product-row" data-index="0">
        <!-- 1. Product Select -->
        <div class="form-group" style="flex: 4;">
            <label>Select Product</label>
            <select name="purchases[0][admin_stock_id]" 
                    class="product-select" 
                    onchange="updateRowDetails(this)" 
                    required>
                <option value="" data-price="0">-- Select Product --</option>
                @foreach($stocks as $stock)
                    <!-- Use data-price for JS calculation, ensure price exists -->
                    <option value="{{ $stock->id }}" 
                            data-price="{{ $stock->vendor_sale_price ?? $stock->purchase_price }}" 
                            data-max-qty="{{ $stock->quantity }}"
                            @if($stock->quantity==0) disabled @endif>
                        {{ $stock->product->name }} (Stock: {{ $stock->quantity }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- 2. Unit Price Display -->
        <div class="form-group" style="flex: 2;">
            <label>Unit Price</label>
            <div class="display-price unit-price">৳ 0.00</div>
        </div>

        <!-- 3. Quantity Input -->
        <div class="form-group" style="flex: 1.5;">
            <label>Quantity</label>
            <input type="number" 
                   name="purchases[0][quantity]" 
                   class="quantity-input"
                   min="1" 
                   value="0" 
                   required
                   oninput="calculateRowTotal(this)">
        </div>
        
        <!-- 4. Row Total Display -->
        <div class="form-group" style="flex: 2;">
            <label>Subtotal</label>
            <div class="display-price row-total">৳ 0.00</div>
        </div>

        <!-- 5. Remove Button -->
        <button type="button" class="remove-btn" onclick="removeProductRow(this)">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 18px; height: 18px;">
                <path fill-rule="evenodd" d="M16.5 4.475a.75.75 0 0 1 .75.75V18.75a.75.75 0 0 1-.75.75h-9a.75.75 0 0 1-.75-.75V5.225a.75.75 0 0 1 .75-.75h9Zm-3.75 1.75a.75.75 0 0 0-1.5 0v10.5a.75.75 0 0 0 1.5 0V6.225Z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>
</div>


<!-- JAVASCRIPT LOGIC -->
<script>
    let purchaseIndex = 0; // To track the index for form array (purchases[index][...])
    const container = document.getElementById('product-rows-container');
    const template = document.getElementById('product-row-template');
    
    // Initial row load
    document.addEventListener('DOMContentLoaded', () => {
        addProductRow();
    });


    /**
     * ডাইনামিক্যালি নতুন একটি পণ্য রো যোগ করে।
     */
    function addProductRow() {
        // 1. টেমপ্লেট ক্লোন করা
        const newRow = template.firstElementChild.cloneNode(true);
        purchaseIndex++;
        
        // 2. ইনপুট নামগুলো আপডেট করা
        newRow.setAttribute('data-index', purchaseIndex);
        
        newRow.querySelectorAll('[name^="purchases[0]"]').forEach(input => {
            const oldName = input.name;
            const newName = oldName.replace(/\[0\]/, `[${purchaseIndex}]`);
            input.name = newName;
            
            // নতুন রো-এর জন্য Quantity 1 সেট করা
            if (input.classList.contains('quantity-input')) {
                input.value = 1;
            }
        });

        // 3. কন্টেইনারে যোগ করা
        container.appendChild(newRow);
        
        // 4. গ্র্যান্ড টোটাল আপডেট করা (প্রথমবার যোগ করার সময় 0.00 থাকবে)
        updateGrandTotal();
    }


    /**
     * একটি পণ্য রো মুছে ফেলে এবং টোটাল আপডেট করে।
     */
    function removeProductRow(button) {
        // প্রথম রোটি মোছা যাবে না
        if (container.children.length > 1) {
            button.closest('.product-row').remove();
            updateGrandTotal();
        } else {
            alert("At least one product must be selected for purchase.");
        }
    }


    /**
     * প্রোডাক্ট নির্বাচন পরিবর্তনের পর মূল্য এবং সাবটোটাল আপডেট করে।
     */
    function updateRowDetails(selectElement) {
        const row = selectElement.closest('.product-row');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        
        const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        const maxQty = parseInt(selectedOption.getAttribute('data-max-qty')) || 0;
        
        const unitPriceDisplay = row.querySelector('.unit-price');
        const quantityInput = row.querySelector('.quantity-input');
        
        // ইউনিট প্রাইস ডিসপ্লে আপডেট করা
        unitPriceDisplay.textContent = `৳ ${price.toFixed(2)}`;

        // ম্যাক্স কোয়ান্টিটি সেট করা
        quantityInput.setAttribute('max', maxQty);
        
        // যদি নির্বাচিত কোয়ান্টিটি স্টকের চেয়ে বেশি হয়, তবে ঠিক করা
        if (parseInt(quantityInput.value) > maxQty) {
             quantityInput.value = maxQty > 0 ? maxQty : 1;
        }

        // রো টোটাল গণনা করা
        calculateRowTotal(quantityInput);
    }


    /**
     * বর্তমান রো-এর মোট মূল্য (সাবটোটাল) গণনা করে।
     */
    function calculateRowTotal(quantityInput) {
        const row = quantityInput.closest('.product-row');
        const selectElement = row.querySelector('.product-select');
        const selectedOption = selectElement.options[selectElement.selectedIndex];

        // ইনপুট ভ্যালিডেশন
        let quantity = parseInt(quantityInput.value) || 0;
        const maxQty = parseInt(quantityInput.getAttribute('max')) || 0;
        
        if (quantity < 1) quantity = 1; // সর্বনিম্ন 1
        if (maxQty > 0 && quantity > maxQty) quantity = maxQty; // সর্বোচ্চ স্টক

        quantityInput.value = quantity; // ভ্যালু ঠিক করা

        const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        
        const rowTotal = price * quantity;
        
        // সাবটোটাল ডিসপ্লে আপডেট করা
        row.querySelector('.row-total').textContent = `৳ ${rowTotal.toFixed(2)}`;
        
        // গ্র্যান্ড টোটাল আপডেট করা
        updateGrandTotal();
    }


    /**
     * সব রো-এর মোট মূল্য গণনা করে গ্র্যান্ড টোটাল আপডেট করে।
     */
    function updateGrandTotal() {
        let grandTotal = 0;
        const rows = container.querySelectorAll('.product-row');
        
        rows.forEach(row => {
            const totalText = row.querySelector('.row-total').textContent;
            // '৳ ' এবং কমা রিমুভ করে ফ্লোটে রূপান্তর করা
            const rowTotal = parseFloat(totalText.replace('৳', '').replace(/,/g, '').trim()) || 0;
            grandTotal += rowTotal;
        });
        
        document.getElementById('grand-total').textContent = `৳ ${grandTotal.toFixed(2)}`;
    }
</script>

@endsection