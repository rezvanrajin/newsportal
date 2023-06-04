@extends('backend.admin.master')

@section('heading', 'Edit Category')

@section('button')
                        <a href="{{route('categoryView')}}" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
@endsection


@section('content')

<div class="section-body">
    <form action="{{route('categoryUpdate',$category->id)}}" method="post" enctype="multipart/form-data">
       @csrf
        <div class="row">
            <div class="col-9 offset-1">
                <div class="card">
                    <div class="card-body">
                              <div class="form-group mb-3">
                            <label>Category Name*</label>
                            <input type="text" class="form-control" name="category_name" value="{{$category->category_name}}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Show On Menu</label>
                            <select name="show_on_menu" class="form-control">
                                <option value="Show" @if($category->show_on_menu == 'Show') selected @endif()>Show</option>
                                <option value="Hide" @if($category->show_on_menu == 'Hide') selected @endif()>Hide</option>
                            </select>

                        </div>
                        <div class="form-group mb-3">
                            <label>Category Order*</label>
                            <input type="text" class="form-control" name="category_order" value="{{$category->category_order}}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Select Language</label>
                            <select name="language_id" class="form-control">
                                @foreach ($global_Language as $row)
                                <option value="{{$row->id}}" @if($row->id == $category->language_id) selected @endif>{{$row->name}} </option>
                                    
                                @endforeach
                            </select>
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