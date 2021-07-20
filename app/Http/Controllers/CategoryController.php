<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
            public function index()
            {
                return view('admin/category');
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
