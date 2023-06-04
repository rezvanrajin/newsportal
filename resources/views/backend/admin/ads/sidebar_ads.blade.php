@extends('backend.admin.master')

@section('heading', 'Sidebar Ads')
@section('button')
                        <a href="{{route('SidebarAdsCreate')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
@endsection
 @section('content')

<div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="example1">
                                            <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Photo</th>
                                                <th>Url</th>
                                                <th>Location</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sidebar_ads as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{asset('uploads/'.$row->sidebar_ad)}}" alt="" style="width:100px;">
                                                </td>
                                                <td>{{$row->sidebar_ad_url ?? 'No URL'}}</td>
                                                <td>{{$row->sidebar_ad_location}}</td>
                                                <td class="pt_10 pb_10">
                                                     <a href="{{route('SidebarAdsEdit',$row->id)}}" class="btn btn-primary" >Edit</a>
                                                     <a href="{{route('SidebarAdsDelete',$row->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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