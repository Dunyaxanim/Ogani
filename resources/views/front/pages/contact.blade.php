@extends('front.layouts.app')
@section('_content')

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>{{ __("Phone") }}</h4>
                        <p>{{$general->phone ?? ''}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>{{ __("Address") }}</h4>
                       <p>{{$general->address ?? ''}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>{{ __("Open time") }}</h4>
                        <p>{{$general->open_time ?? ''}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>{{ __("Email") }}</h4>
                       <p>{{$general->email ?? ''}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    @if(isset($map))
        <div class="map">
        <iframe
            src="{{$map->link ?? ''}}"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>{{$map->translateOrDefault($lang)->country ?? ''}}</h4>
                <ul>
                    <li>{{_("Phone")}}: {{$map->phone}}</li>
                    <li>{{ __("Add") }}: {{$map->translateOrDefault($lang)->address ?? ''}}</li>
                </ul>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Map End -->
      

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>{{ __("Leave Message") }}</h2>
                    </div>
                </div>
            </div>
             @if (\Session::has('message'))
              <div class="col-lg-12">
                    <div class="contact__form__title deleted-message fade-out">
                        <h2 style="color: green">{!! \Session::get('message') !!}</h2>
                    </div>
                </div>

            @endif
            <form action="{{ route('message') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your name" name="name">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="text" placeholder="Your Email" name="email">
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="Your message" name="message"></textarea>
                        <button type="submit" class="site-btn">{{ __("SEND MESSAGE") }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    
    <!-- Contact Form End -->
@endsection