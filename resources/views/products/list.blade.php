@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <product-list
                    :products="{{ $products }}"
                    :is_admin="{{ json_encode(Auth::check() && Auth::user()->is_admin) }}"
                    route_update="{{ route('products.edit', '#') }}"
                    route_show="{{ route('products.show', '') }}"
                    coupon_route="{{ route('coupons.check', '') }}"
                    csrf="{{ csrf_token() }}"
                ></product-list>
            </div>
        </div>
    </div>
@endsection
