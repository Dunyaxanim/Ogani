<!-- Header Section Begin -->
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="header__logo">
                @isset($general)
                    <a href="{{ route('home') }}"><img src="{{ Storage::url($general->logo_img) ?? '' }}" alt=""></a>
                @endisset
            </div>
        </div>
        <div class="col-lg-6">
            <nav class="header__menu">
                <ul>
                    <li class="active"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('blog') }}">{{ __('Blog') }}</a></li>
                    <li><a href="{{ route('contact') }}">{{ __('Contact') }}</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-3">
            <div class="header__cart">
                <ul>
                    @if (Auth::check())
                        <li><a href="{{ route('favory-list', Auth::user()) }}"><i class="fa fa-heart"></i> <span
                                    class="wishlist_count">{{ $wishlist_count }}</span></a></li>
                    @else
                        <li><a href="{{ route('login-index') }}"><i class="fa fa-heart"></i> <span
                                    class="wishlist_count">{{ $wishlist_count }}</span></a></li>
                    @endif

                    @if (Auth::check())
                        <li><a href="{{ route('basket-list', Auth::user()) }}"><i class="fa fa-shopping-bag"></i> <span
                                    class="basket_count">{{ $basket_count }}</span></a></li>
                    @else
                        <li><a href="{{ route('login-index') }}"><i class="fa fa-shopping-bag"></i> <span
                                    class="wishlist_count">{{ $wishlist_count }}</span></a></li>
                    @endif
                </ul>
                  @if (Auth::check())
                        <div class="header__cart__price">{{ __('item') }}: <span class="total">${{ $total }}</span></div>
                    @else
                       <div class="header__cart__price">{{ __('item') }}: <span class="total">${{ $total }}</span></div>
                    @endif
                
            </div>
        </div>
    </div>
    <div class="humberger__open">
        <i class="fa fa-bars"></i>
    </div>
</div>
<!-- Header Section End -->
