@extends('backend.admin.master')

@section('heading', 'Sidebar Ads Create')

@section('button')
                        <a href="{{route('SidebarAds')}}" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
@endsection


@section('content')

<div class="section-body">
    <form action="{{route('SidebarAdsStore')}}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="row">
            <div class="col-9 offset-1">
                <div class="card">
                    <div class="card-body">
                            <div class="form-group mb-3">
                            <label>Select Photo</label>
                            <div>
                                <input type="file" name="sidebar_ad">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>URL</label>
                            <input type="text" class="form-control" name="sidebar_ad_url" value="">
                        </div>
                        <div class="form-group mb-3">
                            <label>Location</label>
                            <select name="sidebar_ad_location" class="form-control">
                                <option value="top">Top</option>
                                <option value="bottom">Bottom</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group" style="text-align: center">
            <button type="submit" class="btn btn-primary">Submit</button>
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