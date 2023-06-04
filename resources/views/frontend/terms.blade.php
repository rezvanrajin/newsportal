@extends('frontend.master')

@section('content')


<div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{$page->terms_title}}</h2>
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('Home')}}">{{HOME}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$page->terms_title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                {!!$page->terms_detail !!}
                    </div>
                </div>
            </div>
        </div>
@endsection