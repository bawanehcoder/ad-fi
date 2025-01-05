<div class="modal  fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-body2">

                <form method="POST" action="{{ route('shipping_info.save') }}">
                    <input type="hidden" id="id_hidden" name="id" value="">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" id="title" name="title"
                            value='{{ old('title') }}' placeholder="@langucw('title')" />
                    </div>



                    <div class="mb-3">
                        <input type="text" class="form-control" id="name" name="name"
                                           value='{{ old('name')  }}' placeholder="{{trans('general.name')}}"/>
                    </div>



                    <div class="mb-3">
                        <select class="form-control"  id="zone" name="zone">
                            @foreach($zones??[] as $index=>$zone)
                                <option value="{{$zone->id}}">{{$zone['Addres'.getLang()]}}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="mb-3">
                        <input type="text" class="form-control" id="phone" name="phone"
                        value='{{ old('phone')  }}' placeholder="@langucw('phone')"/>
                    </div>



                    <div class="mb-3">
                        <textarea rows="10" class="form-control" id="shipping_info_text"
                        name="shipping_info"
                        placeholder="@langucw('shipping info')">{{ old('shipping_info')  }}</textarea>
                    </div>


                
            </div>
            <button type="submit" class="button button-primary"> حفظ</button>
            </form>





            
            
        </div>

    </div>
</div>
</div>
