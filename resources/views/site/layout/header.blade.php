<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-text">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('asset-files/imgs/logo.png') }}" alt="Company Logo" width="150" height="50" />

        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">الرئيسية</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        المتجر
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('products.index', ['rtype' => 'inside']) }}">داخل
                                الاردن</a></li>
                        <li><a class="dropdown-item" href="{{ route('products.index', ['rtype' => 'outside']) }}">خارج
                                الاردن</a></li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('about-us') }}">من نحن</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('our_branches.show') }}">الفروع</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">كتالوج</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">فيديوهات خاصة</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('contact_us.show') }}">تواصل معنا</a>
                </li>

            </ul>
            @auth
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    
                    مرحبا يا 
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('myprofile.index') }}">
                        صفحتي الشخصيه
                            
                    </a></li>
                    
                </ul>
            </li>
            </ul>

            @else
                <a href="{{ route('login') }}" class="login-button">تسجيل الدخول</a>
            @endauth

        </div>
    </div>
</nav>
