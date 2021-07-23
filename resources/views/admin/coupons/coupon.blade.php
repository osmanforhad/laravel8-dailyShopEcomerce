@extends('admin/adminLayout/layout')

@section('title', 'Manage Coupon')

@section('coupon_select', 'active')

@section('content')


    <h1 class="mb10">Coupon</h1>

    <a href="{{ route('admin.createCoupon') }}">
        <button type="button" class="btn btn-success">Add Coupon</button>
    </a>


    <div class="result">
        @if (Session::has('success'))
           <span class="alert alert-success" role="alert">
            {{ Session::get('success') }}
           </span>
        @endif
    </div>


    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                @if (count($coupons) > 0)
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $custom_id = 1;
                        @endphp

                       @foreach ($coupons as $coupon)
                       <tr>
                           <td>{{ $custom_id++ }}</td>
                           <td>{{ $coupon->title }}</td>
                           <td>{{ $coupon->code }}</td>
                           <td>{{ $coupon->value }}</td>
                           <td>
                               <a href="{{ url('admin/coupon/edit/'.$coupon->id) }}" class="btn btn-primary btn-sm">Edit</a>

                               {{-- <a href="{{url('admin/coupon/delete/')}}/{{$coupon->id}}">
                                   <button type="button" class="btn btn-danger">Delete</button>
                               </a> --}}
                                           <form action="{{ url('admin/coupon/delete/'.$coupon->id) }}" method="POST" style="margin-top:10px;">
                                               @csrf
                                               @method('DELETE')
                                               <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                           </form>
                           </td>
                       </tr>
                       @endforeach
                    </tbody>
                </table>
                @else
                <h4 class="text-center">There is no record in our Database</h4>
                <hr>
            @endif
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection