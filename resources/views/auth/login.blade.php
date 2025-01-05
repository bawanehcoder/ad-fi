@extends('site.layout.master')
@section('title')
    @langucw('login')
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li>@langucw('login')</li>
@endsection


@section('content')

    <div class="col-12 py-5 px-5  login">
        <form method="POST" action="{{ route('login') }}">
            @csrf
        <div class="login-container">
            <img alt="Logo with Arabic calligraphy and a man in traditional attire" 
                src="{{ asset('asset-files/imgs/slider/logo.png') }}"
                />
            <h2>
                تسجيل الدخول
            </h2>
            <input placeholder="البريد الإلكتروني" type="email"  name="email" />
            <div class="password-container">
                <input placeholder="كلمة المرور" type="password"  name="password"/>
                {{-- <i class="fas fa-eye"> --}}
                </i>
            </div>
            <a href="{{ route('password.request') }}">
                نسيت كلمة المرور؟
            </a>
            <div class="btn-container">
                <a href="{{ route('register') }}" class="btn-create">
                    إنشاء حساب
                </a>
                <button type="submit" class="btn-login">
                    تسجيل الدخول
                </button>
            </div>
        </div>
        </form>


        {{-- <div class="row mx-0">
            <div class="card px-0 col-md-6 m-auto">
                <div class="card-header text-center" style="border-bottom: 0;">
                    <h3>{{ __('login') }}</h3>
                </div>
                <div class="card-body  align-items-center m-auto">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="inputEmail">{{ __('Email Address') }}</label>
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group mb-3">
                            <label for="inputPassword">{{ __('Password') }}</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-check-label"><input type="checkbox">{{ __('Remember Me') }}</label>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                        <a href="{{ route('register') }}" class="btn btn-transparent-outlinet">{{ __('register') }}</a>
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </form>

                    @include('components.login-buttons', ['guard' => 'web'])

                </div>
            </div>
        </div> --}}
    </div>
 
@endsection

