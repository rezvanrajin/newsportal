@extends('backend.admin.master')

@section('heading', 'Send Mail TO Subsriber')

@section('button')
                        <a href="{{route('categoryView')}}" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
@endsection


@section('content')

<div class="section-body">
    <form action="{{route('Subscriber_send_mail_submit')}}" method="post">
       @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                              <div class="form-group mb-3">
                            <label>Subject*</label>
                            <input type="text" class="form-control" name="subject" value="">
                        </div>
                        <div class="form-group mb-3">
                            <label>Message*</label>
                            <textarea name="message" class="form-control snote" cols="30" rows="10"></textarea>
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