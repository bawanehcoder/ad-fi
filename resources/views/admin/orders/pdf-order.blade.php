<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>

    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>
    <title></title>
    <meta name="generator" content="https://conversiontools.io" />
    <meta name="author" content="user"/>
    <meta name="created" content="2024-01-14T06:27:32"/>
    <meta name="changedby" content="user"/>
    <meta name="changed" content="2024-01-14T07:04:02"/>
    <meta name="AppVersion" content="16.0300"/>
    <meta name="DocSecurity" content="0"/>
    <meta name="HyperlinksChanged" content="false"/>
    <meta name="LinksUpToDate" content="false"/>
    <meta name="ScaleCrop" content="false"/>
    <meta name="ShareDoc" content="false"/>

    <style type="text/css">
        body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
        a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  }
        a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  }
        comment { display:none;  }
    </style>
<script type="application/javascript">
    function printJS(){
        alert()
    }
</script>
</head>

<body>
<button type="button" onclick="printJS()">
    Print PDF with Message
</button>
<table cellspacing="0" border="0">
    <colgroup width="123"></colgroup>
    <colgroup width="146"></colgroup>
    <colgroup width="64"></colgroup>
    <colgroup width="109"></colgroup>
    <colgroup width="197"></colgroup>
    <colgroup width="69"></colgroup>
    <colgroup width="142"></colgroup>
    <colgroup width="137"></colgroup>
    <colgroup width="64"></colgroup>
    <colgroup width="95"></colgroup>
    <colgroup width="64"></colgroup>
    <tr>
        <td  height="19" align="center" valign=middle><font color="#000000">{{trans('general.name')}} : </font></td>
        <td align="center" valign=middle><font color="#000000">{{$entity->Name}}</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000">@langucw('order number')</font></td>
        <td align="center" valign=middle><font color="#000000">{{$entity->id}}</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000">@langucw('payment method')</font></td>
        <td align="center" valign=middle><font color="#000000">{{$entity->PaymentMethod}}</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000">@langucw('address')</font></td>
        <td align="center" valign=middle><font color="#000000">{{  $entity->delivery_type  =='personal_pickup'? __('branch pickup') ." : ". $entity->branch['Addres'.getLang()] :$entity->zone['Addres'.getLang()] }}</font></td>
    </tr>
    <tr>
        <td colspan=11 height="19" align="center" valign=bottom><font color="#000000"><br></font></td>
    </tr>
    <tr>
        <td height="19" align="center" valign=middle><font color="#000000">@langucw('phone number')</font></td>
        <td align="center" valign=middle><font color="#000000">{{$entity->Phone}}</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000">@langucw('delivery time')</font></td>
        <td align="center" valign=middle><font color="#000000">{{__(getDayNames($entity->DeliveryTime))}}</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>

    <tr>
        <td colspan=13 height="19" align="center" valign=middle><font color="#000000">Order Details</font></td>
    </tr>

    <tr>
        <td height="19" align="center" valign=middle><font color="#000000">#</font></td>
        <td align="center" valign=middle><font color="#000000">@langucw('product')</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000">@langucw('price')</font></td>
        <td align="center" valign=middle><font color="#000000">@langucw('quantity')</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000">@langucw('total')</font></td>
        <td align="center" valign=middle><font color="#000000">@langucw('notes')</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000">@langucw('special image')</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
           <td align="center" valign=middle><font color="#000000">{{trans('general.operator')}}</font></td>
                <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>
    @php $subtotal=0; @endphp

    @foreach($entity->order_details??[] as $index=>$item)
    <tr>
        <td height="19" align="center" valign=middle sdval="1" sdnum="1033;"><font color="#000000">{{$index}}</font></td>
        <td align="center" valign=middle sdval="11111" sdnum="1033;"><font color="#000000">{{$item->item->getTitle()}} ({{$item->item->Price}})
                @if($item->optionDetil())
                    @foreach($item->optionDetil()->get()??[] as $option)

                        {{$option->subOption->getTitle()}} ({{$option->AdditionalValue}})
                    @endforeach
                @endif

            </font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle sdval="11111" sdnum="1033;"><font color="#000000">{{number_format((float)($item->Price), 2, '.', '')}} </font></td>
        <td align="center" valign=middle sdval="11111" sdnum="1033;"><font color="#000000">{{$item->Quantity}}</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        @php $subtotal+=$item->Price*$item->Quantity; @endphp
        <td align="center" valign=middle sdval="1111" sdnum="1033;"><font color="#000000">{{number_format((float)($item->Price*$item->Quantity), 2, '.', '')}} </font></td>
        <td align="center" valign=middle sdval="1111" sdnum="1033;"><font color="#000000">{{$item->Note}} </font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle sdval="1111" sdnum="1033;"><font color="#000000">
                @foreach($operators ??[] as $operator)
                    @if(in_array($operator->id,$item->item->getOperator()))
                        {{$operator->name_ar}}  | {{$operator->name_en}}
                        <br>
                    @endif

                @endforeach

            </font></td>
        <td align="center" valign=middle sdval="1111" sdnum="1033;"><font color="#000000"><img class="thumbnail"  src="{{asset($item->getFirstMediaUrl('images','small'))??''}}"></font></td>


        <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>
    @endforeach
    <tr>
        <td height="19" align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><font color="#000000"><br></font></td>
        <td align="left" valign=bottom><font color="#000000"><br></font></td>
    </tr>
    <tr>
        <td height="19" align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>
    <tr>
        <td height="19" align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="left" valign=middle><font color="#000000">Subtotal</font></td>
        <td align="center" valign=middle><font color="#000000">16.00 JOD</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>
    <tr>
        <td height="19" align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="left" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>
    <tr>
        <td height="19" align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="left" valign=middle><font color="#000000">Delivery Fee</font></td>
        <td align="center" valign=middle sdval="33333" sdnum="1033;"><font color="#000000">33333</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>
    <tr>
        <td height="19" align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="left" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>
    <tr>
        <td height="19" align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="left" valign=middle><font color="#000000">Discount</font></td>
        <td align="center" valign=middle sdval="55555" sdnum="1033;"><font color="#000000">55555</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>
    <tr>
        <td height="19" align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="left" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>
    <tr>
        <td height="19" align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="left" valign=middle><font color="#000000">Total Amount</font></td>
        <td align="center" valign=middle sdval="55555" sdnum="1033;"><font color="#000000">55555</font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
        <td align="center" valign=middle><font color="#000000"><br></font></td>
    </tr>
</table>
<!-- ************************************************************************** -->
</body>

</html>
