@extends('backend.admin.master')

@section('heading', 'Add FAQ')

@section('button')
                        <a href="{{route('FaqShow')}}" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
@endsection


@section('content')

<div class="section-body">
    <form action="{{route('faqStore')}}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="row">
            <div class="col-9 offset-1">
                <div class="card">
                    <div class="card-body">
                              <div class="form-group mb-3">
                            <label>FAQ Title*</label>
                            <input type="text" class="form-control" name="faq_title">
                        </div>
                        <div class="form-group mb-3">
                            <label>FAQ Detail*</label>
                            <textarea name="faq_detail" class="form-control snote" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label>Select Language</label>
                            <select name="language_id" class="form-control">
                                @foreach ($global_Language as $row)
                                <option value="{{$row->id}}">{{$row->name}} </option>
                                    
                                @endforeach
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