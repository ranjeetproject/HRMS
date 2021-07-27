<nav class="main-header navbar navbar-expand navbar-primary navbar-dark">{{--navbar-dark navbar-secondary--}}{{--navbar-orange navbar-light--}}

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{action('HomeController@index')}}" class="nav-link">Dashboard</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    {{--<form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i> &nbsp;{{$loginUser->name}}
            </a>
            <div class="dropdown-menu dropdown-menu dropdown-menu-right">
                <a href="{{action('UserController@changePasswordForm')}}" class="dropdown-item">
                    <i class="fas fa-user-lock mr-2"></i>
                    Change Password
                </a>
                {{-- <div class="dropdown-divider"></div> --}}
                {{-- <a href="" class="dropdown-item">
                    <i class="fas fa-cog"></i>
                    <span>Edit Site Configuration</span>
                </a> --}}
                <div class="dropdown-divider"></div>
                <a href="{{action('LoginController@getLogOut')}}" class="dropdown-item">
                    <i class="fas fa-power-off mr-2"></i>
                    <span>Log Out</span>
                </a>
            </div>
        </li>
    </ul>
</nav>
