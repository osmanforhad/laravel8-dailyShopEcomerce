@extends('admin/layout')

@section('title', 'Manage Category')

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
                            <td></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection