@extends('backend.author.master')

@section('heading', 'Add Post')

@section('button')
                        <a href="{{route('Authorpost')}}" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
@endsection


@section('content')

<div class="section-body">
    <form action="{{route('AuthorpostStore')}}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                              <div class="form-group mb-3">
                            <label>Post Title*</label>
                            <input type="text" class="form-control" name="post_title" value="">
                        </div>
                        <div class="form-group mb-3">
                            <label>Post Details*</label>
                            <textarea  name="post_details" class="form-control snote" cols="30" rows="10" value=""></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Post Photo*</label>
                           <div> <input type="file" name="post_photo"></div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Select Category*</label>
                            <select name="subcategory_id" class="form-control">
                                @foreach ($subcategories as $item)
                                <option value="{{$item->id}}">{{$item->subcategory_name}}({{
                                    $item->category->category_name
                                }})</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Is Share?</label>
                            <select name="share" class="form-control">
                                <option value="1">yes</option>
                                <option value="0">No</option>
                            </select>

                        </div>
                        <div class="form-group mb-3">
                            <label>Is Comment?</label>
                            <select name="comment" class="form-control">
                                <option value="1">yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Tag</label>
                            <input type="text" class="form-control" name="tag" value="">
                        </div>
                        <div class="form-group mb-3">
                            <label>Want to send to subscribers?</label>
                            <select name="subscribers_send" class="form-control">
                                <option value="1">yes</option>
                                <option value="0">No</option>
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