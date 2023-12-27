@extends('front.layouts.app')
@section('_content')
    <section class="featured spad">
        <div class="container">
            <div class="row featured__filter">
                @if (($products->count()>=1))
                    @foreach ($products as $key => $product)
                        <div
                            class="col-lg-3 col-md-4 col-sm-6 mix {{ $product->category->title }} {{ $product->category->title }}">
                            <div class="featured__item route" data-href="{{ route('shop-detail', $product) }}">
                                <div class="featured__item__pic set-bg" data-setbg="{{ Storage::url("$product->img") }}">
                                    <ul class="featured__item__pic__hover">
                                        <li id="favory" class="favory">
                                            <a href="#" data-post="{{ $product->id }}">
                                                @if (Auth::check())
                                                    <i class="fa fa-heart @isset($product->wishlist[0]->id) green-heart @endisset"></i>
                                                @else
                                                    <i class="fa fa-heart"></i>
                                                @endif
                                            </a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <h6><a href="#">{{ $product->translateOrDefault($lang)->title }}</a></h6>
                                    <h5>${{ $product->price }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                    <h2 style="color: #7FAD39" class="m-auto">{{ __("Result Not Found... :(") }}</h2>
                @endif
            </div>
            <div class="col-lg-12">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
