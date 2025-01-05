@php
    $mainCategories = app()
        ->make(\App\Repositories\MainCategoriesRepository::class)
        ->get();

@endphp


<div class="sidebar ">
    <ul>
        @if($main_category)
        @foreach ($main_category->subCategory() as $category)
            <li><input class="form-check-input" type="checkbox" /> <label>
                   
                        <span class="filter-form sidebar-item-title" main_category="{{$main_category->id??null}}" sub_category="{{ $category->id }}">
                            {{ $category->getName() }}
                        </span>
                    
                </label></li>
        @endforeach
        @else
        @foreach ($mainCategories as $category)
            <li><input class="form-check-input" type="checkbox" /> <label>
                   
                        <span class="filter-form sidebar-item-title" main_category="{{ $category->id ?? null }}">
                            {{ $category->getName() }}
                        </span>
                    
                </label></li>
        @endforeach
        @endif
        

    </ul>
</div>


{{-- @if ($main_category)

    @foreach ($main_category->subCategory() as $category)
        @php
            // dd($category->getName());
        @endphp
        <label data-aos="fade-right" class="category-items-checkbox">
            <a class="sub-item-link ">
                <span class="filter-form sidebar-item-title" main_category="{{ $main_category->id ?? null }}"
                    sub_category="{{ $category->id }}">{{ $category->getName() }}</span>
            </a>
            <input type="radio" name="categories" id="cat_01" />
            <div class="checkmark"></div>
        </label>
    @endforeach
@else
    <div class="d-flex flex-column mt-3">
        @foreach ($mainCategories as $category)
            <label class="category-items-checkbox">
                <a class="sub-item-link ">
                    <span class="filter-form sidebar-item-title"
                        main_category="{{ $category->id ?? null }}">{{ $category->getName() }}</span>
                </a>
                <input type="radio" name="categories" id="cat_01" />
                <div class="checkmark"></div>
            </label>
        @endforeach

    </div>
@endif --}}
