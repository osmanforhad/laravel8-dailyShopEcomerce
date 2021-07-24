@extends('admin/adminLayout/layout')

@section('title', 'Manage Sizes')

@section('size_select', 'active')

@section('content')


    <h1 class="mb10">Sizes</h1>

    <a href="{{ route('admin.createSize') }}">
        <button type="button" class="btn btn-success">Add Sizes</button>
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
                @if (count($sizes) > 0)
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Size</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $custom_id = 1;
                        @endphp

                       @foreach ($sizes as $size)
                       <tr>
                           <td>{{ $custom_id++ }}</td>
                           <td>{{ $size->size }}</td>
                           <td>
                            @if ($size->status === 1)
                            <p class="alert alert-success" role="alert"><b>Active</b></p>
                              @else
                              <p class="alert alert-danger" role="alert">Deactive</p>
                            @endif
                            </td>
                           <td>
                               <a href="{{ url('admin/size/edit/'.$size->id) }}" class="btn btn-primary btn-sm">Edit</a>

                               {{-- <a href="{{url('admin/size/delete/')}}/{{$size->id}}">
                                   <button type="button" class="btn btn-danger">Delete</button>
                               </a> --}}
                                           <form action="{{ url('admin/size/delete/'.$size->id) }}" method="POST" style="margin-top:10px;">
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