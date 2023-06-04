<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Admin;
use App\Models\Author;
use App\Models\Tag;
use App\Helper\Helpers;


class FrontendpostController extends Controller
{
    public function NewsDetails($id)
    {
        Helpers::read_json();

        $tags = Tag::where('post_id', $id)->get();

        $news_post = Post::with('subcategory')->where('id', $id)->first();
        if ($news_post->author_id == 0) 
        {
            $user = Admin::where('id',$news_post->admin_id)->first();
        } 
        else 
        {
            $user = Author::where('id',$news_post->author_id)->first();
        }

        $visitors = $news_post->visitor + 1;
        $news_post->visitor = $visitors;
        $news_post->update();


        $related_post = Post::with('subcategory')->orderBy('id','desc')->where('subcategory_id',$news_post->subcategory_id)->get();
        
        return view('frontend.post.post_details',compact('news_post','user','tags','related_post'));
    }

}
