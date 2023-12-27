@extends('front.layouts.app')
@section('_content')
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">{{ __('Products') }}</th>
                                    <th >{{ __('Title') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($favoryList as $key => $favory)
                                    <tr class="parent-class">
                                        <td class="shoping__cart__item">
                                            <a href="{{ route('shop-detail', $favory->product) }}">
                                                  <div style="height: 100px; width: 100px; overflow: hidden;">
                                                <img src="{{ Storage::url($favory->product->img) }}" alt="" class="object-fit:fill; height: auto;width: 100%">
                                            </div>
                                            </a>
                                        </td>
                                        <td>
                                            {{$favory->product->translateOrDefault($lang)->title }}
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ $favory->product->total }}
                                        </td>
                                        <td class="shoping__cart__item__close delete_favory"
                                            data-post={{ $favory->product->id }}>
                                            <span class="icon_close"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
@section('_scripts')
    <script>
        $(document).ready(function() {
            $('.delete_favory').on('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                const parent = $(this).closest('.parent-class');
                var productId = $(this).data('post');
                $.ajax({
                    type: 'POST',
                    url: `/favory/${productId}`,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        productId: productId
                    },
                    success: function(response) {
                        if (response) {
                            parent.remove();
                            if (response) {
                                const $wishlistCount = $('.wishlist_count');
                                let count = parseInt($wishlistCount.text());
                                count -= 1;
                                $wishlistCount.text(count);
                            }
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
@endsection
