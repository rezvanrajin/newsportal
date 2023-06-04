@extends('backend.admin.master')

@section('heading', 'Language Show')
@section('button')
                        <a href="{{route('LanguageCreate')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
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
                                                <th>Name</th>
                                                <th>Short Name</th>
                                                <th>Is Default?</th>
                                                <th>Update Details</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($language as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                   <td>{{$row->name}}</td>
                                                   <td>{{$row->short_name}}</td>
                                                   <td>{{$row->is_default}}</td>
                                                   <td>
                                                    <a href="{{route('LanguageUpdateDetails',$row->id)}}" class="btn btn-success">Update Details</a>
                                                   </td>
                                                     <td class="pt_10 pb_10">
                                                     <a href="{{ route('LanguageEdit',$row->id)}}" class="btn btn-primary" >Edit</a>
                                                     @if($loop->iteration != 1)
                                                     <a href="{{route('LanguageDelete',$row->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
                                                     @endif
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