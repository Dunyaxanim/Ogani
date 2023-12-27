@extends('front.layouts.app')
@section('_content')
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <div class="row">
                    @foreach ($items as $key => $value)
                    @if($value->status)
                          <div class="col-lg-4 col-md-6 p-3" >
                            <form action="{{ route('orderCancle',$value) }}" method="post" style="height: 100%">
                                @csrf
                                {{-- <div class="row"> --}}

                                <div class="checkout__order" style="height: 100%">
                                    <h4>{{ __('Your Order') }}</h4>
                                    <div class="checkout__order__products">{{ __('Products') }}
                                        <span>{{ __('Total') }}</span>
                                    </div>
                                    <ul>
                                        @foreach ($value->orderItems as $key => $item)
                                            <li>{{ $item->product->title }}<span></span></li>
                                        @endforeach
                                    </ul>
                                    <div class="checkout__order__subtotal">{{ __('Subtotal') }}
                                        <span>${{ $value->total }}</span>
                                    </div>

                                    <button type="submit" style="{{ $value->status==1 ? 'background-color: red' : ''}}" class="site-btn">{{ __('CANCLE THE ORDER') }}</button>

                                    {{-- </div> --}}
                                </div>
                            </form>
                        </div>
                    @endif
                      
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
