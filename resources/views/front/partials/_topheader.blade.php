<div class="header__top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="header__top__left">
                    <ul>
                        <li><i class="fa fa-envelope"></i>{{ $general->email ?? '' }}</li>
                        <li>
                            @isset($general)
                                @if ($general->shipping_price != null)
                                    {{ __('Free Shipping for all Order of') }} ${{ $general->shipping_price ?? '' }}
                                @endif
                            @endisset
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="header__top__right">
                    <div class="header__top__right__social">
                        @foreach ($socialMedias as $social)
                            <a href="{{ $social->link }}">{!! $social->icon !!}</a>
                        @endforeach
                    </div>
                    <div class="header__top__right__language">
                        @if ($lang == 'en')
                            <img src="{{ asset('projects/front/img/language.png') }}" alt="">
                            <div>{{ __('English') }}</div>
                        @elseif($lang == 'tr')
                            <img style="height: 30px"
                                src="https://www.iconarchive.com/download/i109320/wikipedia/flags/TR-Turkey-Flag.ico"
                                alt="">
                            <div>{{ __('Türk') }}</div>
                        @endif
                        <span class="arrow_carrot-down"></span>
                        <ul>
                            @if ($lang == 'tr')
                                <li><a href="{{ route('locale','en') }}">{{ __('English') }}</a></li>
                            @elseif($lang == 'en')
                                 <li><a href="{{ route('locale','tr') }}">{{ __('Türk') }}</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="header__top__right__language">
                        @if (Auth::check())
                            @if (Auth::user()->img != null)
                                <div class="profil-img">
                                    <a href="{{ route('profil') }}">
                                        <img class="" src="{{ Storage::url(Auth::user()->img) }}" alt="">
                                    </a>
                                </div>
                            @else
                                <div class=" profil-img"><a class="letters"
                                        href="{{ route('profil') }}">{{ $basHarf }}</a>
                                </div>
                            @endif
                            <div>{{ Auth::user()->name }}</div>
                        @else
                            <a class="custom-link" style="color:#1c1c1c; cursor: pointer; text-decoration:none"
                                href="{{ route('login-index') }}">Login |</a>
                            <a style="color:#1c1c1c; cursor: pointer; text-decoration:none"
                                href="{{ route('registerindex') }}">Register</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
