@extends('admin/adminLayout/layout')

@section('title', 'Create Size')

@section('size_select', 'active')

@section('content')


    <h1 class="mb10">Create Size</h1>

    <a href="{{ route('admin.size') }}">
        <button type="button" class="btn btn-success">All Sizes</button>
    </a>
    <br>
    <br>
   
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header text-center">Add Size</div>

                <div class="card-body">
                    <form action="{{ route('size.save') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="size" class="control-label mb-1">Size</label>
                            <input id="size" name="size" type="text" class="form-control" 
                            aria-required="true" aria-invalid="false">
                            <span class="alret alert-danger" role="alert">
                                @error('size')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label mb-1">Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            <span class="alret alert-danger" role="alert">
                                @error('status')
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