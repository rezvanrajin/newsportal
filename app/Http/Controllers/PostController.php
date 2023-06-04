<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subscriber;
use App\Mail\Websitemail;
use Auth;
use DB;

class PostController extends Controller
{
    public function post()
    {
        $post = Post::with('subcategory.category','language')->get();
        return view('backend.admin.post.post_view',compact('post'));

    }
    public function postCreate()
    {  
        $subcategories = Subcategory::with('category')->get();
        return view('backend.admin.post.post_create',compact('subcategories'));
    }

    public function postStore(Request $request)
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
        $post->author_id = 0;
        $post->admin_id = Auth::guard('admin')->user()->id;
        $post->share = $request->share;
        $post->comment = $request->comment;
        $post->language_id = $request->language_id;
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





         return redirect()->route('post')->with('success','Your Category Add Sucessfully');
    }

    public function postEdit($id)
    {
        $subcategories = Subcategory::with('category')->get();
        $existing_tags = Tag::where('post_id',$id)->get();
        $post = Post::where('id',$id)->first();
        return view('backend.admin.post.post_edit',compact('post','subcategories','existing_tags'));
    }

    public function postUpdate(Request $request,$id)
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
       $post->language_id = $request->language_id;
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

       
     
    return redirect()->route('post')->with('success','Your Post Updated Sucessfully');
    }

    public function PostTagDelete($id,$id1)
    {
        $tag = Tag::where('id',$id)->first();
        $tag->delete();
        return redirect()->route('postEdit',$id1)->with('success','Data Deleted Successfully');
    }

    public function postDelete($id)
    {
       $post = Post::where('id',$id)->first();
       unlink(public_path('uploads/'.$post->post_photo));
        $post->delete();

       Tag::where('post_id',$id)->delete();

        return redirect()->route('post')->with('success','Data Deleted Successfully');

    }
}
