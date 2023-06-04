<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Ads;
use App\Models\Subcategory;
use App\Models\Category;
use App\Models\Post;
use App\Mail\Websitemail;
use App\Models\Video;
use App\Models\Admin;
use App\Models\Page;
use App\Models\Faq;
use App\Models\Subscriber;
use App\Helper\Helpers;
use App\Models\Language;

use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\SubscribedService;

class HomeController extends Controller
{
    public function index()
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
      
        



        $video = Video::where('language_id',$current_language_id)->get();
        $home_ad_data = Ads::where('id', 1)->first();
        $setting_data = Setting::where('id', 1)->first();
        $post = Post::with('subcategory')->inRandomOrder()->where('language_id',$current_language_id)->get();
        $subcategory = Subcategory::with('rpost')->orderBy('subcategory_order','asc')->where('show_on_home','Show')->where('language_id',$current_language_id)->get();
        $category = Category::orderBy('category_order','asc')->where('language_id',$current_language_id)->get();
        return view('frontend.index.home',compact('home_ad_data','setting_data','post','subcategory','video','category'));
    }
    
    public function About()
    {   Helpers::read_json();
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
        return view('frontend.about',compact('page'));
    }

    public function Faq()
    {   Helpers::read_json();
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
        $faq_data = Faq::where('language_id',$current_language_id)->get();
        return view('frontend.faq',compact('page','faq_data'));
    }
    public function Terms()
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
        return view('frontend.terms',compact('page'));
    }    
    public function Privacy()
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
        return view('frontend.privacy',compact('page'));
    }
    public function Disclaimer()
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
        return view('frontend.disclaimer',compact('page'));
    }

    public function Contact()
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

        return view('frontend.contact',compact('page'));
    }
    public function contact_usForm(Request $request)
    {
        Helpers::read_json();

        $validator = \Validator::make($request->all(),[
            'name'=>'required',
            'email' => 'required|email',
            'message' => 'required'
        ]
          ,[
            'name.required' => ERROR_NAME_REQUIRED,
            'email.required' => ERROR_EMAIL_REQUIRED,
            'email.email' => ERROR_EMAIL_VALID,
            'message.required' => ERROR_MESSAGE_REQUIRED
        ]);
  
        if(!$validator->passes())
        {
            return response()->json(['code'=>0,'error_message'=>$validator->errors()->toArray()]);
        }
        else
        {
            // Send email
            $admin_data = Admin::where('id',1)->first();
            $subject = 'Contact Form Email';
            $message = 'Visitor Message Detail:<br>';
            $message .= '<b>Visitor Name: </b>'.$request->name.'<br>';
            $message .= '<b>Visitor Email: </b>'.$request->email.'<br>';
            $message .= '<b>Visitor Message: </b>'.$request->message;
            \Mail::to($admin_data->email)->send(new Websitemail($subject,$message));

            return response()->json(['code'=>1,'success_message'=>SUCCESS_CONTACT]);
        }
    }

    public function subscriber_email(Request $request)
    {   
        Helpers::read_json();

    $validator = \Validator::make($request->all(),[
            
            'email' => 'required|email',
         
        ] ,[
            'email.required' => ERROR_EMAIL_REQUIRED,
            'email.email' => ERROR_EMAIL_VALID
        ]);
       
        if(!$validator->passes())
        {
            return response()->json(['code'=>0,'error_message'=>$validator->errors()->toArray()]);
        }
        else
        {
            $token = hash('sha256',time());
            $subscribe = new Subscriber;
            $subscribe->email = $request->email;
            $subscribe->token = $token;
            $subscribe->status = 'Pending';
            $subscribe->save();


            // Send email
            $subject = 'Subscriber Email Verify';
            $verify_link = url('subscriber/verify/'.$token.'/'.$request->email);
            $message = 'Please Click the follwing link to verify subscriber:<br>';
            
            $message .= '<a href="'.$verify_link.'">';
            $message .= $verify_link;
            $message .= '</a>';

            \Mail::to($request->email)->send(new Websitemail($subject,$message));

            return response()->json(['code'=>1,'success_message'=>SUCCESS_SUBSCRIBER]);
        }
    }

    public function subscriber_verify($token,$email)
    {
        Helpers::read_json();


        $subscriber_data = Subscriber::where('token',$token)->where('email',$email)->first();
        if($subscriber_data)
        {
            $subscriber_data->token = '';
            $subscriber_data->status = 'Active';
            $subscriber_data->update();

            return redirect()->back()->with('success',SUCCESS_SUBSCRIBER_CONFIRM);
        }
        else
        {
            return redirect()->route('Home');
        }
    }

    public function subcategorybyCategory($id)
    {
        Helpers::read_json();
        $subcategory = Subcategory::where('category_id',$id)->get();
        $response = "<option value=''>".SELECT_SUBCATEGORY."</option>";
        foreach($subcategory as $item)
        {
            $response .= '<option value="'.$item->id.'">'.$item->subcategory_name.'</option>';
        }
        return response()->json(['subcategory'=>$response]);
    }

    public function search(Request $request)
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
        
        $post = Post::with('subcategory')->orderBy('id','desc');

        if($request->text_item!='')
        {
            $post = $post->where('post_title','like',$request->text_item. '%');
        }
        if($request->subcategory!='')
        {
            $post = $post->where('subcategory_id','like',$request->subcategory. '%');

        }
        $post = $post->where('language_id',$current_language_id)->paginate(12);
        return view('frontend.search',compact('post'));
    }

    public function SwitchLanguage(Request $request)
    {
        session()->put('lang_short_name',$request->short_name);
        return redirect()->back();
    }
}
