

@if($coupona_active==='effective')
<div class="checkout-box">



    <div class="row">
        <div class="col">
            <label>@langucw('your points balance')</label>
            <input disabled class="form-field" type="text" value="{{ $totalpoint }}">
        </div>
        {{-- <div class="col">
            <label>@langucw('points you want to replace')</label>
            <div class=" ms-11 mt-2">
                @include('components.btn-number', [
                    'id' => 1,
                    'quantity' => 0,
                    'min' => 0,
                    'max' => $totalpoint,
                ])
            </div>
        </div> --}}
    </div>
    <br/>

    <h4 class="mb-4">@langucw('coupon code')</h4>

    <div class="input-group">
        <input type="text" class="form-control" name="coupon_code" id="coupon_code"
               placeholder="@langucw('do you have a coupon code? Enter it here')" required="">

               <button class="btn btn-dark btn-primary-hover rounded-0 mt-6" id="coupon-apply" onclick="couponCode()">@langucw('apply')</button>
        </div>
        <div id="coupon_discount"></div>

<div class="col-sm-12">
            <label>@langucw('notes')</label>
            <textarea class="form-control" name="notes" id="notes_textarea" placeholder="@langucw('notes')">{{ old('notes') }}</textarea>
        </div>
</div>
@endif
