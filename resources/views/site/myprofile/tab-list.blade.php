<div class="col-lg-4 col-12">

    <div class="sidebar ">
        <ul class="my-account-tab-list nav">
            <li>
                <span class="sidebar-item-title2"><a href="#dashboad"  data-bs-toggle="tab" class="active"><i
                    class="lastudioicon-home-2"></i>@langucw('dashboard')</a></span>
            </li>
            <li>
                <span class="sidebar-item-title2"><a href="#orders" data-bs-toggle="tab"><i class="dlicon files_notebook"></i>@langucw('Orders') </a></span>

            </li>
            <li>
                <span class="sidebar-item-title2"><a href="#account-info" data-bs-toggle="tab"><i class="dlicon users_single-01"></i>{{ __('Account Details') }}</a></span>

            </li>
            <li>
                <span class="sidebar-item-title2"><form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf<a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dlicon arrows-1_log-out">@langucw('Logout')</a></form></span>

            </li>
            {{-- <li></li>
            <li></li>
            <li></li>
            <li></li> --}}
        </ul>
    </div>
</div>
