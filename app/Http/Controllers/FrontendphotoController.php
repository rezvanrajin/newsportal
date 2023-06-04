<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Language;
use App\Helper\Helpers;


class FrontendphotoController extends Controller
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
    
   $photo = Photo::where('language_id',$current_language_id)->paginate(2);
    return view('frontend.photo.photo',compact('photo'));
   }
}
