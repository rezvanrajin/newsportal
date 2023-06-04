@extends('backend.admin.master')

@section('heading', 'Setting')

@section('button')
                        <a href="" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
@endsection


@section('content')


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('settingUpdate')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" id="v-1-tab" data-toggle="pill" href="#v-1" role="tab" aria-controls="v-1" aria-selected="true">
                                                Home Item
                                            </a>
                                            <a class="nav-link" id="v-2-tab" data-toggle="pill" href="#v-2" role="tab" aria-controls="v-2" aria-selected="false">
                                                Logo And Favicon
                                            </a>
                                            <a class="nav-link" id="v-3-tab" data-toggle="pill" href="#v-3" role="tab" aria-controls="v-3" aria-selected="false">
                                               Top Bar
                                            </a>
                                            <a class="nav-link" id="v-4-tab" data-toggle="pill" href="#v-4" role="tab" aria-controls="v-4" aria-selected="false">
                                                Theme Color
                                             </a>
                                             <a class="nav-link" id="v-5-tab" data-toggle="pill" href="#v-5" role="tab" aria-controls="v-5" aria-selected="false">
                                                Google Analytic
                                             </a>
                                             <a class="nav-link" id="v-6-tab" data-toggle="pill" href="#v-6" role="tab" aria-controls="v-6" aria-selected="false">
                                                Disqus
                                             </a>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 col-lg-9 col-md-8 col-sm-12">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="pt_0 tab-pane fade show active" id="v-1" role="tabpanel" aria-labelledby="v-1-tab">
                                                <!-- Home page Start -->
                                                <div class="form-group mb-3">
                                                    <label>News Ticker Total</label>
                                                    <input type="text" name="news_ticker_total" class="form-control" value="{{$setting->news_ticker_total}}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Status</label>
                                                    <select name="news_ticker_status" class="form-control">
                                                        <option value="Show" @if($setting->news_ticker_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($setting->news_ticker_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Videos Total</label>
                                                    <input type="text" name="video_total" class="form-control" value="{{$setting->video_total}}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Status</label>
                                                    <select name="video_status" class="form-control">
                                                        <option value="Show" @if($setting->video_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($setting->video_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                                <!-- Home page End -->
                                            </div>

                                            <div class="pt_0 tab-pane fade" id="v-2" role="tabpanel" aria-labelledby="v-2-tab">
                                                <!-- R Item Start -->
                                                <div class="form-group mb-3">
                                                    <label>Existing Logo</label>
                                                    <div> 
                                                        <input type="file" name="logo">
                                                    </div> 
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Change Logo</label>
                                                    <div> 
                                                    <img src="{{asset('uploads/'.$setting->logo)}}" alt="" style="width: 300px">
                                                </div> 
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Existing Favicon</label>
                                                    <div> 
                                                        <input type="file" name="favicon">
                                                    </div> 
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Change Favicon</label>
                                                    <div> 
                                                    <img src="{{asset('uploads/'.$setting->favicon)}}" alt="" style="width: 50px">
                                                </div> 
                                                </div>
                                                <!-- Text Item End -->
                                            </div>
                                            <div class="pt_0 tab-pane fade" id="v-3" role="tabpanel" aria-labelledby="v-3-tab">
                                                <!-- Text Item Start -->
                                                <div class="form-group mb-3">
                                                    <label>Date Status</label>
                                                    <select name="top_bar_date_status" class="form-control">
                                                        <option value="Show" @if($setting->top_bar_date_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($setting->top_bar_date_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Email Address</label>
                                                    <input type="text" name="top_bar_email" class="form-control" value="{{$setting->top_bar_email}}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Email Status</label>
                                                    <select name="top_bar_email_status" class="form-control">
                                                        <option value="Show" @if($setting->top_bar_email_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($setting->top_bar_email_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                                <!-- Text Item End -->
                                            </div>
                            
                                            <div class="pt_0 tab-pane fade" id="v-4" role="tabpanel" aria-labelledby="v-4-tab">
                                                <!-- Text Item Start -->
                                                <div class="form-group mb-3">
                                                    <label>Theme Color</label>
                                                    <input type="text" name="theme_color_1" class="form-control jscolor" value="{{$setting->theme_color_1}}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Theme Color</label>
                                                    <input type="text" name="theme_color_2" class="form-control jscolor" value="{{$setting->theme_color_2}}">
                                                </div>
                                                <!-- Text Item End -->
                                            </div>
                                            <div class="pt_0 tab-pane fade" id="v-5" role="tabpanel" aria-labelledby="v-5-tab">
                                                <!-- Text Item Start -->
                                                <div class="form-group mb-3">
                                                    <label>Analytic ID</label>
                                                    <input type="text" name="analytic_id" class="form-control" value="{{$setting->analytic_id}}">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Analytic Status</label>
                                                    <select name="analytic_status" class="form-control">
                                                        <option value="Show" @if($setting->analytic_status == 'Show') selected @endif>Show</option>
                                                        <option value="Hide" @if($setting->analytic_status == 'Hide') selected @endif>Hide</option>
                                                    </select>
                                                </div>
                                                <!-- Text Item End -->
                                            </div>
                                            <div class="pt_0 tab-pane fade" id="v-6" role="tabpanel" aria-labelledby="v-6-tab">
                                                <!-- Text Item Start -->
                                                <div class="form-group mb-3">
                                                    <label>Disqus Code</label>
                                                    <textarea name="disqus_code" class="form-control" cols="30" rows="10" style="height:200px">{{$setting->disqus_code}}</textarea>
                                                </div>
                                                <!-- Text Item End -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt_30">
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>




          @if($errors->any())
    @foreach($errors->all() as $error)
    <script>    
    iziToast.error({
    title: '',
     position: 'topRight',
    message: '{{$error}}',
            });
            </script>
            @endforeach
           
        
    @elseif(session()->get('error'))
    <script>
        iziToast.error({
    title: '',
     position: 'topRight',
    message: '{{session()->get('error')}}',
});
</script>

    
        @else(session()->get('success'))
        <script>
        iziToast.success({
    title: '',
     position: 'topRight',
    message: '{{session()->get('success')}}',
});
    </script>
    
    @endif
    
    


@endsection