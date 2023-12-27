<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>{{ __('All departments') }}</span>
                    </div>
                    <ul class="{{ Route::currentRouteName() == 'home' ? 'd-none d-lg-block' : '' }}">
                        @isset($categories)
                            @foreach ($categories as $key => $value)
                                <li><a href="{{ route('shop',$value) }}">{{ $value->translateOrDefault($lang)->title ?? '' }}</a></li>
                            @endforeach
                        @endisset
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form id="search" action="{{ route('search') }}" method="POST" >
                            @csrf
                            <input id="search-box" class="search-box" name="query" type="text"
                                placeholder="{{ __('What do you need?') }}">
                            <button type="submit" class="site-btn">{{ __('SEARCH') }}</button>
                        </form>

                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+ {{ $general->phone ?? '' }}</h5>
                            <span>{{ __('support 24/7 time') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if (!(\Request::route()->getName() == 'home'))
    <section class="breadcrumb-section set-bg" data-setbg={{ optional($hero)->minor_img ? asset(Storage::url($hero->minor_img)) : '' }}>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ \Request::route()->getName() }}</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>{{ \Request::route()->getName() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
