@extends('front_end.home.ui_layout')

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ asset('front_end_asset/assets/images/page-header-bg.jpg') }}');">
        <div class="container">
            <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('website.home')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>  
        </div>
    </nav>

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <form action="{{ route('cart.update', 0) }}" method="POST" id="cart-form">
                            @csrf
                            @method('PUT')
                            <table class="table table-cart table-mobile">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $total = 0; @endphp
                                    @if(session('cart') && count(session('cart')) > 0)
                                        @foreach(session('cart') as $id => $item)
                                            @php $total += $item['price'] * $item['quantity']; @endphp
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="#">
                                                                <img src="{{ asset('product_images/'.$item['image']) }}" alt="{{ $item['name'] }}">
                                                            </a>
                                                        </figure>
                                                        <h3 class="product-title"><a href="#">{{ $item['name'] }}</a></h3>
                                                    </div>
                                                </td>
                                                <td class="price-col" data-price="{{ $item['price'] }}">$ {{ number_format($item['price'], 2) }}</td>
                                                <td class="quantity-col" style="padding-right: 15px;">
                                                    <input type="number" name="quantities[{{ $id }}]" class="form-control quantity-input" value="{{ $item['quantity'] }}" min="1" required style="width:70px; margin:0 auto;">
                                                </td>
                                                <td class="total-col" style="padding-left: 15px;">$<span class="item-total">{{ number_format($item['price'] * $item['quantity'], 2) }}</span></td>
                                                <td class="remove-col">
                                                    <a href="{{ route('cart.remove', $id) }}" class="btn-remove" title="Remove Product">
                                                        <i class="icon-close"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center p-3">Your cart is empty.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            @if(session('cart') && count(session('cart')) > 0)
                                <div class="cart-bottom d-flex justify-content-between align-items-center mt-3">
                                    <a href="{{ route('website.shop') }}" class="btn btn-outline-dark-2"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                                    <button type="submit" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></button>
                                </div>
                            @endif
                        </form>
                    </div><!-- End col-lg-9 -->

                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3>
                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>$<span id="cart-subtotal">{{ number_format($total, 2) }}</span></td>
                                    </tr>
                                    <tr class="summary-shipping">
                                        <td>Shipping:</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>
                                            <input type="radio" id="free-shipping" name="shipping" class="shipping-input" data-price="0">
                                            <label for="free-shipping">Free Shipping</label>
                                        </td>
                                        <td>$0.00</td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>
                                            <input type="radio" id="standart-shipping" name="shipping" class="shipping-input" data-price="10">
                                            <label for="standart-shipping">Standart</label>
                                        </td>
                                        <td>$10.00</td>
                                    </tr>
                                    <tr class="summary-shipping-row">
                                        <td>
                                            <input type="radio" id="express-shipping" name="shipping" class="shipping-input" data-price="20">
                                            <label for="express-shipping">Express</label>
                                        </td>
                                        <td>$20.00</td>
                                    </tr>
                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>$<span id="cart-total">{{ number_format($total, 2) }}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="{{ route('website.checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
                        </div>

                        <a href="{{ route('website.shop') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
                    </aside>
                </div><!-- End row -->
            </div><!-- End container -->
        </div><!-- End cart -->
    </div><!-- End page-content -->
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    const shippingInputs = document.querySelectorAll('.shipping-input');
    const subtotalElem = document.getElementById('cart-subtotal');
    const totalElem = document.getElementById('cart-total');

    function calculateTotals() {
        let subtotal = 0;

        quantityInputs.forEach(input => {
            const price = parseFloat(input.closest('tr').querySelector('.price-col').dataset.price);
            const quantity = parseInt(input.value);
            const itemTotal = price * quantity;
            input.closest('tr').querySelector('.item-total').textContent = itemTotal.toFixed(2);
            subtotal += itemTotal;
        });

        let shippingCost = 0;
        shippingInputs.forEach(input => {
            if (input.checked) shippingCost = parseFloat(input.dataset.price);
        });

        subtotalElem.textContent = subtotal.toFixed(2);
        totalElem.textContent = (subtotal + shippingCost).toFixed(2);
    }

    quantityInputs.forEach(input => input.addEventListener('input', calculateTotals));
    shippingInputs.forEach(input => input.addEventListener('change', calculateTotals));

    if (![...shippingInputs].some(i => i.checked) && shippingInputs.length > 0) {
        shippingInputs[0].checked = true;
        calculateTotals();
    }
});
</script>

@endsection
