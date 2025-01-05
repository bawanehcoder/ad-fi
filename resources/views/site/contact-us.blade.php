@extends('site.layout.master')
@section('title')
    @langucw('contact us')
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li><a href="{{ route('home') }}">@langucw('home')</a></li>
    <li> @langucw('contact us') </li>
@endsection
@section('content')
    <!-- Contact form section Start -->
    <div class="section-padding-03 contact-section2 contact-section2_bg">
        <div class="container custom-container">


            {{-- <h2>Our Branches</h2>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane"
                        aria-selected="false">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                        type="button" role="tab" aria-controls="contact-tab-pane"
                        aria-selected="false">Contact</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane"
                        type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false"
                        disabled>Disabled</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">...</div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">...</div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                    tabindex="0">...</div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab"
                    tabindex="0">...</div>
            </div> --}}


            <div class="row">
                
                <div class="col-md-12">
                    @include('components.messagesAndErrors')
                    <div class="contact-section2_formbg">
                        <h2 class="contact-section2_form__title">@langucw('say something') ...</h2>
                        <form class="contact-section2_form" method="POST" action="{{ route('contact_us.send') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 form-p">
                                    <div class="form-group">
                                        <label>{{ trans('general.name') }} <span>*</span></label>
                                        <input class="form-field" type="text" name="name" value='{{ old('name') }}'
                                            placeholder="{{ trans('general.name') }}">
                                    </div>
                                </div>

                                <div class="col-md-12 form-p">
                                    <div class="form-group">
                                        <label>@langucw('your email') *</label>
                                        <input class="form-field" type="email" name="email"
                                            value='{{ old('email') }}' placeholder="@langucw('your email')">
                                    </div>
                                </div>

                                <div class="col-md-12 form-p">
                                    <div class="form-group">
                                        <label>{{ trans('general.name') }} <span>@langucw('phone') *</span></label>
                                        <input class="form-field" type="text" name="phone"
                                            value='{{ old('phone') }}' placeholder="@langucw('phone')">
                                    </div>
                                </div>

                                <div class="col-md-12 form-p">
                                    <div class="form-group">
                                        <label>@langucw('message') *</label>
                                        <textarea class="form-control text-area" name="message" placeholder="@langucw('message')">{{ old('message') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 form-p">
                                    <div class="form-group mb-0 d-flex justify-content-center">
                                        <button class="btn btn-primary" type="submit"
                                            value="send message">@langucw('send message')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Message Notification -->
                        <div class="form-messege"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact form section End -->

    <!-- Contact Map Start -->
    {{-- <div class="section">
        <!-- Google Map Area Start -->
        <div class="google-map-area w-100" data-aos="fade-up" data-aos-duration="1000">
            
        </div>
        <!-- Google Map Area Start -->
    </div> --}}
    <!-- Contact Map End -->
@endsection
@section('scripts')
@endsection
