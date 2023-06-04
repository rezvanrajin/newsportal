@extends('backend.author.master')

@section('heading', 'Edit Post')

@section('button')
                        <a href="{{route('Authorpost')}}" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
@endsection


@section('content')

<div class="section-body">
    <form action="{{route('AuthorpostUpdate',$post->id)}}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                              <div class="form-group mb-3">
                            <label>Post Title*</label>
                            <input type="text" class="form-control" name="post_title" value="{{$post->post_title}}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Post Details*</label>
                            <textarea  name="post_details" class="form-control snote" cols="30" rows="10" >{{$post->post_details}}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Existing Post Photo*</label>
                           <div> <img src="{{asset('uploads/'.$post->post_photo)}}" alt="" style="width: 500px;"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Post Photo*</label>
                           <div> <input type="file" name="post_photo"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Select Category*</label>
                            <select name="subcategory_id" class="form-control">
                                @foreach ($subcategories as $item)
                                <option value="{{$item->id}}" @if($item->id == $post->subcategory_id) selected @endif>{{$item->subcategory_name}}({{
                                    $item->category->category_name
                                }})</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Is Share?</label>
                            <select name="share" class="form-control">
                                <option value="1" @if($post->share == 1) selected @endif>yes</option>
                                <option value="0" @if($post->share == 0) selected @endif>No</option>
                            </select>

                        </div>
                        <div class="form-group mb-3">
                            <label>Is Comment?</label>
                            <select name="comment" class="form-control">
                                <option value="1" @if($post->comment == 1) selected @endif>yes</option>
                                <option value="0" @if($post->comment == 0) selected @endif>No</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Existing Tag</label>
                            <table class="table table-brodered">
                            @foreach($existing_tags as $item)
                            <tr>

                            <td>{{$item->tag_name}}</td>
                            <td>
                                <a  href="{{route('AuthorPostTagDelete',[$item->id,$post->id])}}" onClick="return confirm('Are you sure?');">Delete</a>
                            </td>
                            </tr>
                            @endforeach
                           </table>
                        </div>
                        <div class="form-group mb-3">
                            <label>New Tag</label>
                            <input type="text" class="form-control" name="tag" value="">
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