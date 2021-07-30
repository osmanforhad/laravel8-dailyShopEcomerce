@extends('admin/adminLayout/layout')

@section('title', 'Manage Product')

@section('product_select', 'active')

@section('content')


    <h1 class="mb10">Product</h1>

    <a href="{{ route('admin.createProduct') }}">
        <button type="button" class="btn btn-success">Add Product</button>
    </a>

    @if (Session::has('success'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                {{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif


    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                @if (count($products) > 0)
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Brand</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $custom_id = 1;
                        @endphp

                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $custom_id++ }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{$product->fetchCategoryFromCategoryTable->category_name}}</td>
                            <td>
                                <img src="{{ asset('uploads/products/feturePhoto/'.$product->image) }}"
                                     width="70px" height="70px" alt="{{ $product->name }}">
                            </td>
                            <td>{{ $product->brand }}</td>
                            <td>
                            @if ($product->status === 1)
                            <p class="alert alert-success" role="alert"><b>Active</b></p>
                              @else
                              <p class="alert alert-danger" role="alert">Deactive</p>
                            @endif
                            </td>

                            <td>
                                <a href="{{ url('admin/product/edit/'.$product->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                {{-- <a href="{{url('admin/product/delete/')}}/{{$product->id}}">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a> --}}
                                            <form action="{{ url('admin/product/delete/'.$product->id) }}" method="POST" style="margin-top:10px;">
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