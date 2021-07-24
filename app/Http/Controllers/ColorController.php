<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
            public function index()
            {
                $colors = Color::orderBy('created_at', 'DESC')->get()->all();

                return view('admin/colors/color', [
                    'colors' => $colors
                ]);

                
            }


            public function color_create()
            {
                return view('admin/colors/create_color');
            }


            public function store_color(Request $request)
            {
                //input validation
                $request->validate([
                    'color' => 'required | unique:colors',
                    'status' => 'required'
                ]);

                $userInput = new Color();

                $userInput->color = $request->input('color');
                $userInput->status = $request->input('status');

                $result = $userInput->save();

                if($result) {

                    session()->flash('success', 'Color created Successfully!');

                    return redirect()->route('admin.color');
                    
                }

            }

            public function edit_color($id)
            {
                //fetch color by id
                $selected_color = Color::find($id);

                if($selected_color) {

                    return view('admin.colors.color_edit', compact('selected_color'));
                }

            }

            public function update_color(Request $request, $id)
            {

                //find color by id
            $user_input = Color::find($id);

            //input validation
            $request->validate([
                'color' => 'required | unique:colors',
                'status' => 'required',
            ]);


            $user_input->color = $request->input('color');
            $user_input->status = $request->input('status');

            $result = $user_input->update();

                if($result) {

                    return redirect()->route('admin.color')->with('success', 'Color Updated Successfully');

                }

            }


            public function destroy_color($id)
            {
                
                $user_request = Color::find($id);

                $user_request->delete();

                if($user_request) {

                    session()->flash('success', 'Color deleted Successfully!');

                    return redirect()->route('admin.color');
                }

            }
}
