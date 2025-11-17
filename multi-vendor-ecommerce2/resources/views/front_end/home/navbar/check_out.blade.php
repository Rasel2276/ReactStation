@extends('front_end.home.ui_layout')

@section('content')
<main class="main">

    <div class="page-header text-center" style="background-image: url('{{ asset('front_end_asset/assets/images/page-header-bg.jpg') }}');">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('website.home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="checkout">
            <div class="container">

                <div class="checkout-discount">
									@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
                    <form action="#">
                        <input type="text" class="form-control" required id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                    </form>
                </div>

                <form action="{{ route('checkout.placeOrder') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name *</label>
                                    <input type="text" name="first_name" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Last Name *</label>
                                    <input type="text" name="last_name" class="form-control" required>
                                </div>
                            </div>

                            <label>Company Name (Optional)</label>
                            <input type="text" name="company_name" class="form-control">

                            <label>Country *</label>
                            <input type="text" name="country" class="form-control" required>

                            <label>Street address *</label>
                            <input type="text" name="street_address" class="form-control" placeholder="House number and Street name" required>
                            <input type="text" name="street_address2" class="form-control" placeholder="Appartments, suite, unit etc ...">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Town / City *</label>
                                    <input type="text" name="city" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>State / County *</label>
                                    <input type="text" name="state" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Postcode / ZIP *</label>
                                    <input type="text" name="postcode" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Phone *</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                            </div>

                            <label>Email address *</label>
                            <input type="email" name="email" class="form-control" required>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkout-create-acc">
                                <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                            </div>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                                <label class="custom-control-label" for="checkout-diff-address">Ship to a different address?</label>
                            </div>

                            <label>Order notes (optional)</label>
                            <textarea name="order_notes" class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                        </div>

                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3>
                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $subtotal = 0; @endphp
                                        @if(session()->has('cart'))
                                            @foreach(session('cart') as $item)
                                                @php $total = $item['price'] * $item['quantity']; @endphp
                                                <tr>
                                                    <td>{{ $item['name'] }}</td>
                                                    <td>${{ number_format($total,2) }}</td>
                                                </tr>
                                                @php $subtotal += $total; @endphp
                                            @endforeach
                                        @endif
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>${{ number_format($subtotal,2) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping:</td>
                                            <td>Free shipping</td>
                                        </tr>
                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>${{ number_format($subtotal,2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="accordion-summary" id="accordion-payment">
                                    <div class="card">
                                        <div class="card-header" id="heading-1">
                                            <h2 class="card-title">
                                                <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                                    Direct bank transfer
                                                </a>
                                            </h2>
                                        </div>
                                        <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
                                            <div class="card-body">
                                                Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add other payment methods if needed -->
                                </div>

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
