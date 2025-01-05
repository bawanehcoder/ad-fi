<!-- Header Start -->
{{-- <div class="header-section header-transparent header-sticky-03">
    <div class="container position-relative">

        <div class="row align-items-center">
            <div class="col-lg-3 col-5">
                <!-- Header Logo Start -->
                <div class="header-logo-02 m-0">
                    <a href="{{route('home')}}"><img src="{{asset('assets/img/logo_small.png')}}" width="60" height="63"
                                                     alt="Logo"></a>
                </div>
                <!-- Header Logo End -->
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <!-- Header Menu Start -->
                @include('site.layout.menu-web')
                <!-- Header Menu End -->
            </div>
            <div class="col-lg-3 col-7">
                <!-- Header Meta Start -->
                <div class="header-meta">
                    <ul class="header-meta__action header-meta__action-03 d-flex justify-content-end">
                        <li>
                            <button class="action search-open"><i class="lastudioicon-zoom-1"></i></button>
                        </li>
                        <li>
                            <button class="action" onclick="offcanvasCart()" data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasCart">
                                <i class="lastudioicon-shopping-cart-2"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"
                                    id="cart_count">{{\App\Services\CartService::getCount()}}</span>
                            </button>
                        </li>
                        @if (isLogged())
                            <li class="notifactions-conatainer">
                                <button class="action  show-note">
                                    <i class="fa fa-bell"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"
                                        id="notifications_count">{{getLogged()->unreadNotifications()->count()}}</span>
                                    @include('site.layout.notifications')
                                </button>
                            </li>
                        @endif
                        @if (Route::has('login'))
                            @auth
                                <li><a class="action" href="{{route('myprofile.index')}}"><i
                                            class="lastudioicon-single-01-2"></i></a></li>
                            @else
                                <li><a class="action" href="{{route('login')}}"><i class="lastudioicon-single-01-2"></i></a>
                                </li>

                            @endauth
                        @else
                        @endif
                        <li class="d-lg-none">
                            <button class="action" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu"><i
                                    class="lastudioicon-menu-8-1"></i></button>
                        </li>
                    </ul>
                </div>
                <!-- Header Meta End -->
            </div>
        </div>

    </div>
</div> --}}
<!-- Header End -->


    <header class=" home-header" id="home-header">
        <div class="header-container">
            <nav class="navbar navbar-expand-lg navbar-dark container" id="header-container"
                style="top: 0; z-index: 1;">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
                    </a>
                    <button class="navbar-toggler" style="color: #333" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars" aria-hidden="true"></i>

                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @include('site.layout.menu-web')

                        <div class="d-flex me-2">


                            {{-- @if (strtolower(getLang()) == 'en')
                                <a href="{{ route('app.change_language', ['lang' => 'ar']) }}"
                                    class="btn btn-transparent-outline mx-2 action ">
                                    <small>ع</small>

                                </a>
                            @endif
                            @if (strtolower(getLang()) == 'ar')
                                <a href="{{ route('app.change_language', ['lang' => 'en']) }}"
                                    class="btn btn-transparent-outline mx-2 action ">
                                    <small>EN</small>

                                </a>
                            @endif --}}

                             @if (isLogged())
                                {{-- <div class="dropdown show" id="profile-dropdown">

                                    <li class="notifactions-conatainer">
                                        <button class="action  show-note btn btn-transparent-outline mx-2">
                                            <i class="fa fa-bell" aria-hidden="true"></i>

                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary"
                                                id="notifications_count">{{ getLogged()->unreadNotifications()->count() }}</span>
                                            @include('site.layout.notifications')
                                        </button>
                                    </li>
                                </div> --}}
                                {{-- <a href="{{ route('myprofile.index') }}" class="action  show-note"
                                        class="btn btn-transparent-outline dropdown-toggle mx-2" role="button"
                                        id="profileButton" aria-expanded="false">
                                        <img src="{{ asset('assets/images/bell.svg') }}" />
                                    </a> --}}
                            @endif

                            <div class="dropdown show" id="profile-dropdown">

                                @auth

                                    <a href="{{ route('myprofile.index') }}"
                                        class="btn btn-transparent-outline dropdown-toggle mx-2" role="button"
                                        id="profileButton" aria-expanded="false">
                                        <i class="fa fa-user-o" aria-hidden="true"></i>

                                    </a>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="btn btn-transparent-outline dropdown-toggle mx-2 cust-hed" role="button"
                                        id="profileButton" aria-expanded="false">
                                        Login

                                    </a>

                                @endauth


                            </div>

                            <a href="#" class="btn btn-transparent-outline mx-2 action search-open">
                                {{-- <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.01131 12.5876C7.42293 12.7493 8.84313 12.3994 10.0157 11.6058L13.3301 14.9201C13.3301 14.9202 13.3301 14.9202 13.3301 14.9202C13.5411 15.1313 13.8272 15.2499 14.1256 15.25C14.4241 15.2501 14.7103 15.1317 14.9214 14.9207C15.1325 14.7097 15.2512 14.4236 15.2513 14.1251C15.2514 13.8267 15.1329 13.5404 14.922 13.3293L14.9219 13.3293L11.6067 10.014C12.4 8.84066 12.7492 7.41974 12.5864 6.00776C12.4149 4.5211 11.6885 3.154 10.5523 2.17996C9.41621 1.20592 7.95419 0.696786 6.45878 0.754407C4.96338 0.812027 3.54487 1.43216 2.48706 2.49073C1.42924 3.54931 0.810124 4.96826 0.753573 6.4637C0.697023 7.95915 1.20721 9.4208 2.18206 10.5562C3.15691 11.6917 4.52453 12.4172 6.01131 12.5876ZM11.2512 6.68647C11.2512 7.28569 11.1332 7.87904 10.9039 8.43265C10.6745 8.98626 10.3384 9.48928 9.91473 9.91299C9.49101 10.3367 8.98799 10.6728 8.43438 10.9021C7.88078 11.1314 7.28742 11.2495 6.6882 11.2495C6.08898 11.2495 5.49563 11.1314 4.94202 10.9021C4.38841 10.6728 3.88539 10.3367 3.46168 9.91299C3.03796 9.48928 2.70185 8.98626 2.47254 8.43265C2.24323 7.87904 2.1252 7.28569 2.1252 6.68647C2.1252 5.47628 2.60595 4.31567 3.46168 3.45994C4.3174 2.60421 5.47802 2.12347 6.6882 2.12347C7.89838 2.12347 9.059 2.60421 9.91473 3.45994C10.7705 4.31567 11.2512 5.47628 11.2512 6.68647Z"
                                        fill="white" stroke="#E34C80" stroke-width="0.5" />
                                </svg> --}}
                                <i class="fa fa-search" aria-hidden="true"></i>

                            </a>
                           
                            @php
                                $carts = App\Services\CartService::getCarts();
                            @endphp
                            <div class="dropdown show" id="checkout-dropdown">
                                <a href="#" class="btn btn-transparent-outline dropdown-toggle mx-2"
                                onclick="offcanvasCart()" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasCart">
                                    <span class="cart-counter">{{ count($carts ?? []) }}</span>
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                </a>
                              
                            </div>
                        </div>
                    </div>
            </nav>

        </div>
    </header>
    <!-- End Header -->




<!-- End Header -->
