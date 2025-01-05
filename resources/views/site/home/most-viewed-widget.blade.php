@php
    $bestSellers=app()->make(\App\Repositories\ItemRepository::class)->getMostViewedProducts();
    $currency=app()->make(\App\Repositories\GenralSettingRepository::class)->getCurrency();
@endphp
<div class="product-list mys">
    <h3 class="product-list__title">تسوق الان</h3>
    <div class="product-list__wrapper">
        @foreach($bestSellers??[] as $index=>$product)
            @include('site.home.product-type-3-widget')
        @endforeach
    </div>
</div>
