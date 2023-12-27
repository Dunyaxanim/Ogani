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
                                    <th>{{ __('Title') }}</th>
                                    <th>{{ __('Quantty') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Total') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($basketList as $key => $basket)
                                    <tr class="parent-class">

                                        <td class="shoping__cart__item">
                                            <div style="height: 100px; width: 100px; overflow: hidden;">
                                                <a href="{{ route('shop-detail', $basket->product) }}"><img
                                                        src="{{ Storage::url($basket->product->img) }}" alt=""
                                                        class="object-fit:fill; height: auto;width: 100%"></a>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $basket->product->translateOrDefault($lang)->title }}
                                        </td>
                                        <td>
                                            <div class="product__details__quantity">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" class="count" value="{{ $basket->count }}">
                                                    </div>
                                                    <a href="#" class="primary-btn basket"
                                                        data-post="{{ $basket->product->id }}"><i
                                                            class="fa-solid fa-check"></i>
                                                    </a>
                                                </div>
                                            </div>

                                        </td>

                                        <td class="shoping__cart__price ">
                                            ${{ $basket->product->total }}
                                        </td>
                                        {{-- <td class="shoping__cart__price total">
                                            ${{ $basket->total }}
                                        </td> --}}
                                        <td class="shoping__cart__item__close delete_favory"
                                            data-post={{ $basket->product->id }}>
                                            <span class="icon_close"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <a href="{{ route('myorders') }}" class="primary-btn">SHOW ALL ORDERS</a>
                <div class="col-lg-12">
                    <div class="shoping__checkout">
                        <h5>{{ __('Cart Total') }}</h5>
                        <ul>
                            <li>{{ __('Subtotal') }} <span class="total">${{ $total }}</span></li>
                        </ul>
                        <a href="{{ route('check-out') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>

                <div class="col-lg-12" >
                     
                    {{-- <div class="shoping__checkout">
                        <h5>{{ __('My All Orders') }}</h5>
                       
                    </div> --}}
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
    <script>
        $(document).ready(function() {
            $('.basket').each(function() {
                $(this).on('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation();

                    const clickedBasket = $(this);
                    const productId = clickedBasket.data('post');
                    const count = clickedBasket.closest('.quantity').find('.count').val();
                    const total = clickedBasket.closest('.quantity').find('.total');
                    const totalElement = clickedBasket.closest('.quantity').siblings('.total');
                    $.ajax({
                        type: 'POST',
                        url: `/basket/${productId}?count=${count}`,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            productId: productId,
                            count: count
                        },
                        success: function(response) {
                            if (response) {
                                $('.total').text('$ ' + response['total'])
                                // total.text('$' + response['total']);
                            }
                        },
                        error: function(error) {
                            // window.location.href = "login-index";
                            console.log("error");
                        }
                    });
                });
            });



        });
    </script>
    <script>
        $(document).ready(function() {
            $('.delete_favory').each(function() {
                $(this).on('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    const parent = $(this).closest('.parent-class');
                    var productId = $(this).data('post');
                    $.ajax({
                        type: 'POST',
                        url: `/basket-delete/${productId}`,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            productId: productId
                        },
                        success: function(response) {
                            if (response) {
                                parent.remove();
                                if (response) {
                                    $('.basket_count').text(response['basketcount']);
                                    $('.total').text(response['total']);
                                }
                            }
                        },
                        error: function(error) {
                            // window.location.href = "login-index";
                            console.log('no');
                        }
                    });
                });
            });

        });
    </script>
@endsection
