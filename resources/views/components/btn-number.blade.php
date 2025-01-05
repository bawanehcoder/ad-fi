<div class="quantity">
     <div class="btns-plus">
         <button att="{{$id}}" class="mins"  data-field="qty[{{$id}}]">-</button>
         <button att="{{$id}}" class="plus"  data-field="qty[{{$id}}]">+</button>
     </div>
     <input att="{{$id}}" type="text" value="{{ $quantity }}" class="input-number"  name="qty" id="qty-{{$id}}" min="{{$min??1}}" max="{{$max??1000}}">
 </div>