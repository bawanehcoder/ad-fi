<div class="offadd">
    <div id="message"></div>

    <form id="mufor" method="POST" >
        <div class="modal-body m-2 mar-right-10 mar-left-10">
            <input type="hidden" id="id_hidden" name="id" value="">
            @csrf
            <div class="col-12">
                {{-- Title --}}
                <div class="form-group row">

                    <div class="col-12">
                        <input type="text" class="form-control" id="title" name="title"
                            value='{{ old('title') }}' required placeholder="@langucw('title')" />
                    </div>
                </div>
                {{-- name --}}
                <div class="form-group row">

                    <div class="col-12">
                        <input type="text" class="form-control" id="name" name="name"
                            value='{{ old('name') }}' placeholder="{{ trans('general.name') }}" />
                    </div>
                </div>





                <div class="form-group row">
                    <div class="select-wrapper w-50 col">
                        <select class="form-field" id="zone" name="zone">
                            @foreach ($zones ?? [] as $index => $zone)
                                <option value="{{ $zone->id }}">{{ $zone['Addres' . getLang()] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Phone --}}
                <div class="form-group row">
                    <div class="col-12">
                        <input type="text" class="form-control" id="phone" name="phone"
                            value='{{ old('phone') }}' placeholder="@langucw('phone')" />
                    </div>
                </div>
                {{-- shipping info --}}
                <div class="form-group row">
                    <div class="col-12">
                        <textarea rows="10" class="form-control" id="shipping_info_text" name="shipping_info"
                            placeholder="@langucw('shipping info')">{{ old('shipping_info') }}</textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <div class="row">

                <div class="col-12">
                    <button type="submit" id="addaddress" class="btn btn-primary ">{{ trans('general.save') }}</button>
                </div>

            </div>


        </div>
    </form>
</div>
