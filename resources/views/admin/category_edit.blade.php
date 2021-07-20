@extends('admin/layout')

@section('title', 'Edit Category')

@section('content')


    <h1 class="mb10">Edit Category</h1>

    <a href="{{ route('admin.category') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <br>
    <br>
   
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header text-center">Edit Product Category</div>

                <div class="card-body">
                    <form action="{{ url('admin/category/edit/'.$selected_category->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="category_name" class="control-label mb-1">Name</label>
                            <input id="category_name" name="category_name" value="{{ $selected_category->category_name }}" type="text" class="form-control" 
                            aria-required="true" aria-invalid="false">
                            <span class="alret alert-danger" role="alert">
                                @error('category_name')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="category_slug" class="control-label mb-1">Slug</label>
                            <input id="category_slug" name="category_slug" value="{{ $selected_category->category_slug }}" type="text" class="form-control"
                             aria-required="true" aria-invalid="false">
                             <span class="alret alert-danger" role="alert">
                                @error('category_slug')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection