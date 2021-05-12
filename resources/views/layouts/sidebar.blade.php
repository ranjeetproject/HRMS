<aside class="main-sidebar elevation-4 sidebar-dark-maroon">{{--main-sidebar sidebar-dark-primary elevation-4--}}
    <a href="{{action('HomeController@index')}}" class="brand-link navbar-primary">
        {{--<img src="{{asset('images/thumbnail.png')}}" alt="AdminLTE"
             class="brand-image img-circle elevation-3" style="opacity: .8">--}}
        <span class="brand-text font-weight-light">
            <b>Hrms {{$loginUser->name}}</b>
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
                @if($loginUser->user_type == 2)
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'skills') ? 'active' : '' }}"
                        href="{{action('SkillController@index')}}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Add Skills</p>
                    </a>
                </li>
                @endIf
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'final-round') ? 'active' : '' }}"
                        href="{{action('FinalRoundController@index')}}">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>Final Round List</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'offer-list') ? 'active' : '' }}"
                        href="{{action('OfferedController@index')}}">
                        <i class="nav-icon fas fa-id-badge"></i>
                        <p>Offered Candidate List</p>
                    </a>
                </li>
                 <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'current-employee-list') ? 'active' : '' }}"
                        href="{{action('EmployeeDetailsController@currentEmployeeList')}}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Current Employee</p>
                    </a>
                </li>
                 <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'user-log') ? 'active' : '' }}"
                        href="{{action('NotificationController@index')}}">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>User Log</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'salary-set-up') ? 'active' : '' }}"
                        href="{{action('SalarySetUpController@index')}}">
                        <i class="nav-icon fas fa-money-bill-alt"></i>
                        <p>Salary Set Up</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'released-employees') ? 'active' : '' }}"
                        href="{{action('ReleasedEmployeesController@index')}}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Released Employees</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'leave-application') ? 'active' : '' }}"
                        href="{{action('LeaveApplicationController@index')}}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>Leave Application</p>
                    </a>
                </li>
                 <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'team-members') ? 'active' : '' }}"
                        href="{{action('TeamMemberController@index')}}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Team Member</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'skills-acquired') ? 'active' : '' }}"
                        href="{{action('SkillsAcquiredController@index')}}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Skills Acquired</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'skills-approved') ? 'active' : '' }}"
                        href="{{action('SkillsApprovedController@index')}}">
                        <i class="nav-icon fas fa-thumbs-up"></i>
                        <p>Approved Skills</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'holidays') ? 'active' : '' }}"
                        href="{{action('HolidayController@index')}}">
                        <i class="nav-icon fas fa-gift"></i>
                        <p>Holidays</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'performance-feedback') ? 'active' : '' }}"
                        href="{{action('PerformanceFeedbackController@index')}}">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>Performance Feedback</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'designation') ? 'active' : '' }}"
                        href="{{action('DesignationController@index')}}">
                        <i class="nav-icon fab fa-dyalog"></i>
                        <p>Designation</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'department') ? 'active' : '' }}"
                        href="{{action('DepartmentController@index')}}">
                        <i class="nav-icon far fa-building"></i>
                        <p>Department</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ (request()->segment(2) == 'user-permission') ? 'active' : '' }}"
                        href="{{action('UserPermissionController@index')}}">
                        <i class="nav-icon fas fa-person-booth"></i>
                        <p>User Permission</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

