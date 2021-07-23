@extends('admin/adminLayout/layout')

@section('title', 'Create Coupon')

@section('content')


    <h1 class="mb10">Create Coupon</h1>

    <a href="{{ route('admin.coupon') }}">
        <button type="button" class="btn btn-success">All Coupon</button>
    </a>
    <br>
    <br>
   
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header text-center">Add Coupons</div>

                <div class="card-body">
                    <form action="{{ route('coupon.save') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="control-label mb-1">Title</label>
                            <input id="title" name="title" type="text" class="form-control" 
                            aria-required="true" aria-invalid="false">
                            <span class="alret alert-danger" role="alert">
                                @error('title')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="code" class="control-label mb-1">Code</label>
                            <input id="code" name="code" type="text" class="form-control"
                             aria-required="true" aria-invalid="false">
                             <span class="alret alert-danger" role="alert">
                                @error('code')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="value" class="control-label mb-1">Value</label>
                            <input id="value" name="value" type="text" class="form-control"
                             aria-required="true" aria-invalid="false">
                             <span class="alret alert-danger" role="alert">
                                @error('value')
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