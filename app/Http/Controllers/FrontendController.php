<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pool;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Language;
use App\Helper\Helpers;


class FrontendController extends Controller
{
    public function poll_submit(Request $request)
    {
       
       $pool = Pool::where('id',$request->id)->first();

       if($request->vote == 'Yes')
       {
        $updated_yes = $pool->yes+1;
        $pool->yes = $updated_yes;
       }
       else
       {
        $updated_no = $pool->no+1;
        $pool->no = $updated_no;
       }
       $pool->update();

       session()->put('current_pool_id',$pool->id);
       return redirect()->back()->with('success','Your Vote Is Submitted');
    }

    public function poll_previews()
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
      
       $pool = Pool::where('language_id',$current_language_id)->orderBy('id','desc')->get();
        return view('frontend.poll_previews',compact('pool'));
    }

    public function ArchiveShow(Request $request)
    {   
        Helpers::read_json();

        $temp = explode('-', $request->archive_month_year);
        $month = $temp[0];
        $year = $temp[1];

        return redirect()->route('ArchiveDetails',[$year,$month]);

        
    }

    public function ArchiveDetails($year,$month)
    {
        Helpers::read_json();

        $post_data_archive = Post::with('subcategory')->whereMonth('created_at','=',$month)->whereYear('created_at','=',$year)->paginate(12);
       
        foreach($post_data_archive  as $item)
        {
            $ts = strtotime($item->created_at);
            $updated_date = date('F, Y',$ts);
            break;
        }
        return view('frontend.archive',compact('post_data_archive','updated_date'));
    }

    public function TagShow($tag_name)
    {
        Helpers::read_json();

        $tag = Tag::where('tag_name',$tag_name)->get();
        $all_tag = [];
        foreach($tag as $row)
        {
            $all_tag[] = $row->post_id; 
        }
       $all_post = Post::orderBy('id','desc')->get();

        return view('frontend.tag',compact('all_tag','all_post','tag_name'));
    }
}
