<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
            public function index()
            {
                $categories = Category::orderBy('created_at', 'DESC')->get()->all();

                return view('admin/category', [
                    'categories' => $categories
                ]);

                //return view('admin/category', $categories);
            }

    
            public function category_create()
            {
                return view('admin/create_category');
            }

  
            public function store_category(Request $request)
            {
                $request->validate([
                    'category_name' => 'required | unique:categories',
                    'category_slug' => 'required | unique:categories'
                ]);

                $userInput = new Category();

                $userInput->category_name = $request->input('category_name');
                $userInput->category_slug = $request->input('category_slug');

                $userInput->save();

                if($userInput) {

                    session()->flash('success', 'Category created Successfully!');

                    return redirect()->route('admin.category');
                    
                }

            }

            public function destroy_category(Request $request, $id)
            {
                
                $user_request = Category::find($id);

                $user_request->delete();

                if($user_request) {

                    session()->flash('success', 'Category deleted Successfully!');

                    return redirect()->route('admin.category');
                }

            }

   
}
