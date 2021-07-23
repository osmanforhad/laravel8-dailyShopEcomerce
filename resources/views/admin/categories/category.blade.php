@extends('admin/adminLayout/layout')

@section('title', 'Manage Category')

@section('category_select', 'active')

@section('content')


    <h1 class="mb10">Category</h1>

    <a href="{{ route('admin.createCategory') }}">
        <button type="button" class="btn btn-success">Add Category</button>
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
                @if (count($categories) > 0)
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $custom_id = 1;
                        @endphp

                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $custom_id++ }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->category_slug }}</td>
                            <td>
                                <a href="{{ url('admin/category/edit/'.$category->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                {{-- <a href="{{url('admin/category/delete/')}}/{{$category->id}}">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a> --}}
                                            <form action="{{ url('admin/category/delete/'.$category->id) }}" method="POST" style="margin-top:10px;">
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