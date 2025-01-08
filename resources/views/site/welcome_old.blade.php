@extends('site.layout.master')
@section('title') Main Categories @endsection
@section('css') @endsection
@section('breadcrumb') @endsection
@section('content')

<!-- Start About Cake -->
<section class="about-cake">
    <div class="container">
        <!-- About Content -->
        <h2 class="hide">
            &nbsp;
        </h2>
        <div class="about-content">
            <img alt="Cake-White" src="{{asset('site/assets/images/cake-white.png')}}">
            <p>
                Toffee sugar plum halvah liquorice <b>brownie gummies</b>&nbsp;chocolate bar muffin candy canes. Dessert jelly-o tootsie roll jelly sesame snaps icing.
            </p>
        </div>
    </div>
</section>
<!-- End About Cake -->

<!-- Start Product Cake -->
<section class="product-cake">
    <div class="container">
        <!-- Product Title -->
        <div class="product-title">
            <img alt="Cake-Purple" src="{{asset('site/assets/images/cake-purple.png')}}">
            <h2>@langucw('new products')</h2>
        </div>
        <!-- Product Content -->
        <div class="product-content">
            <div class="row">
                @foreach($newProducts as $index => $newProduct)
                    @include('components.product',['product'=>$newProduct,'color'=>$genralSetting->getColor($index)])
                @endforeach
                <!-- Column Title -->
                <div class="col-sm-12">
                    <p class="text-content text-center">
                        Toffee sugar plum halvah liquorice <b class="purple-color">brownie gummies</b>&nbsp;chocolate bar muffin candy canes. Dessert jelly-o tootsie roll jelly sesame snaps icing.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Sale --}}
    @include('components.flash-sale')

    <div class="pad-top-150"></div>

    {{-- Discount --}}
    @include('components.discount-item')

    {{-- Conditional Delivery --}}
    @include('components.condition-deliverie')

</section>
<!-- End Product Cake -->

<!-- Start News Cake -->
<section class="news-cake">
    <div class="triangle-no-animate">&nbsp;</div>
    <!-- News Content -->
    <div class="new-cake-content mar-top-20">
        <!-- Title News Content -->
        <div class="title-cake text-center">
            <div class="container">
                <img alt="Cake-White" src="{{asset('site/assets/images/cake-white.png')}}">
                <h2>New's Cake</h2>
            </div>
        </div>
        <!-- Content News -->
        <div class="container mar-top-20">
            <div class="row">
                <div class="col-sm-6 no-pad-right">
                    <div class="left-news">
                        <h1>CAKE <span>Wedding</span></h1>
                    </div>
                    <div class="right-news">
                        <div class="text-table">
                            <p><a href="shop.html"><span class="discount">40<span class="percent">%</span><br></span><span class="sale">Sale Product</span></a></p>
                        </div>
                        <div class="text-table dot-background">
                            <p><img alt="Client" src="assets/images/client.png"></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 no-pad-left">
                    <div class="top-news-right">
                        <div class="left-news-right">
                            <div class="text-table">
                                <a class="fancybox" data-fancybox-group="contentnews" href="assets/images/ice-cream.png">
                                    <div class="wizz-effect wizz-orange">
                                        <div class="wrap-info">Ice Cream</div>
                                    </div>
                                </a>
                                <p><img alt="Ice Cream" class="img-100" src="assets/images/ice-cream.png"></p>
                            </div>
                        </div>
                        <div class="right-news-right">
                            <div class="text-table">
                                <a class="fancybox" data-fancybox-group="contentnews" href="assets/images/ice-cream-cake.png">
                                    <div class="wizz-effect wizz-green">
                                        <div class="wrap-info">Cake's Flavors</div>
                                    </div>
                                </a>
                                <p><img alt="Ice Cream Cake" class="img-100" src="assets/images/ice-cream-cake.png"></p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-new-right">
                        <div class="quote">
                            <div>
                                <span class="mar-right-10"><img alt="Quote" class="Quote" src="assets/images/quote.png"></span>
                                <p><span class="bold-font-lg">Adam Grilss, </span><span>&nbsp; CEO B </span></p>
                                <p>That’s great product wonderful place and cakes, so yummy this cake.</p>
                            </div>
                            <div>
                                <span class="mar-right-10"><img alt="Quote" class="Quote" src="assets/images/quote.png"></span>
                                <p><span class="bold-font-lg">Natasya, </span><span>&nbsp; CEO B </span></p>
                                <p>That’s great product wonderful place and cakes, so yummy this cake.</p>
                            </div>
                            <div>
                                <span class="mar-right-10"><img alt="Quote" class="Quote" src="assets/images/quote.png"></span>
                                <p><span class="bold-font-lg">Melody, </span><span>&nbsp; CEO B </span></p>
                                <p>That’s great product wonderful place and cakes, so yummy this cake.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content News -->
    </div>
    <!-- End News Content -->
</section>
<!-- End News Cake -->

<!-- Start Option Cake -->
<section class="option">
    <!-- Title Option -->
    <div class="green-table pad-top-10 pad-btm-10">
        <div class="container">
            <div class="title-cake text-center">
                <img alt="Cake-White" src="{{asset('site/assets/images/cake-white.png')}}">
                <h2>What We Can</h2>
            </div>
        </div>
    </div>
    <div class="green-arrow"></div>
    <!-- Option Content -->
    <div class="option-content">
        <div class="container">
            <!-- Column -->
            <div class="col-sm-4">
                <div class="messes">
                    <div class="messes-show"></div>
                    <div class="round-wrap green-option"></div>
                </div>
                <h4 class="green-color">Make Cake</h4>
                <div class="line-temp line-green-sm">&nbsp;</div>
                <p class="text-center mar-top-10">
                    Cookie apple pie donut gingerbread sweet roll pudding topping marshmallow.
                </p>
            </div>
            <!-- Column -->
            <div class="col-sm-4">
                <div class="messes">
                    <div class="messes-show"></div>
                    <div class="round-wrap orange-option"></div>
                </div>
                <h4 class="orange-color">Make Cake</h4>
                <div class="line-temp line-orange-sm">&nbsp;</div>
                <p class="text-center mar-top-10">
                    Cookie apple pie donut gingerbread sweet roll pudding topping marshmallow.
                </p>
            </div>
            <!-- Column -->
            <div class="col-sm-4">
                <div class="messes">
                    <div class="messes-show"></div>
                    <div class="round-wrap blue-option"></div>
                </div>
                <h4 class="blue-color">Make Cake</h4>
                <div class="line-temp line-blue-sm">&nbsp;</div>
                <p class="text-center mar-top-10">
                    Cookie apple pie donut gingerbread sweet roll pudding topping marshmallow.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- End Option Cake -->

<!-- Start Pricing Cake -->
<section class="pricing-cake">
    <div class="triangle-no-animate">&nbsp;</div>
    <!-- Content Pricing Cake -->
    <div class="content-pricing-cake">
        <div class="title-cake text-center">
            <div class="container">
                <img alt="Cake-White" src="{{asset('site/assets/images/cake-white.png')}}">
                <h2>Our Price</h2>
            </div>
        </div>
        <div class="container mar-top-20">
            <!-- Column -->
            <div class="col-sm-3 mar-btm-20">
                <div class="img-wrap-price">
                    <img alt="Price-Purple" class="img-full-sm" src="{{asset('site/assets/images/price-purple.png')}}">
                </div>
                <div class="content-price content-price-tag text-center">
                    <h4 class="dpurple-color">$ 100/<span>Package</span></h4>
                    <div class="price-purple">
                        <div class="triangle-no-animate">&nbsp;</div>
                        <div class="text-price">Just Cupcakes + Free Order</div>
                        <ul class="text-list">
                            <li>Best quality</li>
                            <li>Fast delivery</li>
                            <li>Always fresh</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-sm-3 mar-btm-20">
                <div class="img-wrap-price">
                    <img alt="Price-Green" class="img-full-sm" src="{{asset('site/assets/images/price-green.png')}}">
                </div>
                <div class="content-price content-price-tag text-center">
                    <h4 class="dgreen-color">$ 50/<span>Package</span></h4>
                    <div class="price-green">
                        <div class="triangle-no-animate">&nbsp;</div>
                        <div class="text-price">Just Cake + Free Order</div>
                        <ul class="text-list">
                            <li>Best quality</li>
                            <li>Fast delivery</li>
                            <li>Always fresh</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-sm-3 mar-btm-20">
                <div class="img-wrap-price">
                    <img alt="Price-Orange" class="img-full-sm" src="{{asset('site/assets/images/price-orange.png')}}">
                </div>
                <div class="content-price content-price-tag text-center">
                    <h4 class="dorange-color">$ 20/<span>Package</span></h4>
                    <div class="price-orange">
                        <div class="triangle-no-animate">&nbsp;</div>
                        <div class="text-price">Just Muffin + Free Order</div>
                        <ul class="text-list">
                            <li>Best quality</li>
                            <li>Fast delivery</li>
                            <li>Always fresh</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-sm-3 mar-btm-20">
                <div class="img-wrap-price">
                    <img alt="Price-Red" class="img-full-sm" src="{{asset('site/assets/images/price-red.png')}}">
                </div>
                <div class="content-price content-price-tag text-center">
                    <h4 class="dred-color">$ 200/<span>Package</span></h4>
                    <div class="price-red">
                        <div class="triangle-no-animate">&nbsp;</div>
                        <div class="text-price">Special Premium Pack + Free Order</div>
                        <ul class="text-list">
                            <li>Best quality</li>
                            <li>Fast delivery</li>
                            <li>Always fresh</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content Pricing Cake -->
</section>
<!-- End Pricing Cake -->

@endsection

@section('js') @endsection
