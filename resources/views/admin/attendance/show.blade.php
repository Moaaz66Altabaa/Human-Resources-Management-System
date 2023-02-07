@extends('admin_layout')

@section('navbar_items')
    <li ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li ><a  href="{{ route('admin.employees.index') }}">All Employees</a></li>
            <li><a  href="{{ route('admin.departments.index') }}">Departments</a></li>
            <li><a style="text-decoration: none" href="{{ route('admin.jobs.index') }}">Jobs</a></li>

        </ul>
    </li>
    <li class="submenu"><a href="#" class="noti-dot"><i class="	la la-edit"></i> <span> Leaves</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a href="{{ route('admin.leaves.index') }}"> Employees Leaves </a></li>
            <li><a href="{{ route('admin.leaves.my_leaves') }}">My Leaves </a></li>
            <li><a href="{{ route('admin.leaves.leave_type') }}">Leave Type</a></li>
            <li><a href="{{ route('admin.leaves.leave_settings') }}">Leave Settings</a></li>
        </ul>
    </li>
    <li class="submenu" >
        <a href="#" class="noti-dot"><i class="	la la-calendar-o"></i> <span> Attendance</span>
            <span class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a class="active" style="text-decoration: none" href="{{ route('admin.attendance.index') }}"> Employees Attendance </a></li>
            <li><a href="{{ route('admin.attendance.my_attendance') }}"> My Attendance </a></li>
            <li><a href="{{ route('admin.overtime.index') }}"> Employees Overtime </a></li>
            <li><a href="{{ route('admin.overtime.my_overtime') }}"> My Overtime </a></li>
            <!-- <li><a href="overtime2.html">Overtime (Employee)</a></li> -->
        </ul>

    </li>
    <li class="submenu">
        <a href="#"><i class="la la-money"></i> <span> Payroll </span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a href="{{ route('admin.salaries.index') }}"> Employee Salary </a></li>
            <li><a href="{{ route('admin.salaries.my_salary') }}"> My  Salary </a></li>

        </ul>
    </li>
    <li><a href="{{ route('admin.holiday.index') }}"><i class="la la-flag-o"></i> <span>Holidays</span> </a>
    </li>


    <li>
        <a href="{{ route('admin.activities.index') }}"><i class="la la-bell"></i> <span>Activities</span></a>
    </li>
    <li class="submenu">
        <a href="#"><i class="la la-pie-chart"></i> <span> Reports </span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a href="{{ route('admin.reports.index') }}"> Employee Reports</a></li>
            <li><a href="{{ route('admin.reports.my_reports') }}"> My Reports </a></li>

        </ul>
    </li>
    <li>
        <a  href="{{ route('admin.company.index') }}"><i class="la la-cog"></i> <span>Company Settings</span> </a>
    </li>
@endsection

@section('content')

        <!-- Page Wrapper -->
        <div class="page-wrapper">

            <!-- Page Content -->
            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcome-box" >
                        <div class="row">
                            <div class="welcome-det">
                                <h3 class="table-avatar">
                                    <a class="welcome-img img" href="{{ route('admin.profile.index' , $employee->id) }}"><img alt="" style="width: 60px; border-radius: 8px"
                                            src="{{ asset('images/' . $employee->image_path) }}"></a>
                                </h3>
                            </div>
                            <h3>
                                <a >{{ $employee->first_name . ' ' . $employee->last_name }}</a>
                                <div class="col-md-12">
                                    <h5 class="text-muted">{{ $employee->job->name }}</h5>
                                </div>
                            </h3>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->


                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date </th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Overtime</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                @foreach($attendances as $attendance)
                                    <tbody >
                                    <tr @if($attendance->id == $attendance_id) style="background-color: #9dd3fc" @endif }}>
                                        <td>{{ $attendance->id }}</td>
                                        <td>{{ $attendance->created_at->format('y-m-d') }}</td>
                                        <td>{{ $attendance->check_in}}</td>
                                        <td>{{ $attendance->check_out}}</td>
                                        <td>{{ $attendance->overtime}}</td>
                                        <td class="text-center">
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                    @if($attendance->status == 'present')
                                                        <i class="fa fa-dot-circle-o text-purple"></i> Present
                                                    @elseif($attendance->status == 'on_vacation')
                                                        <i class="fa fa-leaf text-success"></i> On vacation
                                                    @else
                                                        <i class="fa fa-dot-circle-o text-danger"></i> Absent
                                                    @endif
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Content -->



        </div>
        <!-- /Page Wrapper -->


@endsection
