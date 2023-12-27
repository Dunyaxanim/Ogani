@extends('front.layouts.app')
@section('_content')
    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    <div class="blog__sidebar">
                       <div class="blog__sidebar__search">
                            <form action="{{ route('search') }}" method="POST">
                                <input type="text" name="query" type="text"  placeholder="{{ __('Search...') }}">
                                 @csrf
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>{{ __("Categories") }}</h4>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('shop',$category) }}">{{ $category->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Recent News</h4>
                            <div class="blog__sidebar__recent">
                                @foreach ($news as $value)
                                    <a href="#" class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic"
                                            style="height: 80px;width:80px; over-flow:hidden;">
                                            <img style="height: 100%; witdh:100%; object-fill:contain"
                                                src="{{ Storage::url("$value->img") }}" alt="{{ $value->title }}">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>{{ $value->title }}</h6>
                                            <span>{{ $value->created_at }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>{{ __("Search By") }}</h4>
                            <div class="blog__sidebar__item__tags">
                                @foreach($categories as $key => $category)
                                <a href="{{ route("shop-detail",$category) }}">{{ $category->title }}</a>
                               @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        <div style="height: 480px; over-flow:hidden;">

                            <img style="height: 100%; witdh:100%; object-fill:contain"
                                src="{{ Storage::url("$blog->img") }}" alt="{{ $blog->title }}">
                        </div>
                        <h3>{{ $blog->translateOrDefault($lang)->title }}</h3>
                        <p>{!! $blog->translateOrDefault($lang)->description !!}</p>
                    </div>
                    <div class="blog__details__content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="{{ Storage::url($admin->img) }}" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>{{ $admin->name }} {{ $admin->last_name }}</h6>
                                        <span>Admin</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li><span>Social Media:</span></li>
                                        <div class="blog__details__social">
                                        @foreach ($socialMedias as $social)
                                            <a href="{{ $social->link }}">{!! $social->icon !!}</a>
                                        @endforeach
                                    </div>
                                    </ul>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
