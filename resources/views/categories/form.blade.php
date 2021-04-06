@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Categories') }}</div>

                    <div class="card-body">
                        <category-form
                            csrf="{{ csrf_token() }}"
                            @if(isset($category))
                            :category="{{ $category }}"
                            route="{{ route('categories.update', $category->id) }}"
                            @else
                            route="{{ route('categories.store') }}"
                            @endif
                        ></category-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
