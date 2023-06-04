<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
   public function about()
   {

    $page = Page::with('language')->get();
    return view('backend.admin.page.page_about',compact('page'));
   }
   public function AbouteUpdate(Request $request)
   {

    $request->validate([
        'about_title' => 'required',
        'about_detail' => 'required',
    ]);

    $page = Page::where('id',$request->id)->first();
    $page->about_title = $request->about_title;
    $page->about_detail = $request->about_detail;
    $page->about_status = $request->about_status;
    $page->update();


    return redirect()->route('admin_about_page')->with('success','Your Page Updated Sucessfully');
    
   }

   public function faq()
   {
    $page = Page::with('language')->get();
    return view('backend.admin.page.page_faq',compact('page'));
   }
   public function FaqUpdate(Request $request)
   {

    $request->validate([
        'faq_title' => 'required',

    ]);

    $page = Page::where('id',$request->id)->first();
    $page->faq_title = $request->faq_title;
    $page->faq_detail = $request->faq_detail;
    $page->faq_status = $request->faq_status;
    $page->update();


    return redirect()->route('admin_faq_page')->with('success','Your Page Updated Sucessfully');
    
   }

   public function terms()
   {
    $page = Page::with('language')->get();
    return view('backend.admin.page.page_terms',compact('page'));
   }
   public function TermsUpdate(Request $request)
   {

    $request->validate([
        'terms_title' => 'required',
        'terms_detail' => 'required',
    ]);

    $page = Page::where('id',$request->id)->first();
    $page->terms_title = $request->terms_title;
    $page->terms_detail = $request->terms_detail;
    $page->terms_status = $request->terms_status;
    $page->update();


    return redirect()->route('admin_terms_page')->with('success','Your Page Updated Sucessfully');
    
   }
   public function privacy()
   {
    $page = Page::with('language')->get();
    return view('backend.admin.page.page_privacy',compact('page'));
   }
   public function PrivacyUpdate(Request $request)
   {

    $request->validate([
        'privacy_title' => 'required',
        'privacy_detail' => 'required',
    ]);

    $page = Page::where('id',$request->id)->first();
    $page->privacy_title = $request->privacy_title;
    $page->privacy_detail = $request->privacy_detail;
    $page->privacy_status = $request->privacy_status;
    $page->update();


    return redirect()->route('admin_privacy_page')->with('success','Your Page Updated Sucessfully');
    
   }

   public function disclaimer()
   {
    $page = Page::with('language')->get();
    return view('backend.admin.page.page_disclaimer',compact('page'));
   }
   public function DisclaimerUpdate(Request $request)
   {

    $request->validate([
        'disclaimer_title' => 'required',
        'disclaimer_detail' => 'required',
    ]);

    $page = Page::where('id',$request->id)->first();
    $page->disclaimer_title = $request->disclaimer_title;
    $page->disclaimer_detail = $request->disclaimer_detail;
    $page->disclaimer_status = $request->disclaimer_status;
    $page->update();


    return redirect()->route('admin_disclaimer_page')->with('success','Your Page Updated Sucessfully');
    
   }
   public function login()
   {
    $page = Page::with('language')->get();
    return view('backend.admin.page.page_login',compact('page'));
   }
   public function LoginUpdate(Request $request)
   {

    $request->validate([
        'login_title' => 'required',
    ]);

    $page = Page::where('id',$request->id)->first();
    $page->login_title = $request->login_title;
    $page->login_status = $request->login_status;
    $page->update();


    return redirect()->route('admin_login_page')->with('success','Your Page Updated Sucessfully');
    
   }
   public function contat()
   {
    $page = Page::with('language')->get();
    return view('backend.admin.page.page_contact',compact('page'));
   }
   public function ContatUpdate(Request $request)
   {

    $request->validate([
        'contact_title' => 'required',
    ]);

    $page = Page::where('id',$request->id)->first();
    $page->contact_title = $request->contact_title;
    $page->contact_detail = $request->contact_detail;
    $page->contact_map = $request->contact_map;
    $page->contact_status = $request->contact_status;
    $page->update();


    return redirect()->route('admin_contact_page')->with('success','Your Page Updated Sucessfully');
    
   }
}
