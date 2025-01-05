@extends('site.layout.master',['show_slider'=>false,'title'=>@langucw('our branches'),'color'=>'blue'])
@section('title')
    @langucw('our branches')
@endsection
@section('css')



@endsection
@section('breadcrumb')
@endsection
@section('content')

<div class="branches">
    <h2>الفروع</h2>
    @foreach($branches??[] as $index=>$branche)
    <div class="branch-card">
        <img src="{{ asset( $branche->getFirstMediaUrl('branche','full') ) }}" alt="فرع 1">
        <div class="branch-details">
            {{-- <h3>اسم الفرع</h3> --}}
            <p><i class="fas fa-map-marker-alt"></i> {{$branche->AddresAr}}</p>
            <p><i class="fas fa-phone"></i> {{$branche->Phone}}</p>
            <p><i class="fas fa-clock"></i> مواعيد العمل:
            </p> من 9 صباحاً وحتى الـ 5 مساءً</p>
        </div>
    </div>
    @endforeach
</div>



@endsection
@section('scripts')



@endsection
