@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <product-show
                    :is_admin="{{ json_encode(Auth::check() && Auth::user()->is_admin) }}"
                    route="{{ route('product-update', $product->id) }}"
                    route_show="{{ route('product', '') }}"
                    coupon_route="{{ route('coupon-check', '') }}"
                    csrf="{{ csrf_token() }}"
                    :product="{{ $product }}"
                ></product-show>
            </div>
        </div>
    </div>
@endsection
