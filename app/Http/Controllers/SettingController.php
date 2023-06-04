<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Subscriber;
use App\Models\Faq;
use App\Models\Language;
use App\Models\SocialIcon;
use App\Mail\Websitemail;
use DB;
use File;


class SettingController extends Controller
{
    public function setting()
    {
        $setting = Setting::where('id',1)->first();
        return view('backend.admin.setting.setting',compact('setting'));
    }

    public function settingUpdate(Request $request)
    {
        $request->validate([
            'news_ticker_total' => 'required',
        ]);

       $setting = Setting::where('id',1)->first();
    $setting->news_ticker_total = $request->news_ticker_total;
    $setting->news_ticker_status = $request->news_ticker_status;
    $setting->video_total = $request->video_total;
    $setting->video_status = $request->video_status;
    $setting->top_bar_date_status = $request->top_bar_date_status;
    $setting->top_bar_email = $request->top_bar_email;
    $setting->top_bar_email_status = $request->top_bar_email_status;
    $setting->theme_color_1 = $request->theme_color_1;
    $setting->theme_color_2 = $request->theme_color_2;
    $setting->analytic_id = $request->analytic_id;
    $setting->analytic_status = $request->analytic_status;
    $setting->disqus_code = $request->disqus_code;

    if($request->hasFile('logo'))
    {
        $request->validate([
            'logo' => 'image|mimes:jpg,jpeg,png,gif'
        ]);       
        unlink(public_path('uploads/'.$setting->logo));
        $ext = $request->file('logo')->extension();
        $final_names = 'logo'.'.'.$ext;
        $request->file('logo')->move(public_path('uploads/'),$final_names);
        $setting->logo = $final_names;
    }
    if($request->hasFile('favicon'))
    {
        $request->validate([
            'favicon' => 'image|mimes:jpg,jpeg,png,gif'
        ]);       
        unlink(public_path('uploads/'.$setting->favicon));
        $ext = $request->file('favicon')->extension();
        $final_names = 'favicon'.'.'.$ext;
        $request->file('favicon')->move(public_path('uploads/'),$final_names);
        $setting->favicon = $final_names;
    }


      $setting->update();
     
    return redirect()->route('setting')->with('success','Your Ticker is Updated Sucessfully');
    }

    public function FaqShow()
    {
        $faq_data = Faq::get();
        return view('backend.admin.faq.faq_show',compact('faq_data'));
    }
    public function faqCreate()
    {
        return view('backend.admin.faq.faq_create');
    }
    public function faqStore(Request $request)
    {
        
        $request->validate([
            'faq_title' => 'required',
            'faq_detail' => 'required',
        ]);


        $faq = new Faq();
        $faq->faq_title = $request->faq_title;
        $faq->faq_detail = $request->faq_detail;
        $faq->language_id = $request->language_id;
        $faq->save();
        return redirect()->back()->with('success','Your FAQ Add Sucessfully');        
    }
    public function faqEdit($id)
    {
        $faq = Faq::where('id',$id)->first();
        return view('backend.admin.faq.faq_edit',compact('faq'));   
    }

    public function faqUpdate(Request $request,$id)
        {
            $request->validate([
                'faq_title' => 'required',
                'faq_detail' => 'required',
            ]);

            $faq = Faq::where('id',$id)->first();
            
            $faq->faq_title = $request->faq_title;
            $faq->faq_detail = $request->faq_detail;
            $faq->language_id = $request->language_id;
            $faq->update();
            return redirect()->route('FaqShow')->with('success','FAQ Is Updated');

        }

        public function faqDelete($id)
        {
                $faq = Faq::where('id',$id)->first();
                $faq->delete();
                return redirect()->route('FaqShow')->with('success','FAQ Is Deleted');
    
    
        }

        public function allSubsriberShow()
        {   

           $subscriber = Subscriber::where('status','Active')->get();

            return view('backend.admin.subscriber.subscriber_show',compact('subscriber'));
        }

        public function Subscriber_send_mail()
        {
            return view('backend.admin.subscriber.subscriber_send_mail');

        }
        public function Subscriber_send_mail_submit(Request $request)
        {
            $request->validate([
                'subject' => 'required',
                'message' => 'required',
            ]);

            $subject = $request->subject;
            $message = $request->message;
   
           $subscriber = Subscriber::where('status','Active')->get();
           foreach($subscriber as $row)
           {
            \Mail::to($row->email)->send(new Websitemail($subject,$message));

           }
           return redirect()->route('Subscriber_send_mail')->with('success','Your Mail Sent To Subscriber Sucessfully');
        }

