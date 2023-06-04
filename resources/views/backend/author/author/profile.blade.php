@extends('backend.author.master')

@section('heading','Edit Profile')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('AuthorProfilleUpdate')}}" method="post" enctype="multipart/form-data">
                        @csrf
                         <div class="row">
                            <div class="col-md-3">
                                <img src="{{asset('uploads/'.Auth::guard('author')->user()->photo)}}" alt="" class="profile-photo w_100_p">
                                <input type="file" class="form-control mt_10" name="photo">
                            </div>
                            <div class="col-md-9">
                                <div class="mb-4">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{Auth::guard('author')->user()->name}}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Email *</label>
                                    <input type="text" class="form-control" name="email" value="{{Auth::guard('author')->user()->email}}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="new_password">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Retype Password</label>
                                    <input type="password" class="form-control" name="retype_password">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
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
    