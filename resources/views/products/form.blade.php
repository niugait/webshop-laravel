@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class="align-self-center">
                        {{ __('Products') }}
                        </span>
                        @if(isset($product))
                            <form action="{{ route('product-delete', $product->id) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger ml-4">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="card-body">
                        <product-form
                            csrf="{{ csrf_token() }}"
                            :categories="{{ $categories }}"
                            @if(isset($product))
                            :product="{{ $product }}"
                            route="{{ route('product-update', $product->id) }}"
                            @else
                            route="{{ route('product-store') }}"
                            @endif
                        ></product-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
