@extends('frontend.master')

@section('content')


<div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{VIDEO_GALLERY}}</h2>
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('Home')}}">{{HOME}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{VIDEO_GALLERY}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="page-content">
            <div class="container">
                <div class="video-gallery">
                    <div class="row">
                        @foreach ($video as $item)
                        <div class="col-lg-3 col-md-4">
                            <div class="video-thumb">
                                <img src="http://img.youtube.com/vi/{{$item->video_id}}/0.jpg" alt="">
                                <div class="bg"></div>
                                <div class="icon">
                                    <a href="http://www.youtube.com/watch?v={{$item->video_id}}" class="video-button"><i class="fas fa-play"></i></a>
                                </div>
                            </div>
                            <div class="video-caption">
                                <a href="">{{$item->caption}}</a>
                            </div>
                            <div class="video-date">
                                <i class="fas fa-calendar-alt"></i> {{$item->created_at}}
                            </div>
                        </div>
        
                        @endforeach

                        <div class="col-md-12">
                            {{$video->links()}}
                        </div>
        
                    </div>
                </div>
            </div>
        </div>
@endsection