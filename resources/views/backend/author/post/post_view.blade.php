@extends('backend.author.master')

@section('heading', 'Post')
@section('button')
                        <a href="{{route('AuthorpostCreate')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
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
                                                <th>Thumbnail</th>
                                                <th>Post Title</th>
                                                <th>Sub Category</th>
                                                <th>Category</th>
                                                <th>Author</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($post as $row)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                    <td><img src="{{asset('uploads/'.$row->post_photo)}}" alt="" style="width: 150px;"></td>
                                                   <td>{{$row->post_title}}</td>
                                                   <td>{{$row->subcategory->subcategory_name}}</td>
                                                   <td>{{$row->subcategory->category->category_name}}</td>
                                                   <td>     
                                                    @if($row->author_id != 0)
                                                    {{Auth::guard('author')->user()->name}}
                                                    @endif
                                                </td>
                                                <td class="pt_10 pb_10">
                                                     <a href="{{ route('AuthorpostEdit',$row->id)}}" class="btn btn-primary" >Edit</a>
                                                     <a href="{{ route('AuthorpostDelete',$row->id)}}" class="btn btn-danger" onClick="return confirm('Are you sure?');">Delete</a>
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