<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function photoView()
    {
       $photo = Photo::get();
        return view('backend.admin.photo.photo',compact('photo'));
    }
    public function photoCreate()
    {
        return view('backend.admin.photo.photo_create');
    }
    public function photoStore(Request $request)
    {
        
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif',
                'caption' => 'required',
            ]);
    
            $now = time();
            $ext = $request->file('photo')->extension();
            $final_names = 'photo'.$now.'.'.$ext;
            $request->file('photo')->move(public_path('uploads/'),$final_names);


            $photo = new Photo();
            $photo->photo = $final_names;
            $photo->caption = $request->caption;
            $photo->language_id = $request->language_id;
            $photo->save();
            return redirect()->back()->with('success','Your Photo Add Sucessfully');        
    }

    public function photoEdit($id)
    {
        $photo_data = Photo::where('id',$id)->first();
        return view('backend.admin.photo.photo_edit',compact('photo_data'));   
    }

    public function photoUpdate(Request $request,$id)
        {

            $photo_data = Photo::where('id',$id)->first();
            if($request->hasFile('photo'))
            {
                $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            
            
            unlink(public_path('uploads/'.$photo_data->photo));
            $now = time();
            $ext = $request->file('photo')->extension();
            $final_names = 'photo'.$now.'.'.$ext;
            
            $request->file('photo')->move(public_path('uploads/'),$final_names);
        
            $photo_data->photo = $final_names;
        }
            $photo_data->caption = $request->caption;
            $photo_data->language_id = $request->language_id;
            $photo_data->update();
            return redirect()->route('photoView')->with('success','Sidebar Ads Is Updated');

        }

        public function photoDelete($id)
        {
                $photo_data = Photo::where('id',$id)->first();
                unlink(public_path('uploads/'.$photo_data->photo));
                $photo_data->delete();
                return redirect()->route('photoView')->with('success','Sidebar Ads Is Deleted');
    
    
        }

}

