@extends('admin/adminLayout/layout')

@section('title', 'Edit Product')

@section('product_select', 'active')

@push('styles')
    <style>
    .preview_image_size{
        max-height: 150px;
    }
    </style>
@endpush

@section('content')


    <h1 class="mb10">Edit Product</h1>

    <a href="{{ route('admin.category') }}">
        <button type="button" class="btn btn-success">Back</button>
    </a>
    <br>
    <br>
   
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card">
                <div class="card-header text-center">Edit Product</div>

                <div class="card-body">
                    <form action="{{ url('admin/product/update/'.$selected_product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="control-label mb-1">Name</label>
                            <input id="name" name="name" value="{{ $selected_product->name }}" type="text" class="form-control" 
                            aria-required="true" aria-invalid="false">
                            <span class="alret alert-danger" role="alert">
                                @error('name')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="brnad" class="control-label mb-1">Brand</label>
                            <input id="brand" name="brand" value="{{ $selected_product->brand }}" type="text" class="form-control"
                             aria-required="true" aria-invalid="false">
                             <span class="alret alert-danger" role="alert">
                                @error('brnad')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <!-- Previw uploaded image -->
                        <img id="preview_product_image" src="" class="preview_image_size"/>
                        <div class="form-group">
                            <label for="product_image" class="control-label mb-1">Image</label>
                            <input type="file" name="product_image" class="form-control"
                            aria-required="true" aria-invalid="false" onchange="loadFile(event)">
                                <img src="{{ asset('uploads/products/'.$selected_product->image) }}"
                                     width="70px" height="70px" alt="{{ $selected_product->name }}">
                             <span class="alret alert-danger" role="alert">
                                @error('product_image')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="model" class="control-label mb-1">Model</label>
                            <input id="model" name="model" value="{{ $selected_product->model }}" type="text" class="form-control"
                             aria-required="true" aria-invalid="false">
                             <span class="alret alert-danger" role="alert">
                                @error('model')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="category_id" class="control-label mb-1">Category</label>
                            <select class="form-control" name="category_id">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            <span class="alret alert-danger" role="alert">
                                @error('status')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="short_desc" class="control-label mb-1">Short Description</label>
                            <textarea id="short_desc" name="short_desc" type="text" class="form-control"
                            aria-required="true" aria-invalid="false">{{ $selected_product->short_desc }}</textarea>
                             <span class="alret alert-danger" role="alert">
                                @error('short_desc')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="desc" class="control-label mb-1">Description</label>
                            <textarea id="desc" name="desc" type="text" class="form-control"
                            aria-required="true" aria-invalid="false">{{ $selected_product->desc }}</textarea>
                             <span class="alret alert-danger" role="alert">
                                @error('desc')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="keyword" class="control-label mb-1">Keyword</label>
                            <textarea id="keywords" name="keywords" type="text" class="form-control"
                            aria-required="true" aria-invalid="false">{{ $selected_product->keywords }}</textarea>
                             <span class="alret alert-danger" role="alert">
                                @error('keywords')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="tehnical_spc" class="control-label mb-1">Technical Specifications</label>
                            <textarea id="technical_spc" name="technical_spc" type="text" class="form-control"
                            aria-required="true" aria-invalid="false">{{ $selected_product->technical_spc }}</textarea>
                             <span class="alret alert-danger" role="alert">
                                @error('technical_spc')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="uses" class="control-label mb-1">Uses</label>
                            <textarea id="uses" name="uses" type="text" class="form-control"
                            aria-required="true" aria-invalid="false">{{ $selected_product->uses }}</textarea>
                             <span class="alret alert-danger" role="alert">
                                @error('uses')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="warranty" class="control-label mb-1">Warranty</label>
                            <textarea id="warranty" name="warranty" type="text" class="form-control"
                            aria-required="true" aria-invalid="false">{{ $selected_product->warranty }}</textarea>
                             <span class="alret alert-danger" role="alert">
                                @error('warranty')
                                {{$message}}
                                @enderror
                             </span>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label mb-1">Staus</label>
                            <select class="form-control" name="status">
                                <option value="1" {{($selected_product->status === 1) ? 'Selected' : ''}}>Active</option>
                                <option value="0" {{($selected_product->status === 0) ? 'Selected' : ''}}>Deactive</option>
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

@push('scripts')
<script>
    var loadFile = function(event) {
        var preview_product_image = document.getElementById('preview_product_image');
        preview_product_image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endpush