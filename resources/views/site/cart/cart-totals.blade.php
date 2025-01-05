<div class="col-lg-4 col-12 mb-30">
    <div class="cart-totals card" style=" border-radius: 10px;">
        <div class="cart-totals-inner p-3">
            <h4 class="title">@langucw('اجمالي السلة')</h4>
            
                @php
                    $total=app()->make(\App\Repositories\CartRepository::class)->getTotalPrice($carts??[]);
                @endphp
                <div class="total-cll">
                    <span class="title">@langucw('المجموع الفرعي')</span>
                    
                    <span>{{$genralSetting->getCurrency()}}<span class="subtotal_amount">
                        {{(float)$total}}
                     </span></span>
                </div>

        </div>

        @if(auth()->user())
            <button type="button" onclick="nextRoute('{{Route('shipping_info.index')}}')"    class="dropdown-item checkout-button p-2">@langucw('الدفع')</button>
        @else
            <a href="{{Route('login')}}"    class="dropdown-item checkout-button p-2">@langucw('login')</a>
        @endif
    </div>
</div>
