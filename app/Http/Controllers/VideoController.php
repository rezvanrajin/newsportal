<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function videoView()
    {
       $video = Video::get();
        return view('backend.admin.video.video',compact('video'));
    }
    public function videoCreate()
    {
        return view('backend.admin.video.video_create');
    }
    public function videoStore(Request $request)
    {
        
        $request->validate([
            'caption' => 'required',
            'video_id' => 'required',
        ]);


        $video = new Video();
        $video->video_id = $request->video_id;
        $video->caption = $request->caption;
        $video->language_id = $request->language_id;
        $video->save();
        return redirect()->back()->with('success','Your Video Add Sucessfully');        
    }
    public function videoEdit($id)
    {
        $video = Video::where('id',$id)->first();
        return view('backend.admin.video.video_edit',compact('video'));   
    }

    public function videoUpdate(Request $request,$id)
        {
            $request->validate([
                'caption' => 'required',
                'video_id' => 'required',
            ]);

            $video = Video::where('id',$id)->first();
            
            $video->video_id = $request->video_id;
            $video->caption = $request->caption;
            $video->language_id = $request->language_id;
            $video->update();
            return redirect()->route('videoView')->with('success','Video Is Updated');

        }

        public function videoDelete($id)
        {
                $video = Video::where('id',$id)->first();
                $video->delete();
                return redirect()->route('videoView')->with('success','Video Is Deleted');
    
    
        }
}
