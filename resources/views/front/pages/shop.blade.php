@extends('front.layouts.app')
@section('_content')
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>{{ __('Categories') }}</h4>
                            <ul>
                                @foreach ($categories as $key => $category)
                                    <li><a href="{{ route('home') }}">{{ $category->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar__item">
                            <h4>{{ __('Price') }}</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="{{ $minPrice }}" data-max="{{ $maxPrice }}">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" class="change-range" id="minamount">
                                        <input type="text" class="change-range" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>{{ __('Latest Products') }}</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        @for ($i = 0; $i < 7; $i++)
                                            @if (isset($randomProducts[$i]))
                                                <a href="{{ route('shop-detail', $lastedProducts[$i]) }}"
                                                    class="latest-product__item">
                                                    <div class="latest-product__item__pic">
                                                        <img src="{{ Storage::url($randomProducts[$i]->img) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="latest-product__item__text">
                                                        <h6>{{ $randomProducts[$i]->translateOrDefault($lang)->title }}</h6>
                                                        @if ($randomProducts[$i]->total == $randomProducts[$i]->price)
                                                            <h5>${{ $randomProducts[$i]->price }}</h5>
                                                        @else
                                                            <h4 style="color: red;">${{ $randomProducts[$i]->total }}</h4>
                                                        @endif
                                                    </div>
                                                </a>
                                                @if ($i == 2)
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        @endif
                                        @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>{{ __('Sale Off') }}</h2>
                        </div>
                        {{-- <x-discount-product :discounProducts="$discounProducts" /> --}}
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($discounProducts as $key => $discounProduct)
                                    <div class="col-lg-4">
                                        <div class="product__discount__item route"
                                            data-href="{{ route('shop-detail', $discounProduct->id) }}">
                                            <div class="product__discount__item__pic set-bg"
                                                data-setbg="{{ Storage::url($discounProduct->img) }}">
                                                <div class="product__discount__percent">
                                                    -{{ $discounProduct->discount_price }}%</div>
                                                <ul class="product__item__pic__hover">
                                                    <li id="favory" class="favory">
                                                        <a href="#" data-post="{{ $discounProduct->id }}">
                                                            @if (Auth::check())
                                                                <i
                                                                    class="fa fa-heart @isset($discounProduct->wishlist[0]->id) green-heart @endisset"></i>
                                                            @else
                                                                <i class="fa fa-heart"></i>
                                                            @endif
                                                        </a>
                                                    </li>
                                                    <li id="basket" class="basket">
                                                        <a href="#" data-post="{{ $discounProduct->id }}"
                                                            data-count=1>
                                                            <i class="fa fa-shopping-cart "></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>{{ $discounProduct->category->title }}</span>
                                                <h5><a href="#">{{ $discounProduct->title }}</a></h5>
                                                <div class="product__item__price">${{ $discounProduct->total }}
                                                    <span>${{ $discounProduct->price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" style="text-align: center; margin-top:10px;margin-bottom:35px;">
                        {{ $discounProducts->links() }}
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ count($noneDiscounProducts) }}</span> Products found</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($noneDiscounProducts as $key => $noneDiscounProduct)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item route"
                                    data-href="{{ route('shop-detail', $noneDiscounProduct->id) }}">
                                    <div class="product__item__pic set-bg"
                                        data-setbg="{{ Storage::url($noneDiscounProduct->img) }}">
                                        <ul class="product__item__pic__hover">
                                            <li id="favory" class="favory">
                                                <a href="#" data-post="{{ $noneDiscounProduct->id }}">
                                                    @if (Auth::check())
                                                        <i
                                                            class="fa fa-heart @isset($noneDiscounProduct->wishlist[0]->id) green-heart @endisset"></i>
                                                    @else
                                                        <i class="fa fa-heart"></i>
                                                    @endif
                                                </a>
                                            </li>
                                            <li id="basket" class="basket">
                                                <a href="#" data-post="{{ $noneDiscounProduct->id }}" data-count=1>
                                                    <i class="fa fa-shopping-cart "></i>
                                                </a>
                                            </li>
                                        </ul>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a
                                                href="#">{{ $noneDiscounProduct->translateOrDefault($lang)->title }}</a>
                                        </h6>
                                        <h5>${{ $noneDiscounProduct->price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="product__pagination">
                        <div class="col-lg-12" style="text-align: center; margin-top:10px;margin-bottom:35px;">
                            {{ $noneDiscounProducts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection


@section('_scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $(".price-range").slider({
                range: true,
                min: 1,
                max: 100,
                values: [1, 100],
                slide: function(event, ui) {
                    $("#minamount").val(ui.values[0])
                    $("#maxamount").val(ui.values[1])
                },
                stop: function(event, ui) {
                    $.ajax({
                        url: "{{ route('product-filter') }}",
                        method: "GET",
                        data: {
                            min_price: ui.values[0],
                            max_price: ui.values[1]
                        },
                        success: function(response) {
                            console.log(response['products'])
                        },
                        error: function(xhr) {}
                    })
                }

            })
        })
    </script>
@endsection