        public function SocialIconShow()
    {
        $socialIcon = SocialIcon::get();
        return view('backend.admin.social.social_show',compact('socialIcon'));
    }
    public function SocialIconCreate()
    {
        return view('backend.admin.social.social_create');
    }
    public function SocialIconStore(Request $request)
    {
        
        $request->validate([
            'icon' => 'required',
            'url' => 'required',
        ]);


        $socialIcon = new SocialIcon();
        $socialIcon->icon = $request->icon;
        $socialIcon->url = $request->url;
        $socialIcon->save();
        return redirect()->back()->with('success','Your Social Icon Add Sucessfully');        
    }
    public function SocialIconEdit($id)
    {
        $socialIcon = SocialIcon::where('id',$id)->first();
        return view('backend.admin.social.social_edit',compact('socialIcon'));   
    }

    public function SocialIconUpdate(Request $request,$id)
        {
            $request->validate([
                'icon' => 'required',
                'url' => 'required',
            ]);

            $faq = SocialIcon::where('id',$id)->first();
            
            $faq->icon = $request->icon;
            $faq->url = $request->url;
            $faq->update();
            return redirect()->route('SocialIconShow')->with('success','Social Icon Is Updated');

        }

        public function SocialIconDelete($id)
        {
                $faq = SocialIcon::where('id',$id)->first();
                $faq->delete();
                return redirect()->route('SocialIconShow')->with('success','Social Icon Is Deleted');
    
    
        }

        public function LanguageShow()
        {
            $language = Language::get();
            return view('backend.admin.language.language',compact('language'));
        }
        public function LanguageCreate()
        {
            return view('backend.admin.language.language_create');
        }
        public function LanguageStore(Request $request)
        {
            
            $request->validate([
                'name' => 'required',
                'short_name' => 'required|unique:languages',
            ]);

            if($request->is_default == 'Yes')
            {
                DB::table('languages')->update(['is_default'=>'No']);
            }
      

            $language = new Language();
            $language->name = $request->name;
            $language->short_name = $request->short_name;
            $language->is_default = $request->is_default;
            $language->save();

            
            $test_data = file_get_contents(resource_path('language/sample.json'));
            file_put_contents(resource_path('language/'.$request->short_name.'.json'),$test_data);




            return redirect()->back()->with('success','Your Language Add Sucessfully');        
        }
        public function LanguageEdit($id)
        {
            $language = Language::where('id',$id)->first();
            return view('backend.admin.language.language_edit',compact('language'));   
        }
    
        public function LanguageUpdate(Request $request,$id)
            {
                $request->validate([
                    'name' => 'required',
                ]);

                if($request->is_default == 'Yes')
                {
                    DB::table('languages')->update(['is_default'=>'No']);
                }
    
                $language = Language::where('id',$id)->first();
                
                $language->name = $request->name;
                $language->is_default = $request->is_default;
                $language->update();
                return redirect()->route('LanguageShow')->with('success','Language Is Updated');
    
            }
    
            public function LanguageDelete($id)
            {
                    $language = Language::where('id',$id)->first();
                    if($language->is_default == 'Yes')
                    {
                        DB::table('languages')->where('id',1)->update(['is_default'=>'Yes']);
                    }

                    unlink(resource_path('language/'.$language->short_name.'.json'));

                    $language->delete();
                    return redirect()->route('LanguageShow')->with('success','Language Is Deleted');
  
            }

            public function LanguageUpdateDetails($id)
            {

                $language = Language::where('id',$id)->first();
                $lang_id = $language->id;
                $json_data = json_decode(file_get_contents(resource_path('language/'.$language->short_name.'.json')));
                
                return view('backend.admin.language.language_update',compact('json_data','lang_id'));   
                
            }
            public function LanguageUpdateDetailsPost(Request $request, $id)
            {
                $language = Language::where('id',$id)->first();

                $arr1 = [];
                $arr2 = [];

                foreach($request->arr_key as $val)
                {
                    $arr1[] = $val;
                }

                foreach($request->arr_value as $val)
                {
                    $arr2[] = $val;
                }

                for($i=0;$i<count($arr1);$i++)
                {
                    $data[$arr1[$i]] = $arr2[$i];
                }

                $after_encode = json_encode($data,JSON_PRETTY_PRINT);
                file_put_contents(resource_path('language/'.$language->short_name.'.json'),$after_encode);

                return redirect()->route('LanguageShow')->with('success','Language Is Updated');
            }

}
