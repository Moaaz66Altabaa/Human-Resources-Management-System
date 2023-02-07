@extends('admin_layout')

@section('navbar_items')
    <li ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li ><a href="{{ route('admin.employees.index') }}">All Employees</a></li>
            <li><a  href="{{ route('admin.departments.index') }}">Departments</a></li>
            <li><a  href="{{ route('admin.jobs.index') }}">Jobs</a></li>

        </ul>
    </li>
    <li class="submenu"><a href="#" class="noti-dot"><i class="	la la-edit"></i> <span> leaves</span> <span
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
            <li><a href="{{ route('admin.salaries.index') }}"> My Overtime </a></li>
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
        <a href="{{ route('admin.company.index') }}"><i class="la la-cog"></i> <span>Company Settings</span> </a>
    </li>
@endsection

@section('content')


    <!-- Page Wrapper -->
		<div class="page-wrapper">

			<!-- Page Content -->
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title"> Reports </h3>

						</div>

					</div>
				</div>
				<!-- /Page Header -->
				<div class="row filter-row">

					<div class="col-sm-6 col-md-3">
                        <form id="search-report-form" action="{{ route('admin.reports.search') }}" method="post">
                            @csrf
						<div class="form-group form-focus select-focus">
							<select name="title" class="select floating">
								<option value="">---Select---</option>
								<option value="Salary Report">Salary Report</option>
								<option value="Leave Report">Leave Report</option>
								<option value="Overtime Report">Overtime Report</option>
								<option value="System Report">System Report</option>
								<option value="Employees Report">Employees Report</option>
								<option value="Department Report">Department Report</option>
								<option value="Others">Others</option>
							</select>
							<label class="focus-label">Report Type</label>
						</div>
                        </form>
					</div>
					<div class="col-sm-6 col-md-3">
                        <a href="{{ route('admin.reports.search') }}" class="btn btn-success btn-block" onclick="event.preventDefault();
                             document.getElementById('search-report-form').submit();"> Search </a>					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table mb-0 datatable">
								<thead>
									<tr>
										<th>Employee</th>
										<th>Reports Type</th>
										<th>Date</th>

										<th class="d-none d-sm-table-cell">Description</th>

									</tr>
								</thead>
                                @if(Session::has('search'))
                                @foreach(Session::get('search') as $report)
								<tbody>
									<tr>
										<td>

											<h2 class="table-avatar">
												<a href="{{ route('admin.profile.index' , $report->user_id) }}" class="avatar"><img alt=""
														src="{{ asset('images/' . $report->user->image_path) }}"></a>
												<a href="{{ route('admin.profile.index' , $report->user_id) }}">{{ $report->user->first_name . ' ' . $report->user->last_name }} <span>{{ $report->user->job->name }}</span></a>
											</h2>
										</td>
										<td> {{ $report->title }}</td>
										<td>{{ $report->created_at->format('y-m-d') }}</td>
										<td class="d-none d-sm-table-cell col-md-4">{{ $report->body }}</td>

									</tr>

								</tbody>
                                @endforeach

                                @else

                                @foreach($reports as $report)
								<tbody>
									<tr>
										<td>

											<h2 class="table-avatar">
												<a href="{{ route('admin.profile.index' , $report->user_id) }}" class="avatar"><img alt=""
														src="{{ asset('images/' . $report->user->image_path) }}"></a>
												<a href="{{ route('admin.profile.index' , $report->user_id) }}">{{ $report->user->first_name . ' ' . $report->user->last_name }} <span>{{ $report->user->job->name }}</span></a>
											</h2>
										</td>
										<td> {{ $report->title }}</td>
										<td>{{ $report->created_at->format('y-m-d') }}</td>
										<td class="d-none d-sm-table-cell col-md-4">{{ $report->body }}</td>

									</tr>

								</tbody>
                                @endforeach
                                @endif
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Content -->



			<!-- /Page Wrapper -->



		<!-- jQuery -->

@endsection
