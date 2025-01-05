<div id="billing-form">
    <h4 class="mb-4">@langucw('billing address')

    </h4>
    <div class="row row-cols-sm-2 row-cols-1 g-4">
        <div class="col">
            <label>{{ trans('general.name') }}</label>
            <input class="form-control" type="text" name="name" id="name_input" value='{{ old('name') ?? $entity?->name }}'
                placeholder="{{ trans('general.name') }}" >
        </div>
        <div class="col">
            <label>@langucw('phone number')</label>
            <input class="form-control" type="text" id="phone_number" name="phone_number"
                value='{{ old('phone_number') ?? $entity?->phone }}' placeholder="@langucw('phone number')" >
        </div>
        <div class="col">
            <label>@langucw('Adress')</label>
            <input class="form-control" type="text" id="addresstext" name="addresstext"
                value='{{ old('phone_number') ?? $entity?->addresstext }}' placeholder="@langucw('address')" >
        </div>
        <div class="col">
            <label>@langucw('address')</label>
            <div class="select-wrapper">
                {{-- <input class="form-control" type="hidden" id="address" name="address"
                    value='{{ old('zone_id') ?? $entity?->id }}' placeholder="@langucw('phone number')" >
                @php
                    $zone =  0; // \App\Models\Zones::find($entity?->zone_id);
                    $price_de =0; //\App\Transformers\ZonesTransformer::getDelivery($zone);

                @endphp --}}
                {{-- <input class="form-control" type="text" id="addresstext" name="addresstext"
                    value=''
                    placeholder="@langucw('phone number')" > --}}

                <select class="form-control" id="address" name="address" >
                <option disabled selected>Select</option>
                @foreach (\App\Models\Zones::select('*')->get() as $index => $zone)
                    @php

                        if(isset($delivery_free) && $delivery_free){
                            $price_de=0;
                            }else if($conditional_deliverie??false!=false){
                                if(count($conditional_deliverie['zones'])<1){
                                    $price_de=$conditional_deliverie['delivery'];
                                }else if(in_array($zone->id, $conditional_deliverie['zones'])){

                                     $price_de=$conditional_deliverie['delivery'];
                                }else{
                                    $price_de=\App\Transformers\ZonesTransformer::getDelivery($zone);
                                }
                        }else{
                            $price_de=\App\Transformers\ZonesTransformer::getDelivery($zone);
                        }

                    @endphp
                    <option {{$zone->id==$entity->zone_id?'selected':''}} att_prise="{{$price_de}}" value="{{$zone->id}}">{{$zone['Addres'.getLang()]}}| {{number_format((float)$price_de, 2, '.', '')}}</option>
                @endforeach
            </select>
            </div>
        </div>
        <div class="col">
            <label>@langucw('place')</label>
            <input class="form-control" type="text" id="place" name="place"
                value='{{ old('address') ?? $entity->address }}' placeholder="@langucw('place')" >
        </div>

        <div class="col">
            <label>@langucw('delivery time')</label>
            <input class="form-control flatpickr-input" type="datetime-local" value="{{ old('delivery_time') }}" name="delivery_time" />
        </div>


        {{-- <div class="col-md-12">
            <div class="col-sm-12 d-flex flex-wrap gap-6">
                <div class="form-check m-0">
                    <input class="form-check-input" type="checkbox" id="shiping_address"
                        data-toggle-shipping="#shipping-form">
                    <label class="form-check-label" for="shiping_address">@langucw('branch pickup')</label>
                </div>
            </div>
    
            <div id="shipping-form" class="mt-md-8 mt-6">
                <label>@langucw('address')</label>
                <div class="select-wrapper">
                    <select class="form-control" id="branch_pickup_s" name="branch_pickup_s">
                        @foreach (\App\Models\Branche::select('*')->get() as $index => $branch)
                            <option value="{{ $branch->id }}">{{ $branch->getTitle() }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div> --}}








        



        <div class="col-md-12">


            <h4 class="mb-4">@langucw('payment method')</h4>

            <div class="checkout-payment-method">
                <div class="single-method form-check">
                    <input checked  {{$special==1?'disabled ':''}}  value="cash_on_delivery" class="form-check-input" type="radio" id="payment_type1" name="payment-method">
                    <label class="form-check-label" for="payment_type1">@langucw('cash on delivery')</label>
                    <p>@langucw('الدفع عن الاستلام')</p>
                </div>
        
                <div class="single-method form-check">
                    <input disabled  value="payment_by_credit_card" class="form-check-input" type="radio" id="payment_type2" name="payment-method">
                    <label class="form-check-label" for="payment_type2">@langucw('Payment by credit card')</label>
                    <p>@langucw('الدفع اونلاين')</p>
                </div>
        
                
        
            </div>
        



        </div>
        

        
        
        

    </div>

</div>

