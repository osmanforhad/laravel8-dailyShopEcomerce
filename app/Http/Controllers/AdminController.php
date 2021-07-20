<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
            public function index()
            {
                return view('admin.login');
            }


            public function auth(Request $request)
            {
                $email = $request->post('email');
                $password = $request->post('password');

                $result = Admin::where(['email' => $email, 'password' => $password])->get();

                if(isset($result['0']->id)) {

                    $request->session()->put('ADMIN_LOGIN', true);

                    $request->session()->put('ADMIN_ID', $result['0']->id);

                    return redirect('admin/dashboard');

                } else {
                    $request->session()->flash('error', 'Please enter valid login credentials!');
                    return redirect('admin');
                }
               
            }

            public function AdminDashboard()
            {
                return view('admin.dashboard');
            }

            public function updatePassword()
            {
                $result = Admin::find(1);

                $result->password = Hash::make('12345678');

                $result->save();

                if($result){
                    
                    echo "Your password is updated with encryption!!";
                }

            }

}
