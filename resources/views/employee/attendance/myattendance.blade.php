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
						</li>
						<li class="submenu">
							<a href="#" class="noti-dot"><i class="	la la-edit"></i> <span> leaves</span> <span
									class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="{{ route('employee.leaves.myleaves') }}">My Leaves  </a></li>
								
								<li><a href="{{ route('employee.leaves.index') }}">Leave Type</a></li>
								
							</ul>
						</li>
						<li class="submenu">
							<a href="#" class="noti-dot"><i class="	la la-calendar-o"></i> <span> Attendances</span>
								<span class="menu-arrow"></span></a>
							<ul style="display: none;">
								
								<li><a class="active" style="text-decoration: none" href="{{ route('employee.attendance.my_attendance') }}">My Attendance </a></li>
								
								<li><a href="{{ route('employee.attendance.overtime') }}">Overtime</a></li>
							</ul>

						</li>
						
						<li><a href="{{ route('employee.salaries.index') }}"><i class="la la-money"></i> <span>Salary</span> </a>
						</li>
						<li><a href="{{ route('employee.holiday.index') }}"><i class="la la-flag-o"></i> <span>Holidays</span> </a>
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
							<h3 class="page-title">Attendance</h3>

						</div>
						
					</div>
				</div>
				<!-- /Page Header -->

				<!-- Search Filter -->
				<div class="row filter-row">
					
					<div class="col-sm-3">
						<div class="form-group form-focus select-focus">
						<form id='search_attendance_form' method="post" action="{{route('employee.attendance.search')}}" >
       						 @csrf
							<select name="month" class="select floating">
								<option value="">-</option>
								<option value="1">Jan</option>
								<option value="2">Feb</option>
								<option value="3">Mar</option>
								<option value="4">Apr</option>
								<option value="5">May</option>
								<option value="6">Jun</option>
								<option value="7">Jul</option>
								<option value="8">Aug</option>
								<option value="9">Sep</option>
								<option value="10">Oct</option>
								<option value="11">Nov</option>
								<option value="12">Dec</option>
							</select>
							<label class="focus-label">Select Month</label>
                        </form>
						</div>
					</div>
				
					<div class="col-sm-3">
						<a href="{{route('employee.attendance.search')}}" class="btn btn-success btn-block"
						onclick="event.preventDefault();
						document.getElementById('search_attendance_form').submit();"> Search </a>
					</div>
				</div>
				<!-- /Search Filter -->

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
								@if(Session::has('search'))
								@foreach( Session::get('search') as $attendance)
								<tbody>
									<tr>
										<td>{{$attendance->id}}</td>
										<td>{{$attendance->created_at->format('y-m-d')}}</td>
										<td>{{$attendance->check_in}} </td>
										<td>{{$attendance->check_out}} </td>
										
										
										<td>{{$attendance->overtime}}</td>
										<td class="text-center">
											<div class="action-label">
												<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
													<i class="fa fa-dot-circle-o text-purple"></i> {{$attendance->status}}
												</a>
											</div>
										</td>
									</tr>
									
								</tbody>
								@endforeach
								@else
								@foreach($attendances as $attendance)
								<tbody>
									<tr>
										<td>{{$attendance->id}}</td>
										<td>{{$attendance->created_at->format('y-m-d')}}</td>
										<td>{{$attendance->check_in}} </td>
										<td>{{$attendance->check_out}} </td>
										
										
										<td>{{$attendance->overtime}}</td>
										<td class="text-center">
											<div class="action-label">
												<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
													<i class="fa fa-dot-circle-o text-purple"></i> {{$attendance->status}}
												</a>
											</div>
										</td>
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

			

		</div>
		<!-- /Page Wrapper -->


	  <!-- /Main Wrapper -->
@endsection	
	