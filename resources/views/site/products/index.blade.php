@extends('site.layout.master')
@section('title')
    {{ trans('general.products') }}
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li>@langucw('Product') </li>
@endsection
@section('content')

<div class="container main-wrapper">
    <div class="row">
        <div class="col-md-3">
            @include('site.products.sidebars-widget-category')
            
        </div>
        <div class="col-md-9">
            <div class="main-content">
                <!-- العنوان في قسم منفصل -->
                <div class="section-title-container">
                    <h2 class="section-title">
                        @if($main_category)
                            {{ $main_category->Name }}
                        
                        @else 
                            كل المنتجات
                        @endif
                    </h2>
                </div>

                <div class="product-cards row">
                    @include('site.products.index-block')
                   

                </div>
            </div>
        </div>
    </div><!--row-->
</div>


@endsection

@push('scripts')
    <script></script>
@endpush
