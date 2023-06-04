<?php

namespace App\Helper;

use Illuminate\Http\Request;
use App\Models\Language;
use File;


class Helpers 
{
    public static function read_json()
    {
        if (!session()->get('lang_short_name'))
        {
           $default_lang_data = Language::where('is_default','Yes')->first();
            $current_short_name = $default_lang_data->short_name;

        }
       else
       {
        $current_short_name = session()->get('lang_short_name');
       }

               $json_data = json_decode(file_get_contents(resource_path('language/'.$current_short_name.'.json')));
                foreach ($json_data as $key => $value) 
                    {
                    define($key,$value);
                    }
            }   

}
