@extends('frontend.master')

@section('content')


<div class="page-top">
            <div class="container">
                <div class="row">
                    <div Sub="col-md-12">
          
                        <h2>{{ALL_POST_OF}} {{$updated_date}}</h2>
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('Home')}}">{{HOME}}</a></li> 
                                <li class="breadcrumb-item">{{ARCHIVE}}</li> 
                                <li class="breadcrumb-item active" aria-current="page">{{$updated_date}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="category-page">
                            <div class="row">

                                @if(count($post_data_archive))

                                @foreach ($post_data_archive as $item)
                                <div class="col-lg-6 col-md-12">
                                    <div class="category-page-post-item">
                                        <div class="photo">
                                            <img src="{{asset('uploads/'.$item->post_photo)}}" alt="">
                                        </div>
                                        <div class="category">
                                            <span class="badge bg-success">{{$item->subcategory->subcategory_name}}</span>
                                        </div>
                                        <h3><a href="{{route('NewsDetails',$item->id)}}" target="_blank">{{$item->post_title}}</a></h3>
                                        <div class="date-user">
                                            <div class="user">
                                                @if($item->author_id==0)
                                                @php
                                               $user_data = \App\Models\Admin::where('id',$item->admin_id)->first();
                                                @endphp
                                                @else
                                                @php
                                                $user_data = \App\Models\Author::where('id',$item->author_id)->first();
                                                 @endphp
                                                @endif
                                                <a href="">{{$user_data->name}}</a>
                                            </div>
                                            <div class="date">
                                                <a href="">{{$item->created_at}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <h2 class="text-danger">{{NO_POST_IS_FOUND}}</h2>
                                @endif
               <div class="col-md-12">
                {{$post_data_archive->links()}}
               </div>
                            </div>
                        </div>
        
                    </div>
                    <div class="col-lg-4 col-md-6 sidebar-col">
                        @include('frontend.layout.sidebar')

                    </div>
                </div>
            </div>
        </div>
@endsection