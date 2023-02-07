@extends('admin_layout')

@section('navbar_items')
    <li class="active" ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span >Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a  href="{{ route('admin.employees.index') }}">All Employees</a></li>
            <li><a href="{{ route('admin.departments.index') }}">Departments</a></li>
            <li><a href="{{ route('admin.jobs.index') }}">Jobs</a></li>

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
            <li><a href="{{ route('admin.attendance.index') }}"> Employees Attendance </a></li>
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
        <a class="active" href="{{ route('admin.company.index') }}"><i class="la la-cog"></i> <span>Company Settings</span> </a>
    </li>
@endsection

@section('content')

		<!-- Page Wrapper -->
		<div class="page-wrapper">

			<!-- Page Content -->
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Welcome {{auth()->user()->first_name}}!</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item active">My Dashboard</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<div class="row">
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
						<div class="card dash-widget">
							<div class="card-body">
								<span class="dash-widget-icon"><i class="fa fa-sitemap"></i></span>
								<div class="dash-widget-info">
									<h3>{{$departments->count()}}</h3>
									<span>Departments</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
						<div class="card dash-widget">
							<div class="card-body">
								<span class="dash-widget-icon"><i class="fa fa-briefcase"></i></span>
								<div class="dash-widget-info">
									<h3>{{$jobs->count()}}</h3>
									<span>Jobs</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
						<div class="card dash-widget">
							<div class="card-body">
								<span class="dash-widget-icon"><i class="la la-flag-o"></i></span>
								<div class="dash-widget-info">
									<h3>{{$holidays->count()}}</h3>
									<span>Holidays</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
						<div class="card dash-widget">
							<div  class="card-body">
								<span class="dash-widget-icon"><i  class="fa fa-user"></i></span>
								<div class="dash-widget-info">
									<h3>{{$employees->count()}}</h3>
									<span>Employees</span>
								</div>

							</div>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="card punch-status">
							<div class="card-body">
								<h5 class="card-title">Timesheet </h5>
								<div class="punch-det">
									<h6>{{ $my_attendance->check_out == null? 'Checked In at' : 'Checked Out at' }}</h6>
									<p>{{ $my_attendance->check_out == null? $my_attendance->check_in : $my_attendance->check_out }}</p>
								</div>

								<div class="punch-info">
									<div class="punch-hours">
                                        @if($my_attendance->check_in != null)
										<span> {{ $current_hours }} hrs </span>
                                        @else
                                            <span> 0 hrs </span>
                                        @endif
									</div>
								</div>
								<div class="punch-btn-section">

                                @if($my_attendance->check_in == null || $my_attendance->check_out == null)
                                    <form method="post" action="{{route('admin.check_in')}}" >
                                        @csrf
                                        @method('PUT')
                                        <input type="submit" class="btn btn-primary punch-btn" value={{ $my_attendance->check_in != null ? 'CheckOut' : 'CheckIn' }}>
                                    </form>
                                @endif
								</div>

							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card att-statistics">
							<div class="card-body">
								<h5 class="card-title">This Month </h5>
								<div class="stats-list">

									<div class="stats-info">
										<p>Attendances <strong>{{auth()->user()->hours_per_month}} <small>/ 208 hrs</small></strong></p>
										<div class="progress">
											<div class="progress-bar bg-success" role="progressbar" style="{{'width:'.auth()->user()->hours_per_month*100/208 .'%'}}"
												aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>

									<div class="stats-info">
											<p>Overtime <strong>{{ $overtime_hours }}</strong></p>
										<div class="progress">
											<div class="progress-bar bg-warning" role="progressbar" style="{{'width:'.$overtime_hours*100/10 .'%'}}"
												aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
									<div class="stats-info">
										<p>Leaves <strong> {{ $total_leave_days }} <small>/ {{ $max_leave_days }} </small></strong></p>
										<div class="progress">
											<div class="progress-bar bg-danger" role="progressbar" style="{{'width:'.$total_leave_days*100/($max_leave_days == 0 ? 3 : $max_leave_days) .'%'}}"
												aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>


								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4  ">
						<div class="card flex-fill dash-statistics">
							<div class="card-body">
								<h5 class="card-title">Statistics</h5>
								<div class="stats-list">
									<div class="stats-info">
										<p>Vacation leavers <strong>{{ $vacation_leavers->count() }} <small>/ {{ $employees->count() }}</small></strong></p>
										<div class="progress">
											<div class="progress-bar bg-primary" role="progressbar" style="{{'width:'.$vacation_leavers->count()*100/$employees->count() .'%'}}"
												aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
									<div class="stats-info">
										<p>Employees Presence <strong>{{ $present_employees->count() }} <small>/ {{ $employees->count() }}</small></strong></p>
										<div class="progress">
											<div class="progress-bar bg-warning" role="progressbar" style="{{'width:'.$present_employees->count()*100/$employees->count() .'%'}}"
												aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
									<div class="stats-info">
										<p>Employees Absence <strong>{{ $absent_employees->count() }} <small>/ {{ $employees->count() }}</small></strong></p>
										<div class="progress">
											<div class="progress-bar bg-success" role="progressbar" style="{{'width:'.$absent_employees->count()*100/$employees->count() .'%'}}"
												aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

				</div>


			</div>
		</div>

		<!-- /Page Content -->

	</div>
	<!-- /Page Wrapper -->

@endsection
