@extends('admin/adminLayout/layout')

@section('title', 'Create Category')

@section('category_select', 'active')

@section('content')


    <h1 class="mb10">Create Category</h1>

    <a href="{{ route('admin.category') }}">
        <button type="button" class="btn btn-success">All Category</button>
    </a>
    <br>
    <br>
   
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header text-center">Add Product Category</div>

                <div class="card-body">
                    <form action="{{ route('category.save') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="category_name" class="control-label mb-1">Name</label>
                            <input id="category_name" name="category_name" type="text" class="form-control" 
                            aria-required="true" aria-invalid="false">
                            <span class="alret alert-danger" role="alert">
                                @error('category_name')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="category_slug" class="control-label mb-1">Slug</label>
                            <input id="category_slug" name="category_slug" type="text" class="form-control"
                             aria-required="true" aria-invalid="false">
                             <span class="alret alert-danger" role="alert">
                                @error('category_slug')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection