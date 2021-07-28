<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    
                public function index()
                {
                    $products = Product::orderBy('created_at', 'DESC')->get()->all();

                    return view('admin.products.product', [
                        'products' => $products
                    ]);
                }

                public function product_create()
                {
                    //fetch category
                    $categories = Category::where('category_status', 'active')->get();

                    //fetch color
                    $colors = Color::where('status', 1)->get();

                    //fetch size
                    $sizes = Size::where('status', 1)->get();
                    

                    return view('admin/products/create_product', [

                        'categories' => $categories,
                        'colors' => $colors,
                        'sizes' => $sizes,
                    ]);
                }

      
                public function store_product(Request $request)
                {
                    // return $request->post();
                    // die();

                    //input validation
                    $request->validate([
                        'name' => 'required | unique:products',
                        //'slug' => 'required | unique:products',
                        'category_id' => 'required',
                        'brand' => 'required',
                        'product_image' => 'required | mimes:jpeg,png,jpg',
                        'model' => 'required',
                        'short_desc' => 'required',
                        'desc' => 'required',
                        'keywords' => 'required',
                        'technical_spc' => 'required',
                        'uses' => 'required',
                        'warranty' => 'required',
                        'status' => 'required'
                    ]);
    
                    $userInput = new Product();

                   
    
                     $userInput->name = $request->input('name'); 
                     //$userInput->name = $request->input('slug'); 
                     $userInput->slug = Str::slug($userInput->name, '_');
                     $userInput->category_id = $request->input('category_id');
                     $userInput->brand = $request->input('brand');
                     $userInput->model = $request->input('model');
                     $userInput->short_desc = $request->input('short_desc');
                     $userInput->desc = $request->input('desc');
                     $userInput->keywords = $request->input('keywords');
                     $userInput->technical_spc = $request->input('technical_spc');
                     $userInput->uses = $request->input('uses');
                     $userInput->warranty = $request->input('warranty');
                     $userInput->status = $request->input('status');

                    if ($request->hasFile('product_image')) {
                        $file = $request->file('product_image');
                        //get file extension
                        $extension = $file->getClientOriginalExtension();
                        //setup file name
                        $fileName = $userInput->name . '.' . $extension;
                        //upload file into the folder
                        $file->move('uploads/products/', $fileName);
                        //store the image data into db
                        $userInput->image = $fileName;
                    }
    
                    $result = $userInput->save();

                    //take saved product id to insert into product_attributes table
                    $SavedProductIdForAttributeTable = $userInput->id;

                    /**Start Logic for save product attributes */

                    $prodcutAttrArr = new ProductAttribute();

                    $skuArray = $request->input('sku');
                    $mrpArray = $request->input('mrp');
                    $priceArray = $request->input('price');
                    $qtyArray = $request->input('qty');
                    $color_idArray = $request->input('color_id');
                    $size_idArray = $request->input('size_id');
                    

                    foreach($skuArray as $key => $value) {

                        $prodcutAttrArr['product_id'] = $SavedProductIdForAttributeTable;
                        $prodcutAttrArr['sku'] = $skuArray[$key];
                        $prodcutAttrArr['image'] = 'test image';
                        $prodcutAttrArr['mrp'] = $mrpArray[$key];
                        $prodcutAttrArr['price'] = $priceArray[$key];
                        $prodcutAttrArr['qty'] = $qtyArray[$key];
                        $prodcutAttrArr['color_id'] = $color_idArray[$key];
                        $prodcutAttrArr['size_id'] = $size_idArray[$key];
                        
                        $resultAttr = $prodcutAttrArr->save();
                    }
                    
                    /**End Logic for product attributes */
    
                    if($result && $resultAttr) {
    
                        session()->flash('success', 'Product created Successfully! With Attributes');
    
                        return redirect()->route('admin.product');
                        
                    }
    
                }
    
                public function edit_product($slug)
                {
                    //fetch category
                    $categories = Category::where('category_status', 'active')->get();

                    //fetch product by id
                    $selected_product = Product::where('slug', $slug)->first();
    
                    if($selected_product) {
    
                        return view('admin.products.product_edit', [

                            'categories' => $categories,
                            'selected_product' => $selected_product

                        ]);
                    }
    
                }
    
                public function update_product(Request $request, $id)
                {
            
                    //fetch product by id
                    $user_input = Product::find($id);
            
                  //input validation
                  $request->validate([
                    'name' => 'required | unique:products',
                    //'slug' => 'required | unique:products',
                    'category_id' => 'required',
                    'brand' => 'required',
                    'product_image' => 'required | mimes:jpeg,png,jpg',
                    'model' => 'required',
                    'short_desc' => 'required',
                    'desc' => 'required',
                    'keywords' => 'required',
                    'technical_spc' => 'required',
                    'uses' => 'required',
                    'warranty' => 'required',
                    'status' => 'required'
                ]);
            
            
                    $user_input->name = $request->input('name'); 
                    //$user_input->name = $request->input('slug'); 
                    $user_input->slug = Str::slug($user_input->name, '_');
                    $user_input->category_id = $request->input('category_id');
                    $user_input->brand = $request->input('brand');
                    $user_input->model = $request->input('model');
                    $user_input->short_desc = $request->input('short_desc');
                    $user_input->desc = $request->input('desc');
                    $user_input->keywords = $request->input('keywords');
                    $user_input->technical_spc = $request->input('technical_spc');
                    $user_input->uses = $request->input('uses');
                    $user_input->warranty = $request->input('warranty');
                    $user_input->status = $request->input('status');

                    if ($request->hasFile('product_image')) {

                        //define alreday exists image and delete it
                        $destination = 'uploads/products/' . $user_input->image;
                        if (File::exists($destination)) {
                            
                            File::delete($destination);
                        }
            
                        $file = $request->file('product_image');
                        //get file extension
                        $extension = $file->getClientOriginalExtension();
                        //setup file name
                        $fileName = $user_input->name . '.' . $extension;
                        //upload file into the folder
                        $file->move('uploads/products/', $fileName);
                        //store the image data into db
                        $user_input->image = $fileName;
                    }
    
                    $result = $user_input->update();
    
                     if($result) {
    
                        return redirect()->route('admin.product')->with('success', 'Product Updated Successfully');
    
                     }
    
                }
    
    
                public function destroy_product($id)
                {
                    
                    $user_request = Product::find($id);

                //define alreday exists image and delete it
                    $destination = 'uploads/products/' . $user_request->image;
                    if (File::exists($destination)) {
                        File::delete($destination);
                    }
    
                   $result = $user_request->delete();
    
                    if($result) {
    
                        session()->flash('success', 'Product deleted Successfully!');
    
                        return redirect()->route('admin.product');
                    }
    
                }

}
