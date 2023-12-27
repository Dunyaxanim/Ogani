<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{ route('home') }}"><img
                                src="{{ optional($general)->logo_img ? asset(Storage::url($general->logo_img)) : '' }}"
                                alt=""></a>
                    </div>
                    <ul>
                        <li>{{ __('Address') }}: {{ $general->address ?? '' }}</li>
                        <li>{{ __('Phone') }}: +{{ $general->phone ?? '' }}</li>
                        <li>{{ __('Email') }}: {{ $general->email ?? '' }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>{{ __('Useful links') }}</h6>
                    <ul>
                        <li class="active"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li><a href="{{ route('blog') }}">{{ __('Blog') }}</a></li>
                        <li><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    {{-- <h6>Join Our Newsletter Now</h6>
                    <p>Get E-mail updates about our latest shop and special offers.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your mail">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form> --}}
                    <div class="footer__widget__social">
                        @foreach ($socialMedias as $social)
                            <a href="{{ $social->link }}">{!! $social->icon !!}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text"
                        style="display: flex; justify-content: center; align-items: center;">
                        <p>Ogani</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
