<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
   
                public function index()
                {
                    $sizes = Size::orderBy('created_at', 'DESC')->get()->all();

                    return view('admin/sizes/size', [
                        'sizes' => $sizes
                    ]);

                    
                }


                public function size_create()
                {
                    return view('admin/sizes/create_size');
                }


                public function store_size(Request $request)
                {
                    //input validation
                    $request->validate([
                        'size' => 'required | unique:sizes',
                        'status' => 'required'
                    ]);

                    $userInput = new Size();

                    $userInput->size = $request->input('size');
                    $userInput->status = $request->input('status');

                    $result = $userInput->save();

                    if($result) {

                        session()->flash('success', 'Size created Successfully!');

                        return redirect()->route('admin.size');
                        
                    }

                }

                public function edit_size($id)
                {
                    //fetch size by id
                    $selected_size = Size::find($id);

                    if($selected_size) {

                        return view('admin.sizes.size_edit', compact('selected_size'));
                    }

                }

                public function update_size(Request $request, $id)
                {

                     //find size by id
                $user_input = Size::find($id);
        
                //input validation
                $request->validate([
                    'size' => 'required | unique:sizes',
                    'status' => 'required',
                ]);
        
        
                $user_input->size = $request->input('size');
                $user_input->status = $request->input('status');

                 $result = $user_input->update();

                    if($result) {

                        return redirect()->route('admin.size')->with('success', 'Size Updated Successfully');

                    }

                }


                public function destroy_size($id)
                {
                    
                    $user_request = Size::find($id);

                    $user_request->delete();

                    if($user_request) {

                        session()->flash('success', 'Size deleted Successfully!');

                        return redirect()->route('admin.size');
                    }

                }

}
