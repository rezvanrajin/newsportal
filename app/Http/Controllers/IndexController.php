<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LiveChannel;
use App\Models\Pool;


class IndexController extends Controller
{
    public function LiveVideoView()
    {
        $LiveChannel = LiveChannel::get();
        return view('backend.admin.live_channel.live_channel',compact('LiveChannel'));
    }
    public function LiveVideoCreate()
    {
        return view('backend.admin.live_channel.live_channel_creator');
    }
    public function LiveVideoStore(Request $request)
    {
        
        $request->validate([
            'heading' => 'required',
            'video_id' => 'required',
        ]);


        $LiveChannel = new LiveChannel();
        $LiveChannel->video_id = $request->video_id;
        $LiveChannel->heading = $request->heading;
        $LiveChannel->language_id = $request->language_id;
        $LiveChannel->save();
        return redirect()->back()->with('success','Your Live Channel Add Sucessfully');        
    }
    public function LiveVideoEdit($id)
    {
        $LiveChannel = LiveChannel::where('id',$id)->first();
        return view('backend.admin.live_channel.live_channel_edit',compact('LiveChannel'));   
    }

    public function LiveVideoUpdate(Request $request,$id)
        {
            $request->validate([
                'heading' => 'required',
                'video_id' => 'required',
            ]);

            $LiveChannel = LiveChannel::where('id',$id)->first();
            
            $LiveChannel->video_id = $request->video_id;
            $LiveChannel->heading = $request->heading;
            $LiveChannel->language_id = $request->language_id;
            $LiveChannel->update();
            return redirect()->route('LiveVideoView')->with('success','Live Channel Is Updated');

        }

        public function LiveVideoDelete($id)
        {
                $LiveChannel = LiveChannel::where('id',$id)->first();
                $LiveChannel->delete();
                return redirect()->route('LiveVideoView')->with('success','Live Channel Is Deleted');
    
    
        }

        public function OnlinePoolView()
        {    $pool = Pool::orderBy('id','desc')->get();
            return view('backend.admin.pool.pool_view',compact('pool'));

        }
        public function OnlinePoolCreate()
    {
        return view('backend.admin.pool.pool_create');
    }
    public function OnlinePoolStore(Request $request)
    {
        
        $request->validate([
            'question' => 'required',
        ]);


        $Pool = new Pool();
        $Pool->question = $request->question;
        $Pool->yes = 0;
        $Pool->no = 0;
        $Pool->language_id = $request->language_id;
        $Pool->save();
        return redirect()->back()->with('success','Your Live Channel Add Sucessfully');        
    }
    public function OnlinePoolEdit($id)
    {
        $Pool = Pool::where('id',$id)->first();
        return view('backend.admin.pool.pool_edit',compact('Pool'));   
    }

    public function OnlinePoolUpdate(Request $request,$id)
        {
            $request->validate([
                'question' => 'required',
            ]);

            $Pool = Pool::where('id',$id)->first();
            
            $Pool->question = $request->question;
            $Pool->language_id = $request->language_id;

     
            $Pool->update();
            return redirect()->route('OnlinePoolView')->with('success','Live Channel Is Updated');

        }

        public function OnlinePoolDelete($id)
        {
                $Pool = Pool::where('id',$id)->first();
                $Pool->delete();
                return redirect()->route('OnlinePoolView')->with('success','Live Channel Is Deleted');
    
    
        }
}
