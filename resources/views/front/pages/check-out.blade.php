@extends('front.layouts.app')
@section('_content')
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>{{ __('Billing Details') }}</h4>
                <form action="{{ route('orderPost') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>{{ __('Address') }}<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add"
                                    name="address">
                                @error('address')
                                    <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="checkout__input">
                                <p>{{ __('Phone') }}<span>*</span></p>
                                <input type="text" placeholder="Phone" class="checkout__input__add" name="phone">
                                @error('phone')
                                    <span class="text-danger" style="font-size: 14x">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>{{ __('Your Order') }}</h4>
                                <div class="checkout__order__products">{{ __('Products') }} <span>{{ __('Total') }}</span>
                                </div>
                                <ul>
                                    @foreach ($itemes as $key => $item)
                                        <li>{{ $item->product->translateOrDefault($lang)->title }}<span>${{ $item->total }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">{{ __('Subtotal') }}
                                    <span>${{ $total }}</span>
                                </div>
                                <button type="submit" class="site-btn">{{ __('PLACE ORDER') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
