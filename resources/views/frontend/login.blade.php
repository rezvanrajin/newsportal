@extends('frontend.master')

@section('content')


<div class="page-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>{{LOGIN}}</h2>
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('Home')}}">{{HOME}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{LOGIN}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('LoginPost')}}" method="post">
                            @csrf
                        <div class="login-form">
                            <div class="mb-3">
                                <label for="" class="form-label">{{EMAIL_ADDRESS}}</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">{{PASSWORD}}</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary bg-website">{{LOGIN}}</button>
                                <a href="{{route("AuthorForgetPassword")}}">{{FORGET_PASSWORD}}</a>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
@endsection