            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="{{route('Author_home')}}">Author Panel</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.html"></a>
                </div>

                <ul class="sidebar-menu">

                    <li class="{{Request::is('author/home') ? 'active' : ''}}"><a class="nav-link" href="{{route('Author_home')}}"><i class="fas fa-hand-point-right"></i> <span>Dashboard</span></a></li>
                    <li class="{{Request::is('author/post*') ? 'active' : ''}}"><a class="nav-link" href="{{route('Authorpost')}}"><i class="fas fa-hand-point-right"></i> <span>News Posts</span></a></li>
                    
                </ul>
            </aside>