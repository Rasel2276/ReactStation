@extends('front_end.home.ui_layout')

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{asset('front_end_asset/assets/images/page-header-bg.jpg')}}');">
        <div class="container">
            <h1 class="page-title">Grid 3 Columns<span>Shop</span></h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('website.home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('website.shop')}}">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Grid 3 Columns</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Showing <span>{{ $customerProducts->count() }} of {{ $customerProducts->count() }}</span> Products
                            </div>
                        </div>
                    </div>

                    <div class="products mb-3">
                        <div class="row justify-content-center">
                            @foreach($customerProducts as $product)
                            <div class="col-6 col-md-4 col-lg-4">
                                <div class="product product-7 text-center">
                                    <figure class="product-media">
                                        @if($product->quantity > 0)
                                            <span class="product-label label-new">New</span>
                                        @else
                                            <span class="product-label label-out">Out of Stock</span>
                                        @endif

                                        <a href="#">
                                            <img src="{{ asset('product_images/'.$product->image) }}" alt="Product image" class="product-image">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                            <a href="#" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                            <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                        </div>

                                        <div class="product-action">
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn-product btn-cart"><span>add to cart</span></button>
                                            </form>
                                        </div>
                                    </figure>

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">{{ $product->product->name ?? 'Unknown Category' }}</a>
                                        </div>
                                        <h3 class="product-title"><a href="#">{{ $product->details }}</a></h3>
                                        <div class="product-price">
                                            ${{ $product->price }}
                                        </div>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 0%;"></div>
                                            </div>
                                            <span class="ratings-text">( {{ rand(0,10) }} Reviews )</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>