@php
 $subCategories=app()->make(\App\Repositories\MainCategoriesRepository::class)->getSub($id);
    // dd($mainCategories);
@endphp
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
<div class="container mt-10 category-section">
    <h1 class="section-name ">{{ __('Shop By Category') }}</h1>
    <div class="row">
        <div class="col-lg-3">
            <div class="side-bar p-3">
                <h3>@langucw('category')</h3>

                @php
                $mainCategories=app()->make(\App\Repositories\MainCategoriesRepository::class)->get();
                
               @endphp

                <div class="d-flex flex-column mt-3">
                    @foreach($mainCategories as $category)
                    <label  class="category-items-checkbox">
                        <a href="{{ route('subshop', $category->id) }}" class="sub-item-link "  >
                        <span class=""  >{{$category->getName()}}</span>
                        </a>
                        {{-- <input type="radio" name="categories" id="cat_01" /> --}}
                        {{-- <div class="checkmark"></div> --}}
                    </label>
                    @endforeach
                
                </div>



            </div>
        </div>
        <div class="col-8 row">
            @foreach ($subCategories as $item)
            <a data-aos="fade-down" href="{{ route('products.index', [$item->CatID,  $item->id]) }}" class="col-md-4 col-12">
                <div class="cat2">
                <div class="cccccc aaa item position-relative d-flex align-items-center justify-content-between ">
                    <img src="{{$item->getFirstMediaUrl('categories','large')??''}}" class="d-flex m-auto" />
                </div>
                <h3 class="mt-3 text-center">{{ $item->getName() }}</h3>
                </div>
            </a>
            @endforeach
            
         
        </div>

    </div>
</div>

@endsection