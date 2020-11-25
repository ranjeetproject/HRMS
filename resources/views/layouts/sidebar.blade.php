<aside class="main-sidebar elevation-4 sidebar-dark-maroon">{{--main-sidebar sidebar-dark-primary elevation-4--}}
    <a href="{{action('HomeController@index')}}" class="brand-link navbar-primary">
        {{--<img src="{{asset('images/thumbnail.png')}}" alt="AdminLTE"
             class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light">
            <b>Hrms Admin</b>
        </span>
    </a>
    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(2) == 'dashboard') ? 'active' : '' }}"
                       href="{{action('HomeController@index')}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (request()->segment(2) == 'member') ? 'active' : '' }}"
                       href="">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Member Manage
                        </p>
                    </a>
                </li>
                  <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'category') ? 'active' : '' }}"
                        href="">
                        <i class="fas fa-images nav-icon"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'account-info') ? 'active' : '' }}"
                        href="">
                        <i class="fas fa-images nav-icon"></i>
                        <p>Account-Info Manage</p>
                    </a>
                </li>
            
            </ul>
        </nav>
    </div>
</aside>

