@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Coupons') }}</div>

                    <div class="card-body">
                        <coupon-form
                            csrf="{{ csrf_token() }}"
                            @if(isset($coupon))
                            :coupon="{{ $coupon }}"
                            route="{{ route('coupon-update', $coupon->id) }}"
                            @else
                            route="{{ route('coupon-store') }}"
                            @endif
                        ></coupon-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
