@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Categories') }}</div>

                    <div class="card-body">
                        @if($categories->isEmpty())
                            <div class="alert alert-info" role="alert">
                                There are no categories available.
                            </div>
                        @else
                        <table class="table table-hover" aria-describedby="categoriesList">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td class="d-inline-flex float-right">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                                            Edit
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
