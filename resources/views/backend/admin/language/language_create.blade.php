@extends('backend.admin.master')

@section('heading', 'Add Language')

@section('button')
                        <a href="{{route('LanguageShow')}}" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
@endsection


@section('content')

<div class="section-body">
    <form action="{{route('LanguageStore')}}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="row">
            <div class="col-9 offset-1">
                <div class="card">
                    <div class="card-body">
                              <div class="form-group mb-3">
                            <label>Name*</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group mb-3">
                            <label>Short Name*</label>
                            <input type="text" class="form-control" name="short_name">
                        </div>
                        <div class="form-group mb-3">
                            <label>Is Default?*</label>
                        <select name="is_default" class="form-control">
                            <option value="Yes">Yes</option> 
                            <option value="No">No</option> 
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