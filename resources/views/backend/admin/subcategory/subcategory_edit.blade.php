@extends('backend.admin.master')

@section('heading', 'Edit Sub Category')

@section('button')
                        <a href="{{route('Subcategory')}}" class="btn btn-primary"><i class="fas fa-eye"></i> View</a>
@endsection


@section('content')

<div class="section-body">
    <form action="{{route('SubcategoryUpdate',$subcategory->id)}}" method="post">
       @csrf
        <div class="row">
            <div class="col-9 offset-1">
                <div class="card">
                    <div class="card-body">
                              <div class="form-group mb-3">
                            <label>Sub Category Name*</label>
                            <input type="text" class="form-control" name="subcategory_name" value="{{$subcategory->subcategory_name}}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Category Name</label>
                            <select name="category_id" class="form-control">
                                <option value="">Select one</option>
                                @foreach($category as $row)
                                <option value="{{$row->id}}" @if($subcategory->category_id == $row->id) selected @endif>{{$row->category_name}}</option>
                                 @endforeach   
                            </select>

                        </div>
                        <div class="form-group mb-3">
                            <label>Show On Menu</label>
                            <select name="show_on_menu" class="form-control">
                                <option value="Show" @if($subcategory->show_on_menu == 'Show') selected @endif()>Show</option>
                                <option value="Hide" @if($subcategory->show_on_menu == 'Hide') selected @endif()>Hide</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Show On Home</label>
                            <select name="show_on_home" class="form-control">
                                <option value="Show" @if($subcategory->show_on_home == 'Show') selected @endif()>Show</option>
                                <option value="Hide" @if($subcategory->show_on_home == 'Hide') selected @endif()>Hide</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Sub Category Order*</label>
                            <input type="text" class="form-control" name="subcategory_order" value="{{$subcategory->subcategory_order}}">
                        </div>
                        <div class="form-group mb-3">
                            <label>Select Language</label>
                            <select name="language_id" class="form-control">
                                @foreach ($global_Language as $row)
                                <option value="{{$row->id}}" @if($row->id == $subcategory->language_id) selected @endif>{{$row->name}} </option>
                                    
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