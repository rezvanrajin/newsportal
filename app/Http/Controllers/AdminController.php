<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Mail\Websitemail;
use Hash;
use Auth;
class AdminController extends Controller
{
    public function index()
    {
    
        return view('backend.admin.admin_home');
    }
    
    public function AdminLogin()
    {

        return view('backend.login.login');
    }

    
    public function AdminLoginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $credential =
                [
                    'email' => $request->email,
                    'password' => $request->password
                ];
              
        if(Auth::guard('admin')->attempt($credential))
        {
            return redirect(route('Admin')); 
        }
        else 
        {
            return redirect()->route('AdminLogin')->with('error','Information is not corret!');
        }
    }
    
    public function AdminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('AdminLogin'));
    }
        
    public function ForgetPassword()
    {
        return view('backend.login.forget_password');
    }


    public function ForgetPasswordPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            
        ]);
        $admin = Admin::where('email', $request->email)->first();
        if(!$admin){
            return redirect()->back()->with('error','Email Address not found');
        }

        $token = hash('sha256',time());

        $admin->token = $token;
        $admin->update();

        $reset_link = url('admin/reset-password/'.$token.'/'.$request->email);
        $subject = 'Reset Password';
        $message = 'Please clik on this link: <br>';
        $message = '<a href="' . $reset_link . '">Click here</a>';

        \Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->route('AdminLogin')->with('success','Please check your email and follow the step');
    
    }

    public function ForgetResetPassword($token,$email)
    {
       $admin = Admin::where('token', $token)->where('email', $email)->first();
        if (!$admin) {
            return redirect()->route('AdminLogin');
        }

        return view('backend.login.reset_password',compact('token','email'));
    }

    public function ResetPasswordPost(Request $request)
    {
        $request->validate([
            'password' => 'required',  
            'confrim_password' => 'required|same:password',  
            
        ]);

        $admin = Admin::where('token',$request->token)->where('email',$request->email)->first();
        
        $admin->password = Hash::make($request->password);
        $admin->token = '';
        $admin->update();

        return redirect()->route('AdminLogin')->with('success','Password is Reset Successefully');
    }
}
