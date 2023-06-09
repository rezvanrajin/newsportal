@extends('frontend.master')

@section('content')


<div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{PHOTO_GALLERY}}</h2>
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('Home')}}">{{HOME}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{PHOTO_GALLERY}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="page-content">
            <div class="container">
                <div class="photo-gallery">
                    <div class="row">
                        @foreach ($photo as $item)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="photo-thumb">
                                <img src="{{asset('uploads/'.$item->photo)}}" alt="">
                                <div class="bg"></div>
                                <div class="icon">
                                    <a href="{{asset('uploads/'.$item->photo)}}" class="magnific"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="photo-caption">
                                <a href="">{{$item->caption}}</a>
                            </div>
                            <div class="photo-date">
                                <i class="fas fa-calendar-alt"></i> {{$item->created_at}}
                            </div>
                        </div>
        
                        @endforeach

                        <div class="col-md-12">
                            {{$photo->links()}}
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
@endsection