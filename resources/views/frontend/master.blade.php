 @if (!session()->get('lang_short_name'))
@php
$current_short_name = $global_default_lang_data;
@endphp
@else
@php
$current_short_name = session()->get('lang_short_name');
@endphp

@endif
@php
   $current_language_id = \App\Models\Language::where('short_name',$current_short_name)->first()->id;
@endphp



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
        <meta name="description" content="">
        <title>News Portal Website</title>        
		
        <link rel="icon" type="image/png" href="{{asset('uploads/'.$global_Setting_post->favicon)}}">

        <!-- All CSS -->
        <link rel="stylesheet" href="{{asset('dist/asset/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/asset/css/jquery-ui.css')}}">
        <link rel="stylesheet" href="{{asset('dist/asset/css/animate.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/asset/css/magnific-popup.css')}}">
        <link rel="stylesheet" href="{{asset('dist/asset/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/asset/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/asset/css/select2-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/asset/css/sweetalert2.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/asset/css/spacing.css')}}">
        <link rel="stylesheet" href="{{asset('dist/asset/css/font_awesome_5_free.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/asset/css/style.css')}}">
        <link rel="stylesheet" href="{{ asset('dist/css/iziToast.min.css')}}">
        
        <!-- All Javascripts -->
        <script src="{{asset('dist/asset/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('dist/asset/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('dist/asset/js/jquery-ui.js')}}"></script>
        <script src="{{asset('dist/asset/js/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{asset('dist/asset/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('dist/asset/js/wow.min.js')}}"></script>
        <script src="{{asset('dist/asset/js/select2.full.js')}}"></script>
        <script src="{{asset('dist/asset/js/sweetalert2.min.js')}}"></script>
        <script src="{{asset('dist/asset/js/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('dist/asset/js/acmeticker.js')}}"></script>
        <script src="{{ asset('dist/js/iziToast.min.js')}}"></script>

        <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">

        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6212352ed76fda0a"></script>        
        
        <!-- Google Analytics -->
        @if($global_Setting_post->analytic_status == 'Show')
        <script async src="https://www.googletagmanager.com/gtag/js?id={{$global_Setting_post->analytic_id}}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-84213520-6');
        </script>
    @endif
        <style>
            .website-menu,
            .website-menu .bg-primary,
            .acme-news-ticker-label,
            .search-section button[type="submit"],
            .home-content .left .news-total-item .see-all a,
            .video-content,
            .footer ul.social li a,
            .footer input[type="submit"],
            .scroll-top,
            .widget .poll button,
            .nav-pills .nav-link.active,
            .related-news .owl-nav .owl-prev,  
            .related-news .owl-nav .owl-next,
            .bg-website 
            {
                background: #{{$global_Setting_post->theme_color_1}}!important;
            }
            .acme-news-ticker {
                border-color: #{{$global_Setting_post->theme_color_1}}!important;

            }
            ul.my-news-ticker li a,
            .home-content .left .news-total-item .left-side h3 a:hover,
            .home-content .left .news-total-item .right-side-item .right h2 a:hover,
            .home-content .left .news-total-item .left-side .date-user .user a:hover,
            .home-content .left .news-total-item .left-side .date-user .date a:hover,
            .home-content .left .news-total-item .right-side-item .right .date-user .user a:hover,
            .home-content .left .news-total-item .right-side-item .right .date-user .date a:hover,
            .widget .news-item .right h2 a:hover,
            .widget .news-item .right .date-user .user a:hover,
            .widget .news-item .right .date-user .date a:hover,
            .nav-pills .nav-link,
            .video-carousel .owl-nav .owl-prev,
            .video-carousel .owl-nav .owl-next,
            li.breadcrumb-item a,
            .category-page-post-item h3 a:hover,
            .category-page-post-item .date-user .user a:hover,
            .category-page-post-item .date-user .date a:hover,
            .related-news .item h3 a:hover,
            .related-news .item .date-user .user a:hover,
            .related-news .item .date-user .date a:hover,
            .accordion-button:not(.collapsed),
            .login-form a
            {
                color : #{{$global_Setting_post->theme_color_1}}!important;
            }
            .top{
                 background: #{{$global_Setting_post->theme_color_2}}!important;
                }
            .nav-pills .nav-link.active
            {
                color: #fff!important;
            }       
   
    
        </style>

    </head>
    <body>
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            @if($global_Setting_post->top_bar_date_status == 'Show')
                            <li class="today-text">{{TODAY}}: {{date('F d, Y')}}</li>
                            @endif
                            @if($global_Setting_post->top_bar_email_status == 'Show')
                            <li class="email-text">{{$global_Setting_post->top_bar_email}}</li>
                            @endif

                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="right">
                            @php
                            $lang_data = \App\Models\Language::where('short_name',$current_short_name)->first()->id;
                                $page = \App\Models\Page::where('language_id',$lang_data)->first();
                            @endphp

                            @if($page->faq_status == 'Show')
                            <li class="menu"><a href="{{route('Faq')}}">{{$page->faq_title}}</a></li>
                            @endif

                        @if($page->about_status == 'Show')
                            <li class="menu"><a href="{{route('About')}}">{{$page->about_title}}</a></li>
                                @endif
                                @if($page->contact_status == 'Show')
                            <li class="menu"><a href="{{route('Contact')}}">{{$page->contact_title}}</a></li>
                            @endif
                            @if($page->login_status == 'Show')
                            <li class="menu"><a href="{{route('Login')}}">{{$page->login_title}}</a></li>
                            @endif
                            <li>
                                <div class="language-switch">
                                    <form action="{{route('SwitchLanguage')}}" method="POST">
                                        @csrf
                                    <select name="short_name" onchange="this.form.submit()">
                                        @foreach($global_Language as $item)
                                        <option value="{{$item->short_name}}" @if($item->short_name == $current_short_name) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="heading-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex align-items-center">
                        <div class="logo">
                            <a href="{{route('Home')}}">
                                <img src="{{asset('uploads/'.$global_Setting_post->logo)}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @if($global_top_ad_data->top_ad_status == 'Show')
                        <div class="ad-section-1">
                        @if($global_top_ad_data->top_ad_url == '')
                            <img src="{{asset('uploads/'.$global_top_ad_data->top_ad)}}" alt="">
                            @else
                            <a href="{{$global_top_ad_data->top_ad_url}}"><img src="{{asset('uploads/'.$global_top_ad_data->top_ad)}}" alt=""></a>
                        @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="website-menu">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="{{route('Home')}}">{{HOME}}</a>
                                    </li>
                                    @foreach($global_categories as $item)
                                    @if($current_language_id == $item->language_id)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="javascript:void;" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              {{$item->category_name}}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach ($item->rsubcategory as $item2)
                                            <li><a class="dropdown-item" href="{{route('category',$item2->id)}}">{{$item2->subcategory_name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endif
                                    @endforeach
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{GALLERY}}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="{{route('FrontendPhoto')}}">{{PHOTO_GALLERY}}</a></li>
                                            <li><a class="dropdown-item" href="{{route('FrontendVideo')}}">{{VIDEO_GALLERY}}</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>       


    @yield('content')

        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="item">
                            <h2 class="heading">{{FOOTER_COL_1_HEADING}}</h2>
                            <p>
                            {{FOOTER_COL_1_TEXT}}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="item">
                            <h2 class="heading">{{FOOTER_COL_2_HEADING}}</h2>
                            <ul class="useful-links">
                                <li><a href="{{route('Home')}}">{{HOME}}</a></li>
                                @if($page->terms_status == 'Show')
                                <li><a href="{{route('Terms')}}">{{$page->terms_title}}</a></li>
                                @endif
                                @if($page->privacy_status == 'Show')
                                <li><a href="{{route('Privacy')}}">{{$page->privacy_title}}</a></li>
                                @endif
                                @if($page->disclaimer_status == 'Show')
                                <li><a href="{{route('Disclaimer')}}">{{$page->disclaimer_title}}</a></li>
                                @endif
                                @if($page->contact_status == 'Show')
                                <li><a href="{{route('Contact')}}">{{$page->contact_title}}</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-3">
                        <div class="item">
                            <h2 class="heading">{{FOOTER_COL_3_HEADING}}</h2>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="right">
                                    {{FOOTER_ADDRESS}}
                                </div>
                            </div>
                            <div class="list-item">
                                <div class="left">
                                    <i class="far fa-envelope"></i>
                                </div>
                                <div class="right">
                                    {{FOOTER_EMAIL}}
                                </div>
                            </div>
                            <div class="list-item">
                                <div class="left">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="right">
                                   {{FOOTER_PHONE}}
                                </div>
                            </div>
                            <ul class="social">
                                @foreach ($global_SocialIcon as $item)
                                <li><a href="{{$item->url}}" target="_blank"><i class="{{$item->icon}}"></i></a></li>               
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="item">
                            <h2 class="heading">{{FOOTER_COL_4_HEADING}}</h2>
                            <p>
                               {{NEWSLETTER_TEXT}}
                            </p>
                            <form action="{{route('subscriber_email')}}" method="post" class="form_contact_ajax">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="{{EMAIL_ADDRESS}}">
                                <span class="tex-danger error-text email_error"></span>

                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="{{SUBSCRIBE_NOW}}">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="copyright">
            {{COPYRIGHT_TEXT}}
        </div>
     
        <div class="scroll-top">
            <i class="fas fa-angle-up"></i>
        </div>
		
        <script src="{{asset('dist/asset/js/custom.js')}}"></script>        
		
        <script>
            (function($){
                $(".form_contact_ajax").on('submit', function(e){
                    e.preventDefault();
                    $('#loader').show();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend:function(){
                            $(form).find('span.error-text').text('');
                        },
                        success:function(data)
                        {
                            $('#loader').hide();
                            if(data.code == 0)
                            {
                                $.each(data.error_message, function(prefix, val) {
                                    $(form).find('span.'+prefix+'_error').text(val[0]);
                                });
                            }
                            else if(data.code == 1)
                            {
                                $(form)[0].reset();
                                iziToast.success({
                                    title: '',
                                    position: 'topRight',
                                    message: data.success_message,
                                });
                            }
                            
                        }
                    });
                });
            })(jQuery);
        </script>
        <div id="loader"></div>


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
   </body>
</html>