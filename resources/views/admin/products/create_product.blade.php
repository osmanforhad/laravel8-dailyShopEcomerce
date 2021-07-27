@extends('admin/adminLayout/layout')
@section('title', 'Create Product')
@section('product_select', 'active')
@push('styles')
<style>
   .preview_image_size{
   max-height: 150px;
   }
</style>
@endpush
@section('content')
<h1 class="mb10">Create Product</h1>
<a href="{{ route('admin.category') }}">
<button type="button" class="btn btn-success">All Product</button>
</a>
<br>
<br>
<div class="row">
   <div class="col-md-12">
      <form action="{{ route('product.save') }}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="card">
            <div class="card-header text-center">Add Product</div>
            <div class="card-body">
               <div class="form-group">
                  <label for="name" class="control-label mb-1">Name</label>
                  <input id="name" name="name" type="text" class="form-control" 
                     aria-required="true" aria-invalid="false">
                  <span class="alret alert-danger" role="alert">
                  @error('name')
                  {{$message}}
                  @enderror
                  </span>
               </div>
               {{-- 
               <div class="form-group">
                  <label for="slug" class="control-label mb-1">Slug</label>
                  <input id="slug" name="slug" type="text" class="form-control"
                     aria-required="true" aria-invalid="false">
                  <span class="alret alert-danger" role="alert">
                  @error('slug')
                  {{$message}}
                  @enderror
                  </span>
               </div>
               --}}
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label for="category_id" class="control-label mb-1">Category</label>
                        <select class="form-control" name="category_id">
                           <option value="">Select Category</option>
                           @foreach ($categories as $category)
                           <option value="{{$category->id}}">{{$category->category_name}}</option>
                           @endforeach
                        </select>
                        <span class="alret alert-danger" role="alert">
                        @error('category_id')
                        {{$message}}
                        @enderror
                        </span>
                     </div>
                     <div class="col-md-4">
                        <label for="brand" class="control-label mb-1">Brand</label>
                        <input id="brand" name="brand" type="text" class="form-control"
                           aria-required="true" aria-invalid="false">
                        <span class="alret alert-danger" role="alert">
                        @error('brand')
                        {{$message}}
                        @enderror
                        </span>
                     </div>
                     <div class="col-md-4">
                        <label for="model" class="control-label mb-1">Model</label>
                        <input id="model" name="model" type="text" class="form-control"
                           aria-required="true" aria-invalid="false">
                        <span class="alret alert-danger" role="alert">
                        @error('model')
                        {{$message}}
                        @enderror
                        </span>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label for="product_image" class="control-label mb-1">Image</label>
                        <input id="product_image" name="product_image" type="file" class="form-control"
                           aria-required="true" aria-invalid="false" onchange="loadFile(event)">
                        <span class="alret alert-danger" role="alert">
                        @error('product_image')
                        {{$message}}
                        @enderror
                        </span>
                     </div>
                     <div class="col-md-4">
                        <!-- Previw uploaded image -->
                        <img id="preview_product_image" src="" class="preview_image_size"/>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="row">

                      <div class="col-md-6">
                        <label for="short_desc" class="control-label mb-1">Short Description</label>
                        <textarea id="short_desc" name="short_desc" type="text" class="form-control"
                           aria-required="true" aria-invalid="false"></textarea>
                        <span class="alret alert-danger" role="alert">
                        @error('short_desc')
                        {{$message}}
                        @enderror
                        </span>
                      </div>

                      <div class="col-md-6">
                        <label for="desc" class="control-label mb-1">Description</label>
                        <textarea id="desc" name="desc" type="text" class="form-control"
                           aria-required="true" aria-invalid="false"></textarea>
                        <span class="alret alert-danger" role="alert">
                        @error('desc')
                        {{$message}}
                        @enderror
                        </span>
                      </div>

                  </div>
               </div>
            
               <div class="form-group">
                  <div class="row">

                      <div class="col-md-6">
                        <label for="keyword" class="control-label mb-1">Keyword</label>
                        <textarea id="keywords" name="keywords" type="text" class="form-control"
                           aria-required="true" aria-invalid="false"></textarea>
                        <span class="alret alert-danger" role="alert">
                        @error('keywords')
                        {{$message}}
                        @enderror
                        </span>
                      </div>

                      <div class="col-md-6">
                        <label for="tehnical_spc" class="control-label mb-1">Technical Specifications</label>
                        <textarea id="technical_spc" name="technical_spc" type="text" class="form-control"
                           aria-required="true" aria-invalid="false"></textarea>
                        <span class="alret alert-danger" role="alert">
                        @error('technical_spc')
                        {{$message}}
                        @enderror
                        </span>
                      </div>

                  </div>
               </div>
               
               <div class="form-group">
                  <div class="row">

                      <div class="col-md-6">
                        <label for="uses" class="control-label mb-1">Uses</label>
                        <textarea id="uses" name="uses" type="text" class="form-control"
                           aria-required="true" aria-invalid="false"></textarea>
                        <span class="alret alert-danger" role="alert">
                        @error('uses')
                        {{$message}}
                        @enderror
                        </span>
                      </div>

                      <div class="col-md-6">
                        <label for="warranty" class="control-label mb-1">Warranty</label>
                        <textarea id="warranty" name="warranty" type="text" class="form-control"
                           aria-required="true" aria-invalid="false"></textarea>
                        <span class="alret alert-danger" role="alert">
                        @error('warranty')
                        {{$message}}
                        @enderror
                        </span>
                      </div>

                  </div>
               </div>
               
               <div class="form-group">
                  <div class="row">
                      <div class="col-md-4 offset-4">
                        <label for="status" class="control-label mb-1">Status</label>
                        <select class="form-control" name="status">
                           <option value="1">Active</option>
                           <option value="0">Deactive</option>
                        </select>
                        <span class="alret alert-danger" role="alert">
                        @error('status')
                        {{$message}}
                        @enderror
                        </span>
                      </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Product Attribute Card will start from here -->
         <div class="card">
            <div class="card-header text-center">Add Product Attribute</div>
            <div class="card-body">
            </div>
         </div>
         <div>
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
            Save
            </button>
         </div>
      </form>
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