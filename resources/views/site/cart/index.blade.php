@extends('site.layout.master')
@section('title')
    @langucw('cart')
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li><a href="{{route('home')}}">@langucw('home')</a></li>
    <li><a href="{{route('products.index')}}">@langucw('shop')</a></li>
    <li>@langucw('cart')</li>
@endsection
@section('content')
    @php
        $subtotal_mob=0;
        $subtotal_dev=0;
    @endphp
    @include('components.messagesAndErrors')
    <div class="section section-padding-03">
        <div class="container mt-10 ">
            <div class="row mb-n30">
                <div class="col-lg-8 col-12 mb-30">
                    <!-- Cart Table For Tablet & Up Devices Start -->
                    @include('site.cart.tablet-up-devices')
                    <!-- Cart Table For Tablet & Up Devices End -->
                </div>
                <!-- Cart Table For Mobile Devices Start -->
                @include('site.cart.mobile-devices')
                <!-- Cart Table For Mobile Devices End -->

                <!-- Cart Totals Start -->
                @include('site.cart.cart-totals')
                <!-- Cart Totals End -->
            </div>
        </div>
    </div>

@endsection

