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
                @if(@$checkModulePermission->hr_module == 'hr')
                <li class="nav-item has-treeview @if(request()->segment(1)=='recruitment' || request()->segment(1)=='final-round'
                       || request()->segment(1)=='offer-list' || request()->segment(1)=='current-employee-list' ||
                       request()->segment(1)=='salary-set-up' || request()->segment(1)=='released-employees' || request()->segment(1)=='interview-feedback-content' || request()->segment(1)=='rejected-list') menu-open
                       @endIf">
                    <a class="nav-link {{ (request()->segment(1) == 'recruitment') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'final-round') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'offer-list') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'current-employee-list') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'salary-set-up') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'released-employees') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'interview-feedback-content') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'rejected-list') ? 'active' : '' }}"
                       href="#">
                        <i class="nav-icon fas fa-angle-down"></i>
                        <p>
                           HR Modules
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(@$checkModulePermission->recruitment_view == '1')
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->segment(1) == 'recruitment') ? 'active' : '' }}"
                                href="{{action('RecruitmentController@index')}}">
                                    <i class="nav-icon fas fa-id-card"></i>
                                    <p>Recruitment Manage</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->final_round_list_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'final-round') ? 'active' : '' }}"
                                    href="{{action('FinalRoundController@index')}}">
                                    <i class="nav-icon fas fa-user-check"></i>
                                    <p>Final Round List</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->rejected_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'rejected-list') ? 'active' : '' }}"
                                    href="{{action('RejectedController@index')}}">
                                    <i class="nav-icon fas fa-user-alt-slash"></i>
                                    <p>Rejected List</p>
                                </a>
                            </li>
                         @endIf
                        @if(@$checkModulePermission->offered_candidate_list_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'offer-list') ? 'active' : '' }}"
                                    href="{{action('OfferedController@index')}}">
                                    <i class="nav-icon fas fa-id-badge"></i>
                                    <p>Offered Candidate List</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->current_employee_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'current-employee-list') ? 'active' : '' }}"
                                    href="{{action('EmployeeDetailsController@currentEmployeeList')}}">
                                    <i class="nav-icon fas fa-user-tie"></i>
                                    <p>Current Employee</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->salary_set_up_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'salary-set-up') ? 'active' : '' }}"
                                    href="{{action('SalarySetUpController@index')}}">
                                    <i class="nav-icon fas fa-money-bill-alt"></i>
                                    <p>Salary Set Up</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->released_employees_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'released-employees') ? 'active' : '' }}"
                                    href="{{action('ReleasedEmployeesController@index')}}">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>Released Employees</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->interview_feedback_content_view == '1')
                            <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1) == 'interview-feedback-content') ? 'active' : '' }}"
                                        href="{{action('InterviewFeedbackContentController@index')}}">
                                        <i class="nav-icon fas fa-edit"></i>
                                        <p>Interview Feedback Content</p>
                                    </a>
                            </li>
                        @endIf
                    </ul>
                </li>
                @endif
                @if(@$checkModulePermission->statutory_master == 'sm')
                <li class="nav-item has-treeview @if(request()->segment(1)=='holidays' || request()->segment(1)=='department'
                       || request()->segment(1)=='designation' || request()->segment(1)=='skills') menu-open
                       @endIf">
                    <a class="nav-link {{ (request()->segment(1) == 'holidays') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'department') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'designation') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'skills') ? 'active' : '' }}"
                       href="#">
                        <i class="nav-icon fas fa-angle-down"></i>
                        <p>
                           Statutory Masters
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         @if(@$checkModulePermission->add_skills_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'skills') ? 'active' : '' }}"
                                    href="{{action('SkillController@index')}}">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Add Skills</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->holiday_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'holidays') ? 'active' : '' }}"
                                    href="{{action('HolidayController@index')}}">
                                    <i class="nav-icon fas fa-gift"></i>
                                    <p>Holidays</p>
                                </a>
                            </li>
                        @endIf
                       @if(@$checkModulePermission->designation_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'designation') ? 'active' : '' }}"
                                    href="{{action('DesignationController@index')}}">
                                    <i class="nav-icon fab fa-dyalog"></i>
                                    <p>Designation</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->department_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'department') ? 'active' : '' }}"
                                    href="{{action('DepartmentController@index')}}">
                                    <i class="nav-icon far fa-building"></i>
                                    <p>Department</p>
                                </a>
                            </li>
                        @endIf
                    </ul>
                </li>
                @endif
                @if(@$checkModulePermission->super_user == 'su')
                <li class="nav-item has-treeview @if(request()->segment(1)=='user-permission' || request()->segment(1)=='user-log') menu-open
                       @endIf">
                    <a class="nav-link {{ (request()->segment(1) == 'user-permission') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'user-log') ? 'active' : '' }}"
                       href="#">
                        <i class="nav-icon fas fa-angle-down"></i>
                        <p>
                           Super User 
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(@$checkModulePermission->user_permission_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'user-permission') ? 'active' : '' }}"
                                    href="{{action('UserPermissionController@index')}}">
                                    <i class="nav-icon fas fa-person-booth"></i>
                                    <p>User Permission</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->user_log_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'user-log') ? 'active' : '' }}"
                                    href="{{action('NotificationController@index')}}">
                                    <i class="nav-icon fas fa-user-lock"></i>
                                    <p>User Log</p>
                                </a>
                            </li>
                        @endIf
                    </ul>
                </li>
                @endif
                @if(@$checkModulePermission->general == 'gr')
                    <li class="nav-item has-treeview @if(request()->segment(1)=='leave-application' || request()->segment(1)=='skills-acquired' || request()->segment(1)=='leave-pending-approval' 
                                                        || request()->segment(1)=='employees-leaves'|| request()->segment(1)=='employees-leaves-details') menu-open
                        @endIf">
                        <a class="nav-link {{ (request()->segment(1) == 'leave-application') ? 'active' : '' }}
                                        {{ (request()->segment(1) == 'skills-acquired') ? 'active' : '' }}
                                        {{ (request()->segment(1) == 'leave-pending-approval') ? 'active' : '' }}
                                        {{ (request()->segment(1) == 'employees-leaves') ? 'active' : '' }}
                                        {{ (request()->segment(1) == 'employees-leaves-details') ? 'active' : '' }}"
                        href="#">
                            <i class="nav-icon fas fa-angle-down"></i>
                            <p>
                            General
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(@$checkModulePermission->leave_application_view == '1')
                                <li class="nav-item ">
                                    <a class="nav-link {{ (request()->segment(1) == 'leave-application') ? 'active' : '' }}"
                                        href="{{action('LeaveApplicationController@index')}}">
                                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                        <p>Leave Application</p>
                                    </a>
                                </li>
                            @endIf
                            @if(@$checkModulePermission->skill_acquired_view == '1')
                                <li class="nav-item ">
                                    <a class="nav-link {{ (request()->segment(1) == 'skills-acquired') ? 'active' : '' }}"
                                        href="{{action('SkillsAcquiredController@index')}}">
                                        <i class="nav-icon fas fa-clipboard-list"></i>
                                        <p>Skills Acquired</p>
                                    </a>
                                </li>
                            @endIf
                            @if(@$checkModulePermission->pending_approve_leave_view == '1')
                                <li class="nav-item ">
                                    <a class="nav-link {{ (request()->segment(1) == 'leave-pending-approval') ? 'active' : '' }}"
                                        href="{{action('PendingApprovalController@index')}}">
                                        <i class="nav-icon fab fa-penny-arcade"></i>
                                        <p>Pending Approvals</p>
                                    </a>
                                </li>
                            @endIf
                            @if(@$checkModulePermission->employees_leaves_view == '1')
                                <li class="nav-item ">
                                    <a class="nav-link {{ (request()->segment(1) == 'employees-leaves') ? 'active' : '' }}"
                                        href="{{action('EmployeesLeaveController@index')}}">
                                        <i class="nav-icon fab fa-canadian-maple-leaf"></i>
                                        <p>Employees Leaves</p>
                                    </a>
                                </li>
                            @endIf
                            @if(@$checkModulePermission->employees_leaves_details_view == '1')
                                <li class="nav-item ">
                                    <a class="nav-link {{ (request()->segment(1) == 'employees-leaves-details') ? 'active' : '' }}"
                                        href="{{action('EmployeesLeaveController@getAllEmployeesLeaves')}}">
                                        <i class="nav-icon fas fa-diagnoses"></i>
                                        <p>Employees Leaves Details</p>
                                    </a>
                                </li>
                            @endIf
                        </ul>
                    </li>
                 @endif
               @if(@$checkModulePermission->manager == 'mg')
                <li class="nav-item has-treeview @if(request()->segment(1)=='team-members' || request()->segment(1)=='skills-approved' || request()->segment(1)=='performance-feedback') menu-open
                       @endIf">
                    <a class="nav-link {{ (request()->segment(1) == 'team-members') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'skills-approved') ? 'active' : '' }}
                                       {{ (request()->segment(1) == 'performance-feedback') ? 'active' : '' }}"
                       href="#">
                        <i class="nav-icon fas fa-angle-down"></i>
                        <p>
                           Manager
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(@$checkModulePermission->team_member_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'team-members') ? 'active' : '' }}"
                                    href="{{action('TeamMemberController@index')}}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Team Member</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->approved_skills_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'skills-approved') ? 'active' : '' }}"
                                    href="{{action('SkillsApprovedController@index')}}">
                                    <i class="nav-icon fas fa-thumbs-up"></i>
                                    <p>Approved Skills</p>
                                </a>
                            </li>
                        @endIf
                        @if(@$checkModulePermission->performance_view == '1')
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->segment(1) == 'performance-feedback') ? 'active' : '' }}"
                                    href="{{action('PerformanceFeedbackController@index')}}">
                                    <i class="nav-icon fas fa-book-open"></i>
                                    <p>Performance Feedback</p>
                                </a>
                            </li>
                        @endIf
                    </ul>
                </li>
                @endif
                
                
                
                
                
                
         
            </ul>
        </nav>
    </div>
</aside>

