@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Coupons') }}</div>

                    <div class="card-body">
                        @if($coupons->isEmpty())
                            <div class="alert alert-info" role="alert">
                                There are no coupons available.
                            </div>
                        @else
                            <table class="table table-hover" aria-describedby="categoriesList">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Expiration date</th>
                                    <th scope="col" class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupons as $coupon)
                                    <tr>
                                        <th scope="row">{{ $coupon->id }}</th>
                                        <td>{{ $coupon->name }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->discount }}</td>
                                        <td>{{ $coupon->expires_at }}</td>
                                        <td class="d-inline-flex float-right">
                                            <a href="{{ route('coupon-edit', $coupon->id) }}" class="btn btn-warning">
                                                Edit
                                            </a>
                                            <form action="{{ route('coupon-delete', $coupon->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger ml-4">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
