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
                    <a class="nav-link {{ (request()->segment(2) == 'recruitment') ? 'active' : '' }}"
                       href="{{action('RecruitmentController@index')}}">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                           Recruitment Manage
                        </p>
                    </a>
                </li>
                  <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'skills') ? 'active' : '' }}"
                        href="{{action('SkillController@index')}}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Add Skills</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

