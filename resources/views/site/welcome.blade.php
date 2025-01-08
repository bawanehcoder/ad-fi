@extends('site.layout.master')
@section('title')
@endsection
@section('css')
@endsection
@section('breadcrumb')
@endsection
@php $home='home'; @endphp
@section('content')
    <section class="home-slider">
        <div class="main-slider">
            @foreach ($sliders as $slider)
                <div class="slider-item">
                    <img src="{{ asset($slider->getFirstMediaUrl('slider', 'full')) }}" alt="Slide 1" class="img-fluid" />
                    <div class="slider-content">
                        <img src="{{ asset('asset-files/imgs/slider/logo.gif') }}" alt="" class="slider-logo">
                        <h1>{{ $slider->title }}</h1>
                        <p>{{ $slider->url }}</p>
                        <a href="{{ route('mainshop') }}" class="slider-btn btn btn-pink">تسوقgالان </a>
                    </div>
                    <img src="{{ asset($slider->getFirstMediaUrl('layer1', 'full')) }}" alt=""
                        data-aos="fade-up-right" data-aos-duration="1000" class="layer1 slide-layer">
                    <img src="{{ asset($slider->getFirstMediaUrl('layer2', 'full')) }}" alt=""
                        data-aos="fade-down-left" data-aos-duration="1000" class="layer2 slide-layer">
                    <img src="{{ asset($slider->getFirstMediaUrl('layer3', 'full')) }}" alt=""
                        data-aos="fade-down-right" data-aos-duration="1000" class="layer3 slide-layer">
                </div>
            @endforeach
        </div>
    </section>

    <section class="intro">
        <span data-aos="fade-up">
            لا تضيع مناسبة بنوصلك وين ما كنت
        </span>
    </section>

    <section class="about">
        <div class="container">
            <div class="row ccenter">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-6 c-align" data-aos="fade-up">
                            <img src="{{ asset('asset-files/imgs/about/1.png') }}" class="img-fluid" />
                        </div>
                        <div class="col-6" data-aos="fade-down">
                            <img src="{{ asset('asset-files/imgs/about/2.png') }}" class="img-fluid" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6" data-aos="fade-right">
                    <h3 class="outheadein">
                        <span class="hh"></span>
                        ماذا عنا
                    </h3>
                    <p>
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث
                        يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
                        التطبيق.
                    </p>
                    <a href="{{ route('mainshop') }}" class="slider-btn btn btn-pink">تسوق الان </a>
                </div>
            </div>
        </div>
    </section>

    <section class="cats">
        <div class="container">
            <h3 class="outheadein">الاقسام</h3>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                        type="button" role="tab" aria-controls="home" aria-selected="true">داخل الاردن</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                        role="tab" aria-controls="profile" aria-selected="false">خارج الاردن</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="maincat">
                        @php
                            $mainCategories = app()
                                ->make(\App\Repositories\MainCategoriesRepository::class)
                                ->getByType('inside');
                            $i = 0;
                        @endphp
                        @foreach ($mainCategories as $item)
                            @if ($i == 0)
                                <div class="halfcat">
                            @endif
                            <a data-aos="fade-down" href="{{ route('products.index', ['rtype'=> $item->rtype ,'entity' => $item->id]) }}" class="maincatitem">
                                <div class=" aaa item position-relative d-flex align-items-center justify-content-between ">
                                    <img src="{{ $item->getFirstMediaUrl('categories') ?? '' }}" class="d-flex m-auto img-fluid" />
                                </div>
                            </a>
                            @if ($i == 2)
                    </div>
                    @endif
                    @php
                        $i++;
                        if ($i == 3) {
                            $i = 0;
                        }
                    @endphp
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="maincat">
                    @php
                        $mainCategories = app()
                            ->make(\App\Repositories\MainCategoriesRepository::class)
                            ->getByType('outside');
                        $i = 0;
                    @endphp
                    @foreach ($mainCategories as $item)
                        @if ($i == 0)
                            <div class="halfcat">
                        @endif
                        <a data-aos="fade-down" href="{{ route('subshop', $item->id) }}" class="maincatitem">
                            <div class=" aaa item position-relative d-flex align-items-center justify-content-between ">
                                <img src="{{ $item->getFirstMediaUrl('categories') ?? '' }}" class="d-flex m-auto img-fluid" />
                            </div>
                        </a>
                        @if ($i == 2)
                </div>
                @endif
                @php
                    $i++;
                    if ($i == 3) {
                        $i = 0;
                    }
                @endphp
                @endforeach
            </div>
            </div>

        </div>
    </section>

    <section class="cards">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="homecars">
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('asset-files/imgs/cards/1.png') }}" class="img-fluid" />
                            </div>
                            <div class="col-10">
                                <h5>توصيل مجاني</h5>
                                <span>أستمتع بالتوصيل السريع والمجاني</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="homecars">
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('asset-files/imgs/cards/2.png') }}" class="img-fluid" />
                            </div>
                            <div class="col-10">
                                <h5> منتجات فريش</h5>
                                <span>جميع المنتجات فريش</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="homecars">
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('asset-files/imgs/cards/3.png') }}" class="img-fluid" />
                            </div>
                            <div class="col-10">
                                <h5>مصنوع بحب</h5>
                                <span>أستمتع بالتوصيل السريع والمجاني</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('site.home.most-viewed-widget')

    <section class="download">
        <div class="container">
            <h3 class="">تحميل التطبيق</h3>
            <div class="dlinks">
                <img src="{{ asset('asset-files/imgs/a.png') }}" />
                <img src="{{ asset('asset-files/imgs/g.png') }}" />
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection
