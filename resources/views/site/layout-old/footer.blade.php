<!-- Footer Strat -->
@php $generalInfo=\App\Services\GeneralInfoService::getGeneralInfo(); @endphp
<div class="footer-section dark-footer">



    <footer class="mt-10">
        <div class="container py-10 ss-p">
            <div class="row mx-0 pb-4">
                {{-- <div class="col-md-3">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
                <div class="d-flex gap-2 mt-2">
                    <a href=" #" class="social-icon d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path
                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                        </svg>
                    </a>
                    <a href="#" class="social-icon d-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                            <path
                                d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                        </svg>
                    </a>
                </div>
            </div> --}}
                <div class="col-md-4 footer-links">
                    <h3>{{ __('SERVICES') }}</h3>
                    <ul>
                        <li data-aos="fade-up"><a href="{{ route('favorites.index') }}"><span>@langucw('wishlist')</span></a>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="300"><a
                                href="{{ route('page.show', ['routeName' => 'howToOrder']) }}"><span>@langucw('how to order')</span></a>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="600"><a
                                href="{{ route('page.show', ['routeName' => 'ourStory']) }}"><span>@langucw('our story')</span></a>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="900"><a
                                href="{{ route('page.show', ['routeName' => 'privacyPolicy']) }}"><span>@langucw('privacy policy')</span></a>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="1200"><a
                                href="{{ route('page.show', ['routeName' => 'termsAndConditions']) }}"><span>@langucw('terms and conditions')</span></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 footer-links">
                    <h3>{{ __('SUPPORT') }}</h3>
                    <ul>
                        <li data-aos="fade-up"><a
                                href="{{ route('contact_us.show') }}"><span>@langucw('contact')</span></a></li>
                        <li data-aos="fade-up" data-aos-delay="300"><a
                                href="{{ route('our_branches.show') }}">@langucw('our branches')</a></li>
                        <li data-aos="fade-up" data-aos-delay="600"><a
                                href="{{ route('page.show', ['routeName' => 'about']) }}">@langucw('about')</a></li>
                        <li data-aos="fade-up" data-aos-delay="900"><a target="_blank"
                                href="https://careers.rawancake.jo/">@langucw('careers')</a></li>

                    </ul>
                </div>
                <div class="col-md-4">
                    <h3>{{ __('Payment methods') }}</h3>
                    <div class="d-flex flex-row">
                        <img src="{{ asset('assets/m.png') }}" class="img-responsive" />
                        <img src="{{ asset('assets/p.png') }}" class="img-responsive" />
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex" style="background-color: #333;">
            <div class="container ">
                <div
                    class="mt-3 d-flex flex-md-row flex-column x-0 justify-content-between align-items-center pb-3 copy-right">
                    <div class="d-flex">© 2024 All Rights Reserved </div>
                    <div class="d-flex gap-2 mt-2">
                        <a href=" #" class="social-icon d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-facebook" viewBox="0 0 16 16">
                                <path
                                    d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                            </svg>
                        </a>
                        <a href="#" class="social-icon d-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                class="bi bi-twitter-x" viewBox="0 0 16 16">
                                <path
                                    d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>




    <div class="bottom-navbar">

        <button class="active">
            <a href="{{ route('home') }}" id="profileButton" aria-expanded="false">
                <i class="fa fa-home" aria-hidden="true"></i>
            </a>
        </button>
        <button>
            <a href="{{ route('mainshop') }}" id="profileButton" aria-expanded="false">
                <i class="fa fa-shopping-basket" aria-hidden="true"></i>
            </a>
        </button>
        <button onclick="offcanvasCart()" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" class="float">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>

        </button>


        @auth
            <button>
                <a href="{{ route('myprofile.index') }}" id="profileButton" aria-expanded="false">
                    <i class="fa fa-user-o" aria-hidden="true"></i>

                </a>
            </button>
        @else
            <button>
                <a href="{{ route('login') }}" id="profileButton" aria-expanded="false">
                    <i class="fa fa-user-o" aria-hidden="true"></i>

                </a>
            </button>

        @endauth
        <button class="action search-open">
            <i class="fa fa-search" aria-hidden="true"></i>
        </button>
    </div>


    <div id="modal_product"></div>
    {{-- @include('site.layout.modal.exampleProductModal') --}}
    @include('site.layout.modal.modalCart')
    {{-- @include('site.layout.modal.modalWishlist') --}}
    @include('site.layout.modal.modalNotifications')

    {{-- @include('site.cart.address-modal') --}}
