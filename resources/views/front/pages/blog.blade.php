@extends('front.layouts.app')
@section('_content')
    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="{{ route('search') }}" method="POST">
                                <input type="text" name="query" type="text" placeholder="{{ __('Search...') }}">
                                 @csrf
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>{{ __("Categories") }}</h4>
                            <ul>
                                {{-- <li><a href="#">All</a></li>                             --}}
                               @foreach($categories as $key => $category)
                                 <li><a href="{{ route('shop',$category) }}">{{ $category->title }} ({{ $category->products_count }})</a></li>
                               @endforeach
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>{{ __("Recent News") }}</h4>
                            <div class="blog__sidebar__recent">
                                @foreach ($news as $value)
                                    <a href="#" class="blog__sidebar__recent__item">
                                        <div class="blog__sidebar__recent__item__pic" style="height: 80px;width:80px; over-flow:hidden;">
                                            <img style="height: 100%; witdh:100%; object-fill:contain" src="{{ Storage::url($value->img) }}" alt="">
                                        </div>
                                        <div class="blog__sidebar__recent__item__text">
                                            <h6>{{ $value->translateOrDefault($lang)->title }}</h6>
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
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        @foreach ($blogs as $blog)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
                                    <div class="blog__item__pic">
                                        <img src="{{ Storage::url($blog->img) }}" alt="">
                                    </div>
                                    <div class="blog__item__text">
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i>{{ $blog->created_at }}</li>
                                        </ul>
                                        <h5><a href="#">{{ $blog->translateOrDefault($lang)->title }}</a></h5>
                                        <a href="{{ route('blog-detail',$blog) }}" class="blog__btn">{{ __('READ MORE') }} 
                                            <span class="arrow_right"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-center">
                           
                        </div>
                        <div class="col-lg-12">
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Blog Section End -->
@endsection
