@php

    if(isset($product)){
            $discount=app()->make(\App\Services\DiscountService::class)->getDiscountByItem($product);
            $endDate= app()->make(\App\Services\DiscountService::class)->getDiscountEndDateByItem($product);
            $offer=$product->offerActive->last();
    }

@endphp
@if(isset($discount))
    <div class="swiper-slide">
        @php
        $discount = app()
            ->make(\App\Services\DiscountService::class)
            ->getDiscountByItem($product);

    @endphp

        <div class="product-new-card">
            <div class="card p-3" id="card">
                @if ($discount > 0)
                    {{-- <div class="product-item__badge">{{ trans('general.discount') }} </div> --}}
                    <div class="position-absolute offer-label">
                        {{ $discount }} %
                    </div>
                @endif
                <a href="{{ route('products.show', $product) }}"
                    class="d-flex align-items-center justify-content-between img-wrap">

                    <div class="d-none product-fun p-3">
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            {{-- <a href="JavaScript:void(0)" class="d-flex" onclick="quickview({{ $product->id }})"
                        data-bs-tooltip="tooltip" data-bs-placement="top" title="@langucw('quick view')">>
                        <img src="{{ asset('assets/images/ic_pro_fun_zoom.svg') }}" />
                    </a>
                    <a href="#" class="d-flex"
                        @if (auth()->user()) onclick="addToFavorite({{ $product->id }})" @endif>
                        <img src="{{ asset('assets/images/ic_pro_fun_fav.svg') }}" />
                    </a>
                    <a href="JavaScript:void(0)"
                        @if (auth()->user()) onclick="addToCart({{ $product->id }})" @endif
                        class="d-flex">
                        <img src="{{ asset('assets/images/ic_pro_fun_card.svg') }}" />
                    </a>
                    <a href="#" class="d-flex"
                        @if (auth()->user()) onclick="addToCart({{ $product->id }})" @endif>
                        <img src="{{ asset('assets/images/ic_pro_fun_checkout.svg') }}" />
                    </a> --}}
                        </div>
                    </div>
                    @auth
                        @if ($product->isFavorite())
                            <div class="position-absolute"
                                @if (auth()->user()) onclick="addToFavorite({{ $product->id }})" @endif>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#BE66E3"
                                    class="bi bi-heart-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                </svg>
                            </div>
                        @endif
                    @endauth



                    <img src="{{ asset($product->getFirstMediaUrl('products', 'full')) }}" class="w-100 d-flex mx-auto"
                        id="image_1" />
                </a>
            </div>

            <div class="prod-det ">
                <a href="{{ route('products.show', $product) }}"
                    class="d-flex align-items-center justify-content-between">
                    <h3 class="mt-3">{{ $product->getTitle() }}</h3>
                </a>
                @php $offer=$product?->offerActive->last(); @endphp



                <div class="d-flex flex-column">
                    <h3>{{ $product->price() }}  </h3>
                </div>

            </div>
            <a href="#" class="d-flex align-items-center justify-content-between">
                <div class="d-flex flex-row ">
                    {{-- <div class="riv" style="width: {{ $product->getPercentage() }}%">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                </div> --}}
                </div>
                @if ($offer)
                    <h6 class="m-0"> {{ $product->price2() }}{{ $genralSetting->getCurrency() }}</h6>
                @endif

            </a>

            {{-- <a href="{{ route('products.show', $product) }}" class="d-flex align-items-center justify-content-between">
            <h3 class="mt-3">{{ $product->getTitle() }}</h3>
            <div class="d-flex flex-row">
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
            </div>
            <div class="d-flex">
                <h3>{{ $genralSetting->getCurrency() }} {{ $product->price() }}</h3>
            </div>
        </a> --}}
        </div>
    </div>
@endif
