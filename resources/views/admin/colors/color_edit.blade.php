@extends('admin/adminLayout/layout')

@section('title', 'Edit Color')

@section('color_select', 'active')

@section('content')


    <h1 class="mb10">Edit Color</h1>

    <a href="{{ route('admin.color') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <br>
    <br>
   
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header text-center">Edit Color</div>

                <div class="card-body">
                    <form action="{{ url('admin/color/update/'.$selected_color->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="color" class="control-label mb-1">Color</label>
                            <input id="color" name="color" value="{{ $selected_color->color }}" type="text" class="form-control" 
                            aria-required="true" aria-invalid="false">
                            <span class="alret alert-danger" role="alert">
                                @error('color')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label mb-1">Staus</label>
                            <select class="form-control" name="status">
                                <option value="1" {{($selected_color->status === 1) ? 'Selected' : ''}}>Active</option>
                                <option value="0" {{($selected_color->status === 0) ? 'Selected' : ''}}>Deactive</option>
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