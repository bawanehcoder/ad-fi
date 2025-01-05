<div class="checkout-box">

    <h4 class="mb-4">{{ __('المجموع') }}</h4>

    <table class="">
        <thead>
            <tr>
                <th>{{ __('المنتج') }}</th>
                <th>{{ __('المجموع الفرعي') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carts ?? [] as $index => $cart)
                <tr>
                    <td>
                        {{ $cart->item->getTitle() }} ({{ $cart->item->price() }}) * {{ $cart->quantity }}
                        @if ($cart->optionDetil())
                            @foreach ($cart->optionDetil()->get() ?? [] as $option)
                                <br>
                                {{ $option->subOption->getTitle() }} ({{ $option->AdditionalValue }})
                            @endforeach
                        @endif
                    </td>
                    @php
                        $price = $cart->optionDetil() ? $cart->price : $cart->price;
                    @endphp
                    <td>{{ number_format((float) ($price * $cart->quantity), 2, '.', '') }} {{ $currency }}</td>
                </tr>
                @php
                    $subtotal += $price * $cart->quantity;
                    $discount += \App\Services\DiscountService::getDiscountByItemFromCart($cart);

                @endphp
            @endforeach


            
            <tr style="border-top:1px solid #ddd;margin-top:20px">
                <td class="border-top">@langucw('المجموع الفرعي')</td>
                <td class="border-top"><span id="subtotal">{{ number_format((float) $subtotal, 2, '.', '') }}</span>
                    {{ $currency }}</td>
            </tr>
            <tr>
                <td class="border-top">@langucw('سعر التوصيل')</td>
                <td class="border-top">
                    <span id="delivery_price">{{ $delivery_price }}</span> {{ $currency }}
                </td>
            </tr>
            <tr>
                <td class="border-top">{{ trans('خصومات') }}</td>
                <td class="border-top">
                    <span id="discount">{{ number_format((float) $discount, 2, '.', '') }}</span> {{ $currency }}
                </td>
            </tr>
            <tr>
                <td class="border-top">@langucw('النقاط')</td>
                <td class="border-top">
                    <span id="points">{{ number_format((float) $point_price, 2, '.', '') }}</span>
                    {{ $currency }}
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th class="border-top">@langucw('المجموع')</th>
                <th class="border-top">
                    <span
                        id="total">{{ number_format((float) ($subtotal - $discount + $delivery_price), 2, '.', '') }}</span>
                    {{ $currency }}
                </th>
            </tr>
        </tfoot>
    </table>

</div>
