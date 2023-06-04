@extends('frontend.master')

@section('content')


<div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{$news_post->post_title}}</h2>
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('Home')}}">{{HOME}}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('category',$news_post->subcategory_id)}}">{{$news_post->subcategory->subcategory_name}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$news_post->post_title}}</li>
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
                        <div class="featured-photo">
                            <img src="{{asset('uploads/'.$news_post->post_photo)}}" alt="">
                        </div>
                        <div class="sub">
                            <div class="item">
                                <b><i class="fas fa-user"></i></b>
                                <a href="">{{$user->name}}</a>
                            </div>
                            <div class="item">
                                <b><i class="fas fa-edit"></i></b>
                                <a href="{{route('category',$news_post->subcategory_id)}}">{{$news_post->subcategory->subcategory_name}}</a>
                            </div>
                            <div class="item">
                                <b><i class="fas fa-clock"></i></b>
                                {{$news_post->created_at}}
                            </div>
                            <div class="item">
                                <b><i class="fas fa-eye"></i></b>
                                {{$news_post->visitor}}
                            </div>
                        </div>
                        <div class="main-text">
                            
                            <p>
                                {!! $news_post->post_details !!}
                            </p>
                        </div>
                        <div class="tag-section">
                            <h2>{{TAGS}}</h2>
                            <div class="tag-section-content">
                                @foreach ($tags as $item)
                                <a href="{{route('TagShow',$item->tag_name)}}"><span class="badge bg-success">{{$item->tag_name}}</span></a>
                                @endforeach
                            </div>
                        </div>
                        @if($news_post->share)
                        <div class="share-content">
                            <h2>{{SHARE}}</h2>
                            <div class="addthis_inline_share_toolbox"></div>
                        </div>
                        @endif
                        @if($news_post->comment)
                        <div class="comment-fb">
                            <h2>{{COMMENT}}</h2>
                            <div id="disqus_thread"></div>
                        {!!$global_Setting_post->disqus_code!!}
                        </div>
                        @endif
                        <div class="related-news">
                            <div class="related-news-heading">
                                <h2>{{RELATED_NEWS}}</h2>
                            </div>
                            <div class="related-post-carousel owl-carousel owl-theme">

                                @foreach ($related_post as $item)
                                @if($item->id == $news_post->id)
                                @continue
                                @endif
                                <div class="item">
                                    <div class="photo">
                                        <img src="{{asset('uploads/'.$item->post_photo)}}" alt="">
                                    </div>
                                    <div class="category">
                                        <span class="badge bg-success">{{$item->subcategory->subcategory_name}}</span>
                                    </div>
                                    <h3><a href="{{route('NewsDetails',$item->id)}}">{{$item->post_title}}</a></h3>
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
                                @endforeach
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