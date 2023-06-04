<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Mail\Websitemail;
use App\Models\Page;
use App\Models\Language;
use App\Models\Author;
use App\Helper\Helpers;


class AuthorloginController extends Controller
{
    public function Login()
    {
        Helpers::read_json();
        if (!session()->get('lang_short_name'))
        {
            $current_short_name = Language::where('is_default','Yes')->first()->short_name;
        }

        else
        {
            $current_short_name = session()->get('lang_short_name');

        }
     

       
           $current_language_id = Language::where('short_name',$current_short_name)->first()->id;
      
        $page = Page::where('language_id',$current_language_id)->first();
        return view('frontend.login',compact('page'));
    }
    public function LoginPost(Request $request)
    {
        Helpers::read_json();

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => ERROR_EMAIL_REQUIRED,
            'email.email' => ERROR_EMAIL_VALID,
            'password.required' => ERROR_PASSWORD_REQUIRED
        ]);
        
        $credential =
                [
                    'email' => $request->email,
                    'password' => $request->password
                ];
              
        if(Auth::guard('author')->attempt($credential))
        {
            return redirect(route('Author_home')); 
        }
        else 
        {
            return redirect()->route('Login')->with('error','Information is not corret!');
        }
    }
    
    public function AuthorHome()
    {
        return view('backend.author.home');
    }
    public function Logout()
    {
        Auth::guard('author')->logout();
        return redirect(route('Login'));
    }
    public function AuthorProfile()
    {
    
        return view('backend.author.author.profile');
    }

    public function AuthorProfilleUpdate(Request $request)
    {
        $author = Author::where('email',Auth::guard('author')->user()->email)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if($request->password!='')
        {
            $request->validate([
                'password' => 'required',
                'retype_password' => 'required',
            ]);
            $author->password = Hash::make($request->password);
        }
        if($request->hasFile('photo'))
        {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            unlink(public_path('uploads/'.$author->photo));

            $now = time();
            $ext = $request->file('photo')->extension();
            $final_name = 'author'.$now.'.'.$ext;
            $request->file('photo')->move(public_path('uploads/').$final_name);

            $author->photo = $final_name;
        }

        $author->name = $request->name;
        $author->email = $request->email;
        $author->update();

        return redirect()->back()->with('success','Profile Information Is Updated Successfully');
    }
    public function AuthorForgetPassword()
    {
        Helpers::read_json();
        return view('frontend.forget_password');
    }


    public function AuthorForgetPasswordPost(Request $request)
    {
        Helpers::read_json();

        $request->validate([
            'email' => 'required|email',
            
        ],[
            'email.required' => ERROR_EMAIL_REQUIRED,
            'email.email' => ERROR_EMAIL_VALID,
        ]);
        $author = Author::where('email', $request->email)->first();
        if(!$author){
            return redirect()->back()->with('error',ERROR_EMAIL_NOT_FOUND);
        }

        $token = hash('sha256',time());

        $author->token = $token;
        $author->update();

        $reset_link = url('reset-password/'.$token.'/'.$request->email);
        $subject = 'Reset Password';
        $message = 'Please clik on this link: <br>';
        $message = '<a href="' . $reset_link . '">Click here</a>';

        \Mail::to($request->email)->send(new Websitemail($subject, $message));
        return redirect()->route('Login')->with('success',SUCCESS_FORGET_PASSWORD);
    
    }

    public function AuthorForgetResetPassword($token,$email)
    {   
        Helpers::read_json(); 
       $author = Author::where('token', $token)->where('email', $email)->first();
        if (!$author) {
            return redirect()->route('Login');
        }
        return view('frontend.reset_password',compact('token','email'));
    }

    public function AuthorResetPasswordPost(Request $request)
    {
        Helpers::read_json(); 

        $request->validate([
            'password' => 'required',  
            'retype_password' => 'required|same:password',  
            
        ],[
            'password.required' => ERROR_PASSWORD_REQUIRED,
            'retype_password.required' => ERROR_RETYPE_PASSWORD_REQUIRED,
            'retype_password.same' => ERROR_RETYPE_PASSWORD_SAME

        ]);

        $author = Author::where('token',$request->token)->where('email',$request->email)->first();
        
        $author->password = Hash::make($request->password);
        $author->token = '';
        $author->update();

        return redirect()->route('Login')->with('success',SUCCESS_RESET_PASSWORD);
    }

}
