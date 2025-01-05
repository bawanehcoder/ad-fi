@extends('site.layout.master')
@section('title') @langucw('register') @endsection
@section('css') @endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">@langucw('home')</a></li>
    <li class="breadcrumb-item"><a href="{{route('login')}}">@langucw('login')</a></li>
    <li aria-current="page" class="breadcrumb-item active">@langucw('register')</li>
@endsection
@section('content')

<div class="col-12 py-5 px-5  login">
    <form method="POST" action="{{ route('register') }}">
        @csrf
    <div class="login-container">
        <img alt="Logo with Arabic calligraphy and a man in traditional attire" 
            src="{{ asset('asset-files/imgs/slider/logo.png') }}"
            />
        <h2>
            تسجيل الدخول
        </h2>
        <input id="name" type="text"
        class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="الاسم">

        <input id="email" type="text"
        class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email" placeholder="البريد الالكتروني">

        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                       value="{{ old('phone') }}" required autocomplete="phone" placeholder="رقم الهاتف">
                                       

        <div class="password-container">
            <input placeholder="كلمة المرور" type="password"  name="password"/>
            {{-- <i class="fas fa-eye"> --}}
            </i>
        </div>

        <select name="gender" autocomplete="off" id="gender" class="form-control">

            <option value="0">{{__('male')}}   </option>
            <option value="1">{{__('female')}}   </option>
        </select>


        <div class="btn-container">
            <a href="{{ route('register') }}" class="btn-create">
                تسجيل الدخول
            </a>
            <button type="submit" class="btn-login">
                انشاء حساب
            </button>
        </div>
    </div>
    </form>



</div>


@endsection
