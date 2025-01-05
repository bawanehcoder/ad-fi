@extends('site.layout.master')
@section('title')
    @langucw('address')
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li><a href="{{ route('cart.view_cart') }}">@langucw('cart')</a></li>
    <li>@langucw('address')</li>
@endsection
@section('content')


<div class="container">
    <div class="steps">
        <div class="step">
            <span class="step-icon active">
                <svg width="25" height="33" viewBox="0 0 25 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.25 31.375C2.125 18.25 0.5 16.875 0.5 12C0.5 5.375 5.8125 0 12.5 0C19.125 0 24.5 5.375 24.5 12C24.5 16.875 22.8125 18.25 13.6875 31.375C13.125 32.25 11.8125 32.25 11.25 31.375ZM12.5 17C15.25 17 17.5 14.8125 17.5 12C17.5 9.25 15.25 7 12.5 7C9.6875 7 7.5 9.25 7.5 12C7.5 14.8125 9.6875 17 12.5 17Z" fill="white"/>
                    </svg>
                    
            </span>
            <span class="step-title">العنـــوان</span>
        </div><!-- /.step -->


        <div class="step">
            <span class="step-icon">
                <svg width="28" height="22" viewBox="0 0 28 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.5 19.25V11H27.5V19.25C27.5 20.5156 26.4688 21.5 25.25 21.5H2.75C1.48438 21.5 0.5 20.5156 0.5 19.25ZM9.5 16.0625V17.9375C9.5 18.2656 9.73438 18.5 10.0625 18.5H16.4375C16.7188 18.5 17 18.2656 17 17.9375V16.0625C17 15.7812 16.7188 15.5 16.4375 15.5H10.0625C9.73438 15.5 9.5 15.7812 9.5 16.0625ZM3.5 16.0625V17.9375C3.5 18.2656 3.73438 18.5 4.0625 18.5H7.4375C7.71875 18.5 8 18.2656 8 17.9375V16.0625C8 15.7812 7.71875 15.5 7.4375 15.5H4.0625C3.73438 15.5 3.5 15.7812 3.5 16.0625ZM27.5 2.75V5H0.5V2.75C0.5 1.53125 1.48438 0.5 2.75 0.5H25.25C26.4688 0.5 27.5 1.53125 27.5 2.75Z" fill="white"/>
                    </svg>
                    
                    
            </span>
            <span class="step-title">طريقة الدفع</span>
        </div><!-- /.step -->


        <div class="step">
            <span class="step-icon">
                <svg width="25" height="34" viewBox="0 0 25 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.875 1.25C23.5625 0.75 24.5 1.1875 24.5 2V32C24.5 32.875 23.5 33.3125 22.875 32.8125L20.5 30L17.0625 32.8125C16.875 32.9375 16.6875 33.0625 16.4375 33.0625C16.25 33.0625 16.0625 32.9375 15.875 32.8125L12.5 30L9.0625 32.8125C8.875 32.9375 8.6875 33.0625 8.4375 33.0625C8.25 33.0625 8.0625 32.9375 7.875 32.8125L4.5 30L2.0625 32.8125C1.4375 33.3125 0.5 32.875 0.5 32V2C0.5 1.1875 1.4375 0.75 2.0625 1.25L4.5 4L7.875 1.25C8.0625 1.125 8.25 1 8.5 1C8.6875 1 8.875 1.125 9.0625 1.25L12.5 4L15.875 1.25C16.0625 1.125 16.25 1 16.5 1C16.6875 1 16.875 1.125 17.0625 1.25L20.5 4L22.875 1.25ZM20.5 23.5V22.5C20.5 22.25 20.25 22 20 22H5C4.6875 22 4.5 22.25 4.5 22.5V23.5C4.5 23.8125 4.6875 24 5 24H20C20.25 24 20.5 23.8125 20.5 23.5ZM20.5 17.5V16.5C20.5 16.25 20.25 16 20 16H5C4.6875 16 4.5 16.25 4.5 16.5V17.5C4.5 17.8125 4.6875 18 5 18H20C20.25 18 20.5 17.8125 20.5 17.5ZM20.5 11.5V10.5C20.5 10.25 20.25 10 20 10H5C4.6875 10 4.5 10.25 4.5 10.5V11.5C4.5 11.8125 4.6875 12 5 12H20C20.25 12 20.5 11.8125 20.5 11.5Z" fill="white"/>
                    </svg>
                    
                    
                    
            </span>
            <span class="step-title">الفاتورة</span>
        </div><!-- /.step -->
    </div>
</div>

<section class="address">
    <div class="container">
        <div class="addressh">
            <h3>العنوان المراد التوصيل اليه</h3>
            <a href="#"  data-bs-toggle="modal" data-bs-target="#exampleModal2">إضافة عنوان</a>
        </div>
    
        <div class="adreeslist">
            @foreach ($shipping_info ?? [] as $index => $info)
    
                <div class="addressitem">
                    <h5><svg width="27" height="34" viewBox="0 0 27 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.7188 27.1094C6.01562 18.9062 5 18.0469 5 15C5 10.8594 8.32031 7.5 12.5 7.5C16.6406 7.5 20 10.8594 20 15C20 18.0469 18.9453 18.9062 13.2422 27.1094C12.8906 27.6562 12.0703 27.6562 11.7188 27.1094ZM12.5 18.125C14.2188 18.125 15.625 16.7578 15.625 15C15.625 13.2812 14.2188 11.875 12.5 11.875C10.7422 11.875 9.375 13.2812 9.375 15C9.375 16.7578 10.7422 18.125 12.5 18.125Z" fill="#966D0E"/>
                        </svg>
                        
                        
                        {{ $info->title }} </h5>
                    <h5> <input class="card__input" type="radio" _href="{{ route('payment.show_payment_form', $info) }}" name="address_id"
                        value="{{ $info->id }}"> </h5>
                </div>
    
            @endforeach
        </div>
    </div>
</section>


<div class="container">
    <div class="btn btn-primary cs" onclick="nextFun()"> @langucw('التالي')</div>

</div>
    {{-- <div class="container mt-10">
        <div class="shop-details">
            <div class="list-cake" data-aos="fade-in">
                <div class="row">
                    @include('components.messagesAndErrors')
                    <div class="row">
                        <div class="col-12 " id="shipping_info">
                            <h1 class="section-name ">@langucw('choose your address')</h1>
                            <div class="row m-1">
                                @foreach ($shipping_info ?? [] as $index => $info)
                                    <div class="col-md-4">
                                        @include('site.cart.shipping-card-info')
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-10 mb-10">
                        <div onclick="window.open('{{ route('cart.view_cart') }}','_self');" class="btn btn-primary">
                            {{ trans('general.back') }}</div>
                        <div class="btn btn-primary" onclick="newAddressModalFun()">@langucw('add a new address')</div>
                        <div class="btn btn-primary" onclick="nextFun()"> @langucw('next')</div>
                    </div>
                    <br>
                    <br>
                    <br>
                </div>
            </div>

        </div>
    </div> --}}



    @include('site.cart.address-modal')
@endsection
