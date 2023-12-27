@extends('front.layouts.app')
@section('_content')

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                {{-- @dd($hero[0]->title) --}}
                @isset($hero)
                    <div class="col-lg-9">
                        <div class="hero__item set-bg" data-setbg="{{ Storage::url($hero->img) ?? '' }}">
                            <div class="hero__text">
                                <span>{{ $hero->translateOrDefault($lang)->title ?? '' }}</span>
                                <h2 id="filter-data">{!! $hero->translateOrDefault($lang)->description ?? '' !!}</h2>
                                <p>{{ $hero->translateOrDefault($lang)->content }}</p>
                                <a href="#" class="primary-btn">{{ __('SHOP NOW') }} </a>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @isset($categories)
                        @foreach ($categories as $key => $category)
                            <div class="col-lg-3">
                                <div class="categories__item set-bg" data-setbg="{{ asset(Storage::url($category->img)) }}">
                                    <h5><a href="{{ route('shop',$category) }}">{{ $category->translateOrDefault($lang)->title ?? '' }}</a></h5>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>{{ __('Featured Product') }}</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">{{ __('All') }}</li>
                            @foreach ($categories as $key => $cat)
                                <li data-filter=".{{ $cat->title }}">{{ $cat->title }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($products as $key => $product)
                    <div
                        class="col-lg-3 col-md-4 col-sm-6 mix {{ $product->category->title }} {{ $product->category->title }}">
                        <div class="featured__item route" data-href="{{ route('shop-detail', $product) }}">
                            <div class="featured__item__pic set-bg" data-setbg="{{ Storage::url("$product->img") }}">
                                <ul class="featured__item__pic__hover">
                                    <li id="favory" class="favory">
                                        <a href="#" data-post="{{ $product->id }}">
                                            @if (Auth::check())
                                                <i
                                                    class="fa fa-heart @isset($product->wishlist[0]->id) green-heart @endisset"></i>
                                            @else
                                                <i class="fa fa-heart"></i>
                                            @endif
                                        </a>
                                    </li>
                                    <li id="basket" class="basket">
                                        <a href="#" data-post="{{ $product->id }}" data-count=1>
                                            <i class="fa fa-shopping-cart "></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#">{{ $product->translateOrDefault($lang)->title }}</a></h6>

                                @if ($product->total == $product->price)
                                    <h5>${{ $product->price }}</h5>
                                @else
                                    <h4 style="color: red;">${{ $product->total }}</h4>
                                    <h5 style="color: black; text-decoration-line: line-through; ">${{ $product->price }}
                                    </h5>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-12">
                {{ $products->links() }}
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>{{ __('Top Rated Products') }}</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @for ($i = 0; $i < 7; $i++)
                                    @if (isset($raitingProducts[$i]))
                                        <a href="{{ route('shop-detail',$raitingProducts[$i]) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ Storage::url($lastedProducts[$i]->img) }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $raitingProducts[$i]->translateOrDefault($lang)->title }}</h6>
                                                @if ($raitingProducts[$i]->total == null)
                                                    <h5>${{ $raitingProducts[$i]->price }}</h5>
                                                @else
                                                    <h4 style="color: red;">${{ $raitingProducts[$i]->total }}</h4>
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
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>{{ __('Latest Products') }}</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @for ($i = 0; $i < 7; $i++)
                                    @if (isset($lastedProducts[$i]))
                                       <a href="{{ route('shop-detail',$lastedProducts[$i]) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ Storage::url($lastedProducts[$i]->img) }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $lastedProducts[$i]->title }}</h6>
                                                @if ($lastedProducts[$i]->total == null)
                                                    <h5>${{ $lastedProducts[$i]->price }}</h5>
                                                @else
                                                    <h4 style="color: red;">${{ $lastedProducts[$i]->total }}</h4>
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
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>{{ __('Review Products') }}</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @for ($i = 0; $i < 7; $i++)
                                    @if (isset($randomProducts[$i]))
                                       <a href="{{ route('shop-detail',$lastedProducts[$i]) }}" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{ Storage::url($randomProducts[$i]->img) }}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $randomProducts[$i]->translateOrDefault($lang)->title }}</h6>
                                                @if ($randomProducts[$i]->total == null)
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
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->

    <section class="from-blog spad">
        @isset($blogs)
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title from-blog__title">
                            <h2>{{ __('From The Blog') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($blogs as $key => $blog)
                        <div class="col-lg-4 col-md-4 col-sm-6 ">
                            <div class="blog__item route" data-href="{{ route('blog-detail', $blog) }}">
                                <div class="blog__item__pic">
                                    <img src="{{ Storage::url($blog->img) }}" alt="{{ $blog->title }}">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i> {{ $blog->created_at }}</li>
                                    </ul>
                                    <h5><a href="#">{{ $blog->title }}</a></h5>
                                    <a href="#" class="blog__btn">{{ __('READ MORE') }}
                                        <span class="arrow_right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endisset
    </section>

    <!-- Blog Section End -->
@endsection

@section('_scripts')
   
   
@endsection
