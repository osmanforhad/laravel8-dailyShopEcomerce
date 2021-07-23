@extends('admin/adminLayout/layout')

@section('title', 'Edit Coupon')

@section('content')


    <h1 class="mb10">Edit Coupon</h1>

    <a href="{{ route('admin.coupon') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <br>
    <br>
   
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header text-center">Edit Coupon</div>

                <div class="card-body">
                    <form action="{{ url('admin/coupon/edit/'.$selected_coupon->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title" class="control-label mb-1">Title</label>
                            <input id="title" name="title" value="{{ $selected_coupon->title }}" type="text" class="form-control" 
                            aria-required="true" aria-invalid="false">
                            <span class="alret alert-danger" role="alert">
                                @error('title')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="code" class="control-label mb-1">Code</label>
                            <input id="code" name="code" value="{{ $selected_coupon->code }}" type="text" class="form-control"
                             aria-required="true" aria-invalid="false">
                             <span class="alret alert-danger" role="alert">
                                @error('code')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="value" class="control-label mb-1">Value</label>
                            <input id="value" name="value" value="{{ $selected_coupon->value }}" type="text" class="form-control"
                             aria-required="true" aria-invalid="false">
                             <span class="alret alert-danger" role="alert">
                                @error('value')
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