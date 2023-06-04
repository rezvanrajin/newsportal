<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\TopAds;
use App\Models\SidebarAds;

class AdsController extends Controller
{
    public function HomeAds()
    {
        $home_ads = Ads::where('id',1)->first();
        return view('backend.admin.ads.home_ads_view', compact('home_ads'));
    }
    
    public function HomeAdsUpdate(Request $request)
    {
       
       $home_ad = Ads::where('id',1)->first();
        if($request->hasFile('above_search_ad'))
        {
            $request->validate([
                'above_search_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            
            
            unlink(public_path('uploads/'.$home_ad->above_search_ad));
            
            $ext = $request->file('above_search_ad')->extension();
            $final_name = 'above_search_ad'.'.'.$ext;
            
            $request->file('above_search_ad')->move(public_path('uploads/'),$final_name);
        
            $home_ad->above_search_ad = $final_name;
        }
        
        if($request->hasFile('above_footer_ad'))
        {
            $request->validate([
                'above_footer_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            
            
            unlink(public_path('uploads/'.$home_ad->above_footer_ad));
            
            $ext = $request->file('above_footer_ad')->extension();
            $final_name = 'above_footer_ad'.'.'.$ext;
            
            $request->file('above_footer_ad')->move(public_path('uploads/'),$final_name);
        
            $home_ad->above_footer_ad = $final_name;
        }
        
        $id = $request->ads_id;
        
        $home_ad->above_search_ad_url = $request->above_search_ad_url;
        $home_ad->above_search_ad_status = $request->above_search_ad_status;
        $home_ad->above_footer_ad_url = $request->above_footer_ad_url;
        $home_ad->above_footer_ad_status = $request->above_footer_ad_status;
        $home_ad->update();
        return redirect()->back()->with('success','Your Data Is Saved');
    }
    
    public function TopAds()
    {
        $top_ads = TopAds::where('id',1)->first();
        return view('backend.admin.ads.top_ads', compact('top_ads'));
        
    }
    
    public function TopAdsUpdate(Request $request)
    {
               $top_ads = TopAds::where('id',1)->first();
        if($request->hasFile('top_ad'))
        {
            $request->validate([
                'top_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            
            
            unlink(public_path('uploads/'.$top_ads->top_ad));
            
            $ext = $request->file('top_ad')->extension();
            $final_names = 'top_ad'.'.'.$ext;
            
            $request->file('top_ad')->move(public_path('uploads/'),$final_names);
        
            $top_ads->top_ad = $final_names;
        }
        
        $id = $request->top_ads_id;
        
        $top_ads->top_ad_url = $request->top_ad_url;
        $top_ads->top_ad_status = $request->top_ad_status;
        $top_ads->update();
        return redirect()->back()->with('success','Your Top Ads Data Is Saved');
        
    }
    
    public function SidebarAds()
    {
        $sidebar_ads = SidebarAds::get();
        return view('backend.admin.ads.sidebar_ads', compact('sidebar_ads'));
    }
    
    public function SidebarAdsCreate()
            {
             return view('backend.admin.ads.sidebar_ads_create');
           }
    
           public function SidebarAdsStore(Request $request)
           {      
            $request->validate([
                'sidebar_ad' => 'required|image|mimes:jpg,jpeg,png,gif'
            ],[
                'sidebar_ad.required' => 'Select a photo for ads',
                'sidebar_ad.image' => 'Photo must be Image',
                'sidebar_ad.mimes' => 'Correct mimes needed',
            ]);
            $now = time();
            $ext = $request->file('sidebar_ad')->extension();
            $final_names = 'sidebar_ad'.$now.'.'.$ext;
            $request->file('sidebar_ad')->move(public_path('uploads/'),$final_names);
                                      
                $sidebar_ads = new SidebarAds();
                $sidebar_ads->sidebar_ad = $final_names;
                $sidebar_ads->sidebar_ad_url = $request->sidebar_ad_url;
                $sidebar_ads->sidebar_ad_location = $request->sidebar_ad_location;
                $sidebar_ads->save();
                return redirect()->back()->with('success','Sidebar Ads Is Saved');

           }

           public function SidebarAdsEdit($id)
           {
            $sidebarEdit = SidebarAds::where('id',$id)->first();
             return view('backend.admin.ads.sidebar_ads_edit',compact('sidebarEdit'));   
           }

           
           public function SidebarAdsUpdate(Request $request,$id)
           {

            $sidebar_ad_data = SidebarAds::where('id',$id)->first();
            if($request->hasFile('sidebar_ad'))
            {
                $request->validate([
                'sidebar_ad' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            
            
            unlink(public_path('uploads/'.$sidebar_ad_data->sidebar_ad));
            $now = time();
            $ext = $request->file('sidebar_ad')->extension();
            $final_names = 'sidebar_ad_'.$now.'.'.$ext;
            
            $request->file('sidebar_ad')->move(public_path('uploads/'),$final_names);
        
            $sidebar_ad_data->sidebar_ad = $final_names;
        }
            $sidebar_ad_data->sidebar_ad_url = $request->sidebar_ad_url;
            $sidebar_ad_data->sidebar_ad_location = $request->sidebar_ad_location;
            $sidebar_ad_data->update();
            return redirect()->route('SidebarAds')->with('success','Sidebar Ads Is Updated');

        }

        public function SidebarAdsDelete($id)
        {
            $sidebar_ad_data = SidebarAds::where('id',$id)->first();
            unlink(public_path('uploads/'.$sidebar_ad_data->sidebar_ad));
            $sidebar_ad_data->delete();
            return redirect()->route('SidebarAds')->with('success','Sidebar Ads Is Deleted');


        }
}
