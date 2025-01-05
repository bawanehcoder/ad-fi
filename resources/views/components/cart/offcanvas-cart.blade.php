@php
    $currency = app()
        ->make(\App\Repositories\GenralSettingRepository::class)
        ->getCurrency();
@endphp
<div id="cart_content">

    <div class="offcanvas-body" style="overflow: auto; max-height: 450px;">

        {{-- @if (count($carts ?? [])) --}}

            <ul class="offcanvas-cart-items">
                @php $subtotal=0; @endphp
                @foreach ($carts ?? [] as $cart)
                    @if ($cart->item)

                        <li>
                            <!-- Mini Cart Item Start  -->
                            <div class="mini-cart-item">
                                <a onclick="deleteItem('{{ route('cart.delete', $cart) }}')"
                                    class="mini-cart-item__remove">
                                    x</a>
                                <div class="mini-cart-item__thumbnail">
                                    <a href="{{ route('products.show', $cart->item) }}"><img width="60" height="88"
                                            src="{{ asset($cart->item->getFirstMediaUrl('products', 'small')) }}"
                                            alt="Cart"></a>
                                            {{-- {!! $cart->optionDetil() !!} --}}
                                </div>

                                @php
                                    $price =$cart->price;
                                    $subtotal += $price * $cart->quantity;
                                @endphp
                                <h3 style="display: none">
                                    <div class="price-product price-{{ $cart->id }}">{{ $price }}</div>
                                </h3>

                                <div class="mini-cart-item__content">
                                    <h6 class="mini-cart-item__title"><a
                                            href="{{ route('products.show', $cart->item) }}">{{ $cart->item->getTitle() }}</a>
                                    </h6>
                                    <span class="mini-cart-item__quantity total total_{{ $cart->id }}">
                                        {{ $price }}</span>
                                    @include('components.btn-number', [
                                        'id' => $cart->id,
                                        'quantity' => $cart->quantity,
                                    ])
                                </div>
                            </div>
                            <!-- Mini Cart Item End  -->
                        </li>
                    @endif
                @endforeach
            </ul>
        {{-- @endif --}}
    </div>
    @if (count($carts ?? []))
        <div class="offcanvas-footer d-flex flex-column gap-4">
            <!-- Mini Cart Total End  -->
            <div class="mini-cart-total">
                <strong class="label">@langucw('subtotal'):</strong>
                <strong class="value subtotal_amount">{{ $subtotal }} {{ $currency }}</strong>
            </div>
            <!-- Mini Cart Total End  -->

            <!-- Mini Cart Button End  -->
            <div class="mini-cart-btn d-flex flex-column gap-2">
                <a class="cc" onclick="steptow()">@langucw('Checkout')</a>
                <a class="" data-bs-dismiss="offcanvas">@langucw('Continue Shopping')</a>
            </div>
            <!-- Mini Cart Button End  -->

        </div>
    @else
        <div class="emy-cart">
            <img src="{{ asset('assets/c.svg') }}" />
            <h3 class="">{{ __('your cart is empty') }}</h3>
            <a class="cc" data-bs-dismiss="offcanvas">@langucw('Continue Shopping')</a>
        </div>
    @endif
</div>
