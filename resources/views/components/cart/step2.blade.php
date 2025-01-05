@php

    $subtotal = 0;
    $discount = 0;
    $points = 0;
    $point_price = 0;
    $delivery = $entity->zone_id ?? false;
    $delivery_type = 'delivery to the address';
    $totalpoint = getLogged()->totalPoints() ?? 0;
    $special = app()
        ->make(\App\Repositories\CartRepository::class)
        ->checkIsSpecialInCart();

@endphp
<div class="add">
    <h4>There are <span> 2 products</span> in your cart</h4>
    <h4 class="color">Billing Details</h4>
    <label>@langucw('Delivery Information')</label>
    <div class="input-group mb-3">

        <select type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username"
            aria-describedby="basic-addon2" id="select_address">
            <option selected disabled>Choose...</option>
            @foreach ($shipping_info as $item)
                <option 
                 _href="{{ route('payment.show_payment_form', $item) }}"
                    data-name="{{ $item->name }}" 
                    data-phone="{{ $item->phone }}" 
                    data-zone_id="{{ $item->zone_id }}" 
                    value="{{ $item->id }}">{{ $item->title }}</option>
            @endforeach

        </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" onclick="stepadd()" type="button">+</button>
        </div>
    </div>

   



    <small>
        Note: Delivery takes place at least 24 hours after the order is created , Please set your order date after 24
        hours
    </small>
    <a class="cc" onclick="nextNotFun()">@langucw('Continue')</a>

</div>
