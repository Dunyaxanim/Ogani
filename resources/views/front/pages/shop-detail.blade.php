@extends('front.layouts.app')
@section('_content')
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ Storage::url($product->img) }}"
                                alt="">
                        </div>
                        @isset($productImages)
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach ($productImages as $key => $img)
                                    <img data-imgbigurl="{{ Storage::url($img->img) }}" src="{{ Storage::url($img->img) }}"
                                        alt="{{ $product->translateOrDefault($lang)->title }}">
                                @endforeach
                            </div>
                        @endisset

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->translateOrDefault($lang)->title }}</h3>
                        <div class="product__details__rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating)
                                    <i class="fa fa-star rating-star" data-index="{{ $i }}"
                                        data-post="{{ $product->id }}"></i>
                                @elseif ($i - 0.5 <= $rating)
                                    <i class="fa fa-star-half-o rating-star" data-index="{{ $i }}"
                                        data-post="{{ $product->id }}"></i>
                                @else
                                    <i class="fa fa-star-o rating-star" data-index="{{ $i }}"
                                        data-post="{{ $product->id }}"></i>
                                @endif
                            @endfor
                            {{-- <span>({{ $rating }} reviews)</span> --}}
                        </div>
                        <div class="product__details__price">

                            @if ($product->total == $product->price)
                                <h5>${{ $product->price }}</h5>
                            @else
                                <h4 style="color: red;">${{ $product->total }}</h4>
                                <h5 style="color: black; text-decoration-line: line-through; ">${{ $product->price }}
                                </h5>
                            @endif
                        </div>

                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" class="count">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn basket"
                            data-post="{{ $product->id }}">{{ __('ADD TO BASKET') }}</a>
                        <ul>
                            <li><b>{{ __('Availability') }}</b>
                                <span>{{ $product->stock == 1 ? 'In Stock' : 'Out off stock' }} </span>
                            </li>
                            <li><b>{{ __('Weight') }}</b> <span>{{ $product->weight }}
                                    {{ $product->measurement }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">{{ __('Comments') }} <span>({{ $revcount }})</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">{{ __('Description') }}</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane " id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>{{ __('Products Infomation') }}</h6>
                                    <p>{!! $product->translateOrDefault($lang)->description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane active" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc ">
                                    <h6 class="ml-3 d-inline">{{ __('Product Rating') }}</h6>
                                    <div class="product__details__rating ml-3 mb-3 d-inline" id="rating-container">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $rating)
                                                <i class="fa fa-star rating-star" data-index="{{ $i }}"
                                                    data-post="{{ $product->id }}"></i>
                                            @elseif ($i - 0.5 <= $rating)
                                                <i class="fa fa-star-half-o rating-star" data-index="{{ $i }}"
                                                    data-post="{{ $product->id }}"></i>
                                            @else
                                                <i class="fa fa-star-o rating-star" data-index="{{ $i }}"
                                                    data-post="{{ $product->id }}"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="hero__search mt-3">
                                            <div class="hero__search__form">
                                                <form id="comment" method="POST" data-post="{{ $product->id }}">
                                                    <input id="search-box" class="search-box" name="review" type="text"
                                                        placeholder="{{ __('Write a commnet') }}">
                                                    <button type="submit" class="site-btn">{{ __('Send') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        @foreach ($reviews as $review)
                                            <div class="comment-container">
                                                <p class="user-initial" style="color: white;">
                                                    {{ substr($review->user->name, 0, 1) }}</p>
                                                <div class="comment-content">
                                                    <p class="user-name">{{ $review->user->name }}</p>
                                                    <p class="comment-text">{{ $review->commnet }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>{{ __('Related Product') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $key => $relatedProduct)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ Storage::url($relatedProduct->img) }}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">{{ $relatedProduct->title }}</a></h6>
                                <h5>$30.00</h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection
@section('_scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll('.route');
            elements.forEach(function(element) {
                element.addEventListener('click', function() {
                    const path = this.getAttribute('data-href');
                    window.location.href = path;
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.favory a').on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                let productId = $(this).data('post');
                $.ajax({
                    type: 'POST',
                    url: `/favory/${productId}`,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        productId: productId
                    },
                    success: function(response) {
                        if (response) {
                            event.target.classList.toggle('green-heart')
                            let wishlist_count = document.getElementsByClassName(
                                'wishlist_count');
                            let count = wishlist_count[0].innerHTML;
                            let firstWishlistCountElement = wishlist_count[0];
                            if (event.target.classList.contains('green-heart')) {
                                count++;
                            } else {
                                count--;
                            }
                            firstWishlistCountElement.innerText = count;
                        }
                    },
                    error: function(error) {
                        window.location.href = "login-index";
                    }
                });
            });

            $('.featured__item.route').on('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.basket').on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                let productId = $(this).data('post');
                let count = $('.count').val();
                $.ajax({
                    type: 'POST',
                    url: `/basket/${productId}?count=${count}`,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        productId: productId,
                        count: count,
                    },
                    success: function(response) {
                        if (response) {
                            console.log(response)
                        }
                    },
                    error: function(error) {
                        window.location.href = "login-index";
                    }
                });
            });

            $('.featured__item.route').on('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.rating-star');

            stars.forEach(star => {
                star.addEventListener('click', rateProduct);
            });

            function rateProduct(e) {

                const productId = $(this).data('post');
                const rating = e.target.getAttribute('data-index');
                $.ajax({
                    type: 'POST',
                    url: `/rate-product/${productId}?rating=${rating}`,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        productId: productId,
                        rating: rating
                    },
                    success: function(response) {
                        if (response) {
                            console.log(response.averageRating);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        // window.location.href = "/login-index";
                    }
                });
            }
        });
    </script>


<script>
    $(document).ready(function() {
        $('#comment').on('submit', function(e) {
            e.preventDefault();
            const comment = e.target.firstElementChild.value;
            const productId = $(this).data('post');
            if (!comment) {
                console.log('Comment is empty or null');
                return;
            }
            
            $.ajax({
                type: 'POST',
                url: `/review-form/${productId}?comment=${comment}`,
                data: {
                    "_token": "{{ csrf_token() }}",
                    productId: productId,
                    comment: comment
                },
                success: function(response) {
                    
                    const newComment = response[0]['commnet']
                    const userName = response[0]['user']['name']
                    const userNameLetter = response[0]['user']['name'][0]
                    const newCommentHTML = `
                                            <div class="comment-container">
                                                <p class="user-initial" style="color: white;">
                                                    ${userNameLetter}</p>
                                                <div class="comment-content">
                                                    <p class="user-name">${userName}</p>
                                                    <p class="comment-text">${newComment}</p>
                                                </div>
                                            </div>
                    `;
                    $('.col-lg-3').prepend(newCommentHTML);

                },
                error: function(error) {
                    console.log(error['message'])
                    window.location.href = "/login-index";
                }

            });
        });
    });
</script>
@endsection
