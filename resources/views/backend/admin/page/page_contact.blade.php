@extends('backend.admin.master')

@section('heading', 'Edit Contact Page Content')


@section('content')

<div class="section-body">
            <div class="row">
            <div class="col-9 offset-1">
                @foreach ($page as $item)
                <h3>Language:{{$item->language->name}}</h3>        
         <form action="{{route('admin_contact_page_update')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                <div class="card">
                    <div class="card-body">
                              <div class="form-group mb-3">
                            <label>Title*</label>
                            <input type="text" class="form-control" name="contact_title" value="{{$item->contact_title}}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Detail*</label>
                            <textarea name="contact_detail" class="form-control snote" cols="30" role="10">{{$item->contact_detail}}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Map (iFrame Code)</label>
                            <textarea name="contact_map" class="form-control" cols="30" role="10" style="height: 120px">{{$item->contact_map}}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Status Show On</label>
                            <select name="contact_status" class="form-control">
                                <option value="Show" @if($item->contact_status == 'Show') selected @endif()>Show</option>
                                <option value="Hide" @if($item->contact_status == 'Hide') selected @endif()>Hide</option>
                            </select>
                        </div>
                        <div class="form-group" style="text-align: center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
            @endforeach
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