<div class="oflogin">
    <div class="oflog">
        <img src="{{ asset('assets/l.png') }}" />
    </div>

    <div id="message"></div>
    <form method="POST">
        @csrf
        <div class="form-group mb-3">
            <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" id="emailoff" required  autofocus
                placeholder="{{ __('Email Address') }}">
        </div>
        <div class="form-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                id="passwordoff" required autocomplete="current-password" placeholder="{{ __('Password') }}">
        </div>
        <div class="form-group mb-3">
            <label class="form-check-label"><input type="checkbox">{{ __('Remember Me') }}</label>
        </div>
        <button type="button" id="login-formoff" class="btn btn-primary">{{ __('Login') }}</button>
        <a href="{{ route('register') }}" class="btn btn-transparent-outlinet">{{ __('register') }}</a>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </form>
</div>
