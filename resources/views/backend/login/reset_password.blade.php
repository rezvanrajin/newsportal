<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="uploads/favicon.png">

    <title>Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    @include('backend.layout.styles')

    @include('backend.layout.scripts')


</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <section class="section">
            <div class="container container-login">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary border-box">
                            <div class="card-header card-header-auth">
                                <h4 class="text-center">Reset Password</h4>
                            </div>
                            <div class="card-body card-body-auth">
                                @if(session()->get('success'))
                                    <div class="text-success">{{session()->get('success')}}</div>
                                    @endif
                                <form method="POST" action="{{route('ResetPasswordPost')}}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <input type="hidden" name="email" value="{{$email}}">
                                    <div class="form-group">
                                        <input type="password" class="form-control @error('password') is-valid @enderror" name="password" placeholder="Password Address" autofocus>
                                           @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control @error('confrim_password') is-valid @enderror" name="confrim_password" placeholder="Password Confrim" autofocus>
                                           @error('confrim_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Update
                                        </button>
                                    </div>
                                         </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@include('backend.layout.scripts')

</body>
</html>