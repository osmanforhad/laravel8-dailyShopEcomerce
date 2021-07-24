@extends('admin/adminLayout/layout')

@section('title', 'Edit Size')

@section('size_select', 'active')

@section('content')


    <h1 class="mb10">Edit Size</h1>

    <a href="{{ route('admin.size') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <br>
    <br>
   
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header text-center">Edit Size</div>

                <div class="card-body">
                    <form action="{{ url('admin/size/update/'.$selected_size->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="size" class="control-label mb-1">Size</label>
                            <input id="size" name="size" value="{{ $selected_size->size }}" type="text" class="form-control" 
                            aria-required="true" aria-invalid="false">
                            <span class="alret alert-danger" role="alert">
                                @error('size')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label mb-1">Staus</label>
                            <select class="form-control" name="status">
                                <option value="1" {{($selected_size->status === '1') ? 'Selected' : ''}}>Active</option>
                                <option value="0" {{($selected_size->status === '0') ? 'Selected' : ''}}>Deactive</option>
                            </select>
                            <span class="alret alert-danger" role="alert">
                                @error('status')
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