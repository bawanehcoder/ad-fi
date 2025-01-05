    @if(count($carts)>0)
        <table id="table" class="ourcart">
            <thead>
            <tr class="no-bor-top">
                <th scope="col" width="30">&nbsp;</th>

                <th scope="col">@langucw('الصوره')</th>
                <th scope="col">@langucw('أسم الصنف')</th>
                <th scope="col">@langucw('السعر')</th>
                <th scope="col">@langucw('الكميه')</th>
                <th scope="col">@langucw('المحموع')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($carts??[] as $index=>$cart)
                @if($cart->item)
                    <tr>
                        <td>
                            <span style="cursor:pointer" onclick="deleteItem('{{route('cart.delete',$cart)}}')">x</span>
                        </td>
                       
                        <td>
                            <div class=""><img
                                        alt="Cake-one" class="full-image"
                                        src="{{asset($cart->item->getFirstMediaUrl('products', 'small'))}}"></div>
                        </td>
                        <td>
                            {{$cart->item->getTitle()}} ({{$cart->item->price()}})
                                @if($cart->optionDetil())
                                    @foreach($cart->optionDetil()->get()??[] as $option)
                                        <br>
                                        <span>{{$option->subOption->getTitle()}} ({{$option->AdditionalValue}})</span>
                                    @endforeach
                                @endif
                           
                        </td>
                        @php
                            $price=    ($cart->optionDetil()?$cart->optionDetil()->sum('AdditionalValue'):$cart->price) ;

                        @endphp
                        <td>
                            <div class="price-product price-{{$cart->id}}">{{$price}}</div>
                        </td>
                        <td >

                            {{--    <div class="left-label">Quantity</div>--}}

                            @include('components.btn-number',['id'=>$cart->id,'quantity'=>$cart->quantity])

                           
                        </td>
                        <td>
                            <span
                                class="total total_{{$cart->id}}">{{ ($price*$cart->quantity)}}</span> {{$genralSetting->getCurrency()}}
                        </td>
                        
                            @if($cart->getFirstMediaUrl('images','large'))
                                <a class="img-product" target="_blank"
                                   href="{{asset($cart->getFirstMediaUrl('images','large'))??''}}?v={{now()}}"><img
                                        width="100px" height="100px" class="full-image"
                                        src="{{asset($cart->getFirstMediaUrl('images','small'))??''}}?v={{now()}}"></a>
                            @endif
                        </td>
                       
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif

