@extends('frontend.master')

@section('content')


<div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{$page->disclaimer_title}}</h2>
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('Home')}}">{{HOME}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Disclaimer</li>
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
                {!!$page->disclaimer_detail !!}
                    </div>
                </div>
            </div>
        </div>
@endsection