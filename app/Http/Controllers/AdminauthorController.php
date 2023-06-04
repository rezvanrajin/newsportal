<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Author;
use Hash;
use Auth;
use App\Mail\Websitemail;


class AdminauthorController extends Controller
{
    public function AuthorShow()
    {
        $author = Author::get();
    return view('backend.admin.author.author_show',compact('author'));
    }
    public function AuthorCreate()
    {
        return view('backend.admin.author.author_create');
    }
    public function AuthorStore(Request $request)
    {
        $author = new Author();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:authors',
            'password' => 'required',
            'retype_password' => 'required|same:password',
        ]);

        if($request->hasFile('photo'))
        {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            $now = time();
            $ext = $request->file('photo')->extension();
            $final_name = 'author_photo'.$now.'.'.$ext;
            $request->file('photo')->move(public_path('uploads/'),$final_name);
            $author->photo = $final_name;
        }
         
        $author->name = $request->name;
        $author->email = $request->email;
        $author->password = Hash::make($request->password);
        $author->token = '';
        $author->save();

                    // Send email
                    $subject = 'Your account is created to this website';
                    $message = 'Hi, Your acount is created successfully and you can login in our system from the frontend login website as author';
                    $message .= '<a href="'.route('Login').'">';
                    $message .= 'Click on this link';
                    $message .= '</a>';
                    $message .= '<br><br>Please see your password here after login change it immediately:<br>';
                    $message .= $request->password;



                    \Mail::to($request->email)->send(new Websitemail($subject,$message));
        
        return redirect()->back()->with('success','Your Author Add Sucessfully');        
    }
    public function AuthorEdit($id)
    {
        $author = Author::where('id',$id)->first();
        return view('backend.admin.author.author_edit',compact('author'));   
    }

    public function AuthorUpdate(Request $request,$id)
        {
            $author = Author::where('id',$id)->first();

            $request->validate([
                'name' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('authors')->ignore($author->id)
                ]

            ]);


            if($request->password!='')
            {
                $request->validate([

                    'password' => 'required',
                    'retype_password' => 'required|same:password',
                ]);

                $author->password = hash::make($request->password);
            }

            if($request->hasFile('photo'))
            {
                $request->validate([
                    'photo' => 'image|mimes:jpg,jpeg,png,gif'
                ]);
                unlink(public_path('uploads/'.$author->photo));

                $now = time();
                $ext = $request->file('photo')->extension();
                $final_name = 'author_photo_'.$now. '.'.$ext;
                $request->file('photo')->move(public_path('uploads/').$final_name);
                $author->photo = $final_name;
            }

            
            $author->name = $request->name;
            $author->email = $request->email;
            $author->update();
            return redirect()->route('AuthorShow')->with('success','Author Is Updated');

        }

        public function AuthorDelete($id)
        {
                $author = Author::where('id',$id)->first();
            if($author->photo != NULL)
            {
                unlink(public_path('uploads/'.$author->photo));

            }
                $author->delete();
                return redirect()->route('AuthorShow')->with('success','Author Is Deleted');
    
    
        }
}
