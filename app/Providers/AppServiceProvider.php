<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Page;  
use App\Models\Post;  
use App\Models\TopAds;  
use App\Models\SidebarAds;  
use App\Models\LiveChannel;  
use App\Models\Pool;  
use App\Models\Setting;  
use App\Models\SocialIcon;  
use App\Models\Language;  


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       Paginator::useBootstrap();

       $top_ad_data = TopAds::where('id',1)->first();
       $sidebar_top_ad = SidebarAds::where('sidebar_ad_location','top')->get();
       $sidebar_bottom_ad = SidebarAds::where('sidebar_ad_location','bottom')->get();

        $categories = Category::with('rsubcategory')->where('show_on_menu','Show')->orderBy('category_order','asc')->get();
       
        $SocialIcon = SocialIcon::get();
        $Setting = Setting::where('id',1)->first();
        $Language = Language::get();
        $default_lang_data = Language::where('is_default','Yes')->first();


        view()->share('global_categories',$categories);
        view()->share('global_top_ad_data',$top_ad_data);
        view()->share('global_sidebar_top_ad',$sidebar_top_ad);
        view()->share('global_sidebar_bottom_ad',$sidebar_bottom_ad);
        view()->share('global_Setting_post',$Setting);  
        view()->share('global_SocialIcon',$SocialIcon);  
        view()->share('global_Language',$Language);
        view()->share('global_default_lang_data',$default_lang_data->short_name);  


    }
}
