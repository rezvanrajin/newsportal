<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Mail\Websitemail;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subscriber;
use DB;
use Auth;
use Hash;

class AuthorController extends Controller
{
    public function Authorpost()
    {
        $post = Post::with('subcategory.category')->where('author_id',Auth::guard('author')->user()->id)->get();
        return view('backend.author.post.post_view',compact('post'));

    }

    public function AuthorpostCreate()
    {  
        $subcategories = Subcategory::with('category')->get();
        return view('backend.author.post.post_create',compact('subcategories'));
    }

    public function AuthorpostStore(Request $request)
    {
        $request->validate([
            'post_title' => 'required',
            'post_details' => 'required',
            'post_photo' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        $q = DB::select("SHOW TABLE STATUS LIKE 'posts'");
        $p_id = $q[0]->Auto_increment;

        $now = time();
            $ext = $request->file('post_photo')->extension();
            $final_names = 'post_photo'.$now.'.'.$ext;
            $request->file('post_photo')->move(public_path('uploads/'),$final_names);


        $post = new Post();
        $post->subcategory_id = $request->subcategory_id;
        $post->post_title = $request->post_title;
        $post->post_details = $request->post_details;
        $post->post_photo = $final_names;
        $post->visitor = 1;
        $post->admin_id = 0;
        $post->author_id = Auth::guard('author')->user()->id;
        $post->share = $request->share;
        $post->comment = $request->comment;
        $post->save();

        if($request->tag != '')
        {
            $tag_array_new = [];
        $tag_array = explode(',', $request->tag);
        for ($i = 0; $i < count($tag_array); $i++) 
        {
            $tag_array_new[] = trim($tag_array[$i]);
        }
        $tag_array_new = array_values(array_unique($tag_array_new));

        for ($i = 0; $i < count($tag_array_new); $i++) {

            $tag = new Tag();
            $tag->post_id = $p_id;
            $tag->tag_name = trim($tag_array_new[$i]);
            $tag->save();
        }    
        }

          if($request->subscribers_send = 1)
          {
            $subject = 'A New Post is published';
            $message = 'Hi, A New Post is published into our website';
            $message .= '<a taget="_blank" href="'.route('NewsDetails',$p_id).'">';
            $message .= $request->post_title;
            $message .= '</a';
           $subscriber = Subscriber::where('status','Active')->get();
           foreach($subscriber as $row)
           {
            \Mail::to($row->email)->send(new Websitemail($subject,$message));

           }
          }  

        return redirect()->route('Authorpost')->with('success','Your Post Add Sucessfully');
    }

    public function AuthorpostEdit($id)

    {
       $test = Post::where('id',$id)->where('author_id',Auth::guard('author')->user()->id)->count();
        if(!$test)
        {
            return redirect()->route('AuthorHome');
        }

        $subcategories = Subcategory::with('category')->get();
        $existing_tags = Tag::where('post_id',$id)->get();
        $post = Post::where('id',$id)->first();
        return view('backend.author.post.post_edit',compact('post','subcategories','existing_tags'));
    }

    public function AuthorpostUpdate(Request $request,$id)
    {
        $request->validate([
            'post_title' => 'required',
            'post_details' => 'required',
        ]);
       $post = Post::where('id',$id)->first();

        if($request->hasFile('post_photo'))
        {
            $request->validate([
                'post_photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            
            
            unlink(public_path('uploads/'.$post->post_photo));

            $now = time();
            $ext = $request->file('post_photo')->extension();
            $final_names = 'post_photo_'.$now.'.'.$ext;
            
            $request->file('post_photo')->move(public_path('uploads/'),$final_names);
        
            $post->post_photo = $final_names;
        }

       $post->subcategory_id = $request->subcategory_id;
       $post->post_title = $request->post_title;
       $post->post_details = $request->post_details;
       $post->share = $request->share;
       $post->comment = $request->comment;
       $post->update();

        if ($request->tag != '') {
            $tag_array = explode(',',$request->tag);
            for ($i = 0; $i < count($tag_array); $i++) {
    
                $total = Tag::where('post_id', $id)->where('tag_name', trim($tag_array[$i]))->count();
                if(!$total){
                $tag = new Tag();
                $tag->post_id = $id;
                $tag->tag_name = trim($tag_array[$i]);
                $tag->save();
                }
            }  
        }

       
     
    return redirect()->route('Authorpost')->with('success','Your Post Updated Sucessfully');
    }

    public function AuthorPostTagDelete($id,$id1)
    {
        $tag = Tag::where('id',$id)->first();
        $tag->delete();
        return redirect()->route('AuthorpostEdit',$id1)->with('success','Data Deleted Successfully');
    }

    public function AuthorpostDelete($id)
    {
        $test = Post::where('id',$id)->where('author_id',Auth::guard('author')->user()->id)->count();
        if(!$test)
        {
            return redirect()->route('Author_home');
        }

       $post = Post::where('id',$id)->first();
       unlink(public_path('uploads/'.$post->post_photo));
        $post->delete();

       Tag::where('post_id',$id)->delete();

        return redirect()->route('Authorpost')->with('success','Data Deleted Successfully');

    }
}
