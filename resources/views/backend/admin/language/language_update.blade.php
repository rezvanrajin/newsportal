@extends('backend.admin.master')

@section('heading', 'Language Update Details')
@section('button')
                        <a href="{{route('LanguageShow')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Back to Previous Page</a>
@endsection
 @section('content')

<div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('LanguageUpdateDetailsPost',$lang_id)}}" method="post">
                                    @csrf 
                                        <div class="table-responsive">
                                        <table class="table table-bordered" id="">
                                            <thead>
                                            <tr>
                                                <th style="width: 40px">SL</th>
                                                <th style="width: 40%">Key</th>
                                                <th>Value</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($json_data as $key=>$value)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                   <td>{{$key}}</td>
                                                   <td>
                                                    <input type="hidden" name="arr_key[]" class="form-control" value="{{$key}}">
                                                    <input type="text" name="arr_value[]" class="form-control" value="{{$value}}">
                                                   </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group" style="text-align: center">
                                        <button type="submit" class="btn btn-primary">Update</button>
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