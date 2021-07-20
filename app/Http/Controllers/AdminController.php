<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
            public function index(Request $request)
            {
                if($request->session()->has('ADMIN_LOGIN')) {

                    return redirect()->route('admin.dashboard');
                    
                } else {

                    return view('admin.login');
                }

                return view('admin.login');
            }


            public function auth(Request $request)
            {
                $email = $request->post('email');
                $password = $request->post('password');

                //$result = Admin::where(['email' => $email, 'password' => $password])->get();

                $result = Admin::where(['email' => $email ])->first();

                if($result) {

                    if(Hash::check($request->post('password'), $result->password)) {

                        $request->session()->put('ADMIN_LOGIN', true);

                        $request->session()->put('ADMIN_ID', $result->id);
    
                        return redirect('admin/dashboard');

                    } else {

                        $request->session()->flash('error', 'Please enter valid Password!');
                        return redirect('admin');

                    }

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

                /** to dot it please access below rul
                 * and then it will works 
                 * 
                 * http://localhost:8000/admin/password_encript
                 * 
                 * because
                 * 
                 * there no any view for dot it
                 * thats why need to access url to do it
                 */

            }

            public function logoutAdmin()
            {
                session()->forget('ADMIN_LOGIN', true);

                session()->forget('ADMIN_ID');

                session()->flash('success-message', 'Logout successfully!');
    
                return redirect()->route('admin.login');
            }

}
