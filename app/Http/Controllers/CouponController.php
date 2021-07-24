<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
                public function index()
                {
                    $coupons = Coupon::orderBy('created_at', 'DESC')->get()->all();

                    return view('admin/coupons/coupon', [
                        'coupons' => $coupons
                    ]);

                    
                }


                public function coupon_create()
                {
                    return view('admin/coupons/create_coupon');
                }


                public function store_coupon(Request $request)
                {
                    //input validation
                    $request->validate([
                        'title' => 'required | unique:coupons',
                        'code' => 'required | unique:coupons',
                        'value' => 'required',
                        'coupon_status' => 'required'
                    ]);

                    $userInput = new Coupon();

                    $userInput->title = $request->input('title');
                    $userInput->code = $request->input('code');
                    $userInput->value = $request->input('value');
                    $userInput->coupon_status = $request->input('coupon_status');

                    $result = $userInput->save();

                    if($result) {

                        session()->flash('success', 'Coupon created Successfully!');

                        return redirect()->route('admin.coupon');
                        
                    }

                }

                public function edit_coupon($id)
                {
                    //fetch Coupon by id
                    $selected_coupon = Coupon::find($id);

                    if($selected_coupon) {

                        return view('admin.coupons.coupon_edit', compact('selected_coupon'));
                    }

                }

                public function update_coupon(Request $request, $id)
                {

                     //find coupon by id
                $user_input = Coupon::find($id);
        
                //input validation
                $request->validate([
                    'title' => 'required | unique:coupons',
                    'code' => 'required',
                    'value' => 'required',
                    'coupon_status' => 'required',
                ]);
        
        
                $user_input->title = $request->input('title');
                $user_input->code = $request->input('code');
                $user_input->value = $request->input('value');
                $user_input->coupon_status = $request->input('coupon_status');

                 $result = $user_input->update();

                    if($result) {

                        return redirect()->route('admin.coupon')->with('success', 'Coupon Updated Successfully');

                    }

                }


                public function destroy_coupon($id)
                {
                    
                    $user_request = Coupon::find($id);

                    $user_request->delete();

                    if($user_request) {

                        session()->flash('success', 'Coupon deleted Successfully!');

                        return redirect()->route('admin.coupon');
                    }

                }
}
