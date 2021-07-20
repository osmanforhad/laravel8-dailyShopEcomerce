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
                //input validation
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

            public function edit_category($id)
            {
                //fetch Category by id
                $selected_category = Category::find($id);

                if($selected_category) {

                    return view('admin.category_edit', compact('selected_category'));
                }

            }

            public function update_category(Request $request, $id)
            {
        
                //fetch category by id
                $user_input = Category::find($id);
        
                //input validation
                $request->validate([
                    'category_name' => 'required | unique:categories',
                    'category_slug' => 'required'
                ]);
        
        
                $user_input->category_name = $request->input('category_name');
                $user_input->category_slug = $request->input('category_slug');

                 $result = $user_input->update();

                 if($result) {

                    return redirect()->route('admin.category')->with('success', 'Category Updated Successfully');

                 }

            }


            public function destroy_category($id)
            {
                
                $user_request = Category::find($id);

                $user_request->delete();

                if($user_request) {

                    session()->flash('success', 'Category deleted Successfully!');

                    return redirect()->route('admin.category');
                }

            }

   
}
