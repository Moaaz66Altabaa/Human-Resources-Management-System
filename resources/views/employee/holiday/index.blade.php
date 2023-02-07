@extends('employee_layout')
@section('nav-bar-item')
<li><a href="{{ route('employee.dashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard</span></a></li>
						<li class="submenu">
						
							<a href="#" class="noti-dot"><i class="la la-briefcase"></i> <span> Jobs</span> <span
									class="menu-arrow"></span></a>
							<ul style="display: none;">
								

								<li><a href="{{ route('employee.departments.index') }}">Departments</a></li>
								<li><a href="{{ route('employee.jobs.index') }}">Job</a></li>

							</ul>
							<a href="#" class="noti-dot"><i class="	la la-edit"></i> <span> leaves</span> <span
									class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="{{ route('employee.leaves.myleaves') }}">My Leaves  </a></li>
								
								<li><a href="{{ route('employee.leaves.index') }}">Leave Type</a></li>
								
							</ul>
							<a href="#" class="noti-dot"><i class="	la la-calendar-o"></i> <span> Attendances</span>
								<span class="menu-arrow"></span></a>
							<ul style="display: none;">
								
								<li><a href="{{ route('employee.attendance.my_attendance') }}">My Attendance </a></li>
								
								<li><a href="{{ route('employee.attendance.overtime') }}">Overtime</a></li>
							</ul>

						</li>
						
						<li><a href="{{ route('employee.salaries.index') }}"><i class="la la-money"></i> <span>Salary</span> </a>
						</li>
						<li class="active" style="text-decoration: none"><a href="{{ route('employee.holiday.index') }}"><i class="la la-flag-o"></i> <span>Holidays</span> </a>
						</li>


						<li>
							<a href="{{ route('employee.activite.index') }}"><i class="la la-bell"></i> <span>Activities</span></a>
						</li>
						
						<li><a href="{{ route('employee.report.index') }}"><i class="la la-pie-chart"></i> <span> Reports</span> </a></li>
					
						<li>
							<a href="{{ route('employee.company.index') }}"><i class="la la-building"></i> <span>Company Info</span> </a>
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
							<h3 class="page-title">Holidays</h3>
							
						</div>
						
					</div>
				</div>
				<!-- /Page Header -->

				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Title </th>
										<th>From Date</th>
										<th>To Date</th>
										<th> Number Day</th>
										
									</tr>
								</thead>
								@foreach($holidays as $holiday)
								<tbody>
									<tr>
										<td>{{$holiday-> id}}</td>
										<td>{{$holiday-> name}}</td>
										<td>{{$holiday-> from}}</td>
										<td>{{$holiday-> to}}</td>
										<td>{{$holiday-> days}}</td>
										
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

	</div>
	<!-- /Main Wrapper -->
@endsection
	