<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;
use App\Models\Post;
use App\Helper\Helpers;

class FrontendsubcategoryController extends Controller
{
    public function index($id)
    {
        Helpers::read_json();

       $subcategory_data = Subcategory::where('id',$id)->first();
       $post_data = Post::where('subcategory_id',$id)->orderBy('id','desc')->paginate(2);
        return view('frontend.subcategory.subcategory',compact('subcategory_data','post_data'));
    }
}
