            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="index.html">Admin Panel</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.html"></a>
                </div>

                <ul class="sidebar-menu">

                    <li class="{{Request::is('admin/home') ? 'active' : ''}}"><a class="nav-link" href="{{route('Admin')}}"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                    <li class="{{Request::is('admin/setting') ? 'active' : ''}}"><a class="nav-link" href="{{route('setting')}}"><i class="fas fa-cog"></i> <span>Setting</span></a></li>
                    <li class="{{Request::is('admin/author*') ? 'active' : ''}}"><a class="nav-link" href="{{route('AuthorShow')}}"><i class="fas fa-users-cog"></i> <span>Author Section</span></a></li>

                    <li class="nav-item dropdown {{Request::is('admin/top-ads')||Request::is('admin/home-ads')||Request::is('admin/sidebar-ads') ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-ad"></i></i><span>Ads</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{Request::is('admin/top-ads') ? 'active' : ''}}"><a class="nav-link" href="{{route('TopAds')}}"><i class="fas fa-angle-right"></i>Top Bar ads </a></li>
                            <li class="{{Request::is('admin/home-ads') ? 'active' : ''}}"><a class="nav-link" href="{{route('HomeAds')}}"><i class="fas fa-angle-right"></i> Home Ads</a></li>
                            <li class="{{Request::is('admin/sidebar-ads') ? 'active' : ''}}"><a class="nav-link" href="{{route('SidebarAds')}}"><i class="fas fa-angle-right"></i> Sidebar Ads</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown {{Request::is('admin/category*')||Request::is('admin/sub-category-create*')||Request::is('admin/post-create*') ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-newspaper"></i><span>News</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{Request::is('admin/category') ? 'active' : ''}}"><a class="nav-link" href="{{route('categoryCreate')}}"><i class="fas fa-angle-right"></i> Add Category </a></li>
                            <li class="{{Request::is('admin/sub-category-create') ? 'active' : ''}}"><a class="nav-link" href="{{route('SubcategoryCreate')}}"><i class="fas fa-angle-right"></i> Add Sub Category </a></li>
                            <li class="{{Request::is('admin/post-create') ? 'active' : ''}}"><a class="nav-link" href="{{route('postCreate')}}"><i class="fas fa-angle-right"></i> Add Post </a></li>
                        </ul>
                    </li>

                    <li class="{{Request::is('admin/photo*') ? 'active' : ''}}"><a class="nav-link" href="{{route('photoCreate')}}"><i class="fas fa-photo-video"></i><span>Photo</span></a></li>

                    <li class="nav-item dropdown {{Request::is('admin/video*') ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-video"></i></i><span>Video's Section</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{Request::is('admin/videoView') ? 'active' : ''}}"><a class="nav-link" href="{{route('videoView')}}"><i class="fas fa-angle-right"></i>Video Gallery</a></li>
                            <li class="{{Request::is('admin/LiveVideoView') ? 'active' : ''}}"><a class="nav-link" href="{{route('LiveVideoView')}}"><i class="fas fa-angle-right"></i> Live Channel</a></li>

                        </ul>
                    </li>
 
                    
                    <li class="nav-item dropdown {{Request::is('admin/page/*') ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-pager"></i><span>Pages</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{Request::is('admin/page/about') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin_about_page')}}"><i class="fas fa-angle-right"></i>About</a></li>
                            <li class="{{Request::is('admin/page/faq') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin_faq_page')}}"><i class="fas fa-angle-right"></i> FAQ</a></li>
                            <li class="{{Request::is('admin/page/contact') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin_contact_page')}}"><i class="fas fa-angle-right"></i> Contact</a></li>
                            <li class="{{Request::is('admin/page/login') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin_login_page')}}"><i class="fas fa-angle-right"></i> Login</a></li>
                            <li class="{{Request::is('admin/page/terms') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin_terms_page')}}"><i class="fas fa-angle-right"></i> Terms and conditions</a></li>
                            <li class="{{Request::is('admin/page/privacy') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin_privacy_page')}}"><i class="fas fa-angle-right"></i> Privacy Policy</a></li>
                            <li class="{{Request::is('admin/page/disclaimer') ? 'active' : ''}}"><a class="nav-link" href="{{route('admin_disclaimer_page')}}"><i class="fas fa-angle-right"></i> Disclaimer</a></li>
                        </ul>
                    </li>
                    <li class="{{Request::is('admin/FaqShow*') ? 'active' : ''}}"><a class="nav-link" href="{{route('FaqShow')}}"><i class="fas fa-trophy"></i> <span>FAQ</span></a></li>
                    <li class="{{Request::is('admin/OnlinePoolView*') ? 'active' : ''}}"><a class="nav-link" href="{{route('OnlinePoolView')}}"><i class="fas fa-poll"></i> <span>Online Pool</span></a></li>
                    <li class="{{Request::is('admin/SocialIconShow*') ? 'active' : ''}}"><a class="nav-link" href="{{route('SocialIconShow')}}"><i class="fas fa-hashtag"></i> <span>Social Icon</span></a></li>
                    <li class="{{Request::is('admin/LanguageShow*') ? 'active' : ''}}"><a class="nav-link" href="{{route('LanguageShow')}}"><i class="fas fa-language"></i> <span>Language Section</span></a></li>
                    
                    
                    
                    <li class="nav-item dropdown {{Request::is('admin/subsriber*') ? 'active' : ''}}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-tie"></i><span>Subscriber</span></a>
                        <ul class="dropdown-menu">
                            <li class="{{Request::is('admin/subsriber/allSubsriberShow') ? 'active' : ''}}"><a class="nav-link" href="{{route('allSubsriberShow')}}"><i class="fas fa-angle-right"></i> All Subscriber </a></li>
                            <li class="{{Request::is('admin/subsriber/SubscriberSendMail') ? 'active' : ''}}"><a class="nav-link" href="{{route('Subscriber_send_mail')}}"><i class="fas fa-angle-right"></i> Send Mail Subcriber </a></li>
                        </ul>
                    </li>
                </ul>
            </aside>