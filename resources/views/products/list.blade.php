@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Produtos') }}</div>

                    <div class="card-body">
                        <div class="card-columns">
                            @foreach($products as $product)
                            <div class="card">
                                @if(Auth::check() && Auth::user()->is_admin)
                                <div class="card-header">
                                    <a class="btn btn-outline-info" href="{{ route('product-edit', $product->id) }}">Edit</a>
                                </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->price }}</p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">{{ $product->in_stock }} left</small>
                                </div>
                            </div>
                            @endforeach
                            @if($products->isEmpty())
                                <div class="alert alert-info" role="alert">
                                    There are no products available.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
