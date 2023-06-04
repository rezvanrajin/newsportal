@extends('backend.admin.master')

@section('heading', 'Top Ads')

@section('content')

<div class="section-body">
    <form action="{{route('TopAdsUpdate')}}" method="post" enctype="multipart/form-data">
       @csrf
       <input type="hidden" value="{{$top_ads->id}}" name="top_ads_id">
        <div class="row">
            <div class="col-9 offset-1">
                <div class="card">
                    <div class="card-body">
                        <h5>Top Ads</h5>


                        <div class="form-group mb-3">
                            <label>Existing Photo</label>
                            <div>
                                <img src="{{asset('uploads/'. $top_ads->top_ad)}}" alt="" style="width: 100%" >
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Change Photo</label>
                            <div>
                                <input type="file" name="top_ad">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>URL</label>
                            <input type="text" class="form-control" name="top_ad_url" value="{{$top_ads->top_ad_url}}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Status</label>
                            <select name="top_ad_status" class="form-control">
                                <option value="Show" @if($top_ads->top_ad_status == 'Show') selected @endif>Show</option>
                                <option value="Hide" @if($top_ads->top_ad_status == 'Hide') selected @endif>Hide</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group" style="text-align: center">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
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