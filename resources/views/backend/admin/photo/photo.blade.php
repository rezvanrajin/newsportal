@extends('backend.admin.master')

@section('heading', 'Photos')
@section('button')
                        <a href="{{route('photoCreate')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
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
                                                <th>Caption</th>
                                                <th>Language</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($photo as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                   <td><img src="{{asset('uploads/'.$row->photo)}}" alt="" style="width: 200px"></td>
                                                   <td>{{$row->caption}}</td>
                                                   <td>{{$row->language->name}}</td>
                                                     <td class="pt_10 pb_10">
                                                     <a href="{{ route('photoEdit',$row->id)}}" class="btn btn-primary" >Edit</a>
                                                     <a href="{{route('photoDelete',$row->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
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