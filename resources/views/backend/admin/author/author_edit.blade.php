@extends('backend.admin.master')

@section('heading', 'Add Author')

@section('button')
                        <a href="{{route('AuthorShow')}}" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
@endsection


@section('content')

<div class="section-body">
    <form action="{{route('AuthorUpdate',$author->id)}}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Existing Photo</label>
                           <div> 
                            <img src="{{asset('uploads/'.$author->photo)}}" alt="" style="width: 150px">
                        </div>
                        </div>
                        <div class="form-group mb-3">
                            <label>Author Photo*</label>
                           <div> <input type="file" name="photo"></div>
                        </div>
                              <div class="form-group mb-3">
                            <label>Name*</label>
                            <input type="text" class="form-control" name="name" value="{{$author->name}}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email*</label>
                            <input type="text" class="form-control" name="email" value="{{$author->email}}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Password*</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group mb-3">
                            <label>Confirm Password*</label>
                            <input type="password" class="form-control" name="retype_password">
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