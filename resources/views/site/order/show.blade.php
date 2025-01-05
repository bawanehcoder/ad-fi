@extends('site.layout.master')
@section('title')
    @langucw('my order')
@endsection
@section('css') @endsection
@section('breadcrumb')

    <li><a href="{{route('home')}}">@langucw('home')</a></li>
    <li><a href="{{route('myprofile.index')}}">@langucw('my account')</a></li>
    <li>@langucw('my order')</li>
    <li>@langucw('show')</li>

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
            <span class="step-icon active">
                <svg width="28" height="22" viewBox="0 0 28 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.5 19.25V11H27.5V19.25C27.5 20.5156 26.4688 21.5 25.25 21.5H2.75C1.48438 21.5 0.5 20.5156 0.5 19.25ZM9.5 16.0625V17.9375C9.5 18.2656 9.73438 18.5 10.0625 18.5H16.4375C16.7188 18.5 17 18.2656 17 17.9375V16.0625C17 15.7812 16.7188 15.5 16.4375 15.5H10.0625C9.73438 15.5 9.5 15.7812 9.5 16.0625ZM3.5 16.0625V17.9375C3.5 18.2656 3.73438 18.5 4.0625 18.5H7.4375C7.71875 18.5 8 18.2656 8 17.9375V16.0625C8 15.7812 7.71875 15.5 7.4375 15.5H4.0625C3.73438 15.5 3.5 15.7812 3.5 16.0625ZM27.5 2.75V5H0.5V2.75C0.5 1.53125 1.48438 0.5 2.75 0.5H25.25C26.4688 0.5 27.5 1.53125 27.5 2.75Z" fill="white"/>
                    </svg>
                    
                    
            </span>
            <span class="step-title">طريقة الدفع</span>
        </div><!-- /.step -->


        <div class="step">
            <span class="step-icon active">
                <svg width="25" height="34" viewBox="0 0 25 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.875 1.25C23.5625 0.75 24.5 1.1875 24.5 2V32C24.5 32.875 23.5 33.3125 22.875 32.8125L20.5 30L17.0625 32.8125C16.875 32.9375 16.6875 33.0625 16.4375 33.0625C16.25 33.0625 16.0625 32.9375 15.875 32.8125L12.5 30L9.0625 32.8125C8.875 32.9375 8.6875 33.0625 8.4375 33.0625C8.25 33.0625 8.0625 32.9375 7.875 32.8125L4.5 30L2.0625 32.8125C1.4375 33.3125 0.5 32.875 0.5 32V2C0.5 1.1875 1.4375 0.75 2.0625 1.25L4.5 4L7.875 1.25C8.0625 1.125 8.25 1 8.5 1C8.6875 1 8.875 1.125 9.0625 1.25L12.5 4L15.875 1.25C16.0625 1.125 16.25 1 16.5 1C16.6875 1 16.875 1.125 17.0625 1.25L20.5 4L22.875 1.25ZM20.5 23.5V22.5C20.5 22.25 20.25 22 20 22H5C4.6875 22 4.5 22.25 4.5 22.5V23.5C4.5 23.8125 4.6875 24 5 24H20C20.25 24 20.5 23.8125 20.5 23.5ZM20.5 17.5V16.5C20.5 16.25 20.25 16 20 16H5C4.6875 16 4.5 16.25 4.5 16.5V17.5C4.5 17.8125 4.6875 18 5 18H20C20.25 18 20.5 17.8125 20.5 17.5ZM20.5 11.5V10.5C20.5 10.25 20.25 10 20 10H5C4.6875 10 4.5 10.25 4.5 10.5V11.5C4.5 11.8125 4.6875 12 5 12H20C20.25 12 20.5 11.8125 20.5 11.5Z" fill="white"/>
                    </svg>
                    
                    
                    
            </span>
            <span class="step-title">الفاتورة</span>
        </div><!-- /.step -->
    </div>
</div>

    <div class="container mt-5">
        @include('components.messagesAndErrors')
    <div class="row pad-md-100">
        <div class="col">
            <div class=" ">
                <div class="o-d">

                    <h3>{{ trans('تفاصيل الطلب')}}</h3>

                    <table class="odd-d">
                        <tr>
                            <td width="50%">@langucw('رقم الطلب')</td>
                            <td>{{$entity->id}}</td>
                        </tr>
                        <tr>
                            <td width="50%">@langucw('طريقة الدفع')</td>
                            <td>{{$entity->PaymentMethod}}</td>
                        </tr>

                        <tr>
                            <td width="50%">@langucw('العنوان')</td>
                            <td>
                                {{$entity->delivery_type == 'personal_pickup' ? __('branch pickup') . " : " . $entity->branch['Addres' . getLang()] : $entity->zone['Addres' . getLang()]}}

                            </td>
                        </tr>

                        <tr>
                            <td width="50%">@langucw('الاسم')</td>
                            <td>{{$entity->Name}}</td>
                        </tr>

                        <tr>
                            <td width="50%">@langucw('رقم الهاتف')</td>
                            <td>{{$entity->Phone}}</td>
                        </tr>

                        <tr>
                            <td width="50%">@langucw('وقت التوصيل')</td>
                            <td>{{$entity->DeliveryTime}} {{getDayNames($entity->DeliveryTime)}}</td>
                        </tr>
                    </table>
              
                    

                </div>
                <div class="card-body">
                    <table class="odd-d">
                        <thead>
                        <tr>
                            <th >#</th>
                            <th >@langucw('المنتج')</th>
                            <th >@langucw('السعر')</th>
                            <th >@langucw('الكميه')</th>
                            <th >@langucw('المجموع')</th>
                            <th >@langucw('ملاحضات')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $subtotal=0;



                        @endphp
                        @foreach($entity->order_details??[] as $index=>$item)

                            <tr>
                                <td >{{$index}}</td>
                                <td >{{$item->item->getTitle()}} ({{$item->item->price()}})

                                    @if($item->optionDetil())
                                        @foreach($item->optionDetil()->get()??[] as $option)
                                            <br>
                                            {{$option->subOption->getTitle()}} ({{$option->AdditionalValue}})

                                        @endforeach
                                    @endif


                                    {{--                                    <br> {{$item->optionDetil?$item->optionDetil->subOption->getTitle():''}}--}}

                                </td>
                                <td >{{number_format((float)($item->Price), 2, '.', '')}} {{$currency}}</td>
                                <td >{{$item->Quantity}} </td>
                                @php $subtotal+=$item->Price*$item->Quantity; @endphp
                                <td >{{number_format((float)($item->Price*$item->Quantity), 2, '.', '')}} {{$currency}}</td>
                                <td >{{$entity->Note}} </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" >@langucw('المحموع الفرعي')</td>
                            <td style="border: none;" class="chart-center subtotal"><span
                                    id="subtotal">{{number_format((float)$subtotal, 2, '.', '')}}</span> {{$currency}}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" >@langucw('رسوم التوصيل')</td>
                            <td style="border: none;" class="chart-center subtotal"><span
                                    id="subtotal">{{number_format((float)$entity->ZonePrice, 2, '.', '')}}</span> {{$currency}}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" >{{trans('الخصم')}}</td>
                            <td style="border: none;" class="chart-center subtotal"><span
                                    id="subtotal">{{number_format((float)$entity->Discount, 2, '.', '')}}</span> {{$currency}}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" ></td>
                            <td style="border: none;" >@langucw('المحموع الكلي')</td>
                            <td style="border: none;" class="chart-center subtotal"><span
                                    id="subtotal">{{number_format((float)$entity->Total, 2, '.', '')}}</span> {{$currency}}
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>


@endsection
@section('scripts')

@endsection
