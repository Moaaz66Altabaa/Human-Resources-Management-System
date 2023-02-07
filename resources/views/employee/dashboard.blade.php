@extends('employee_layout')
@section('nav-bar-item')
<li class="active" style="text-decoration: none"><a href="{{ route('employee.dashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard</span></a></li>
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
					<div class="row">
						<div class="col-md-12">
							<div class="welcome-box">
								<div class="welcome-img">
									<img alt="" src="{{ asset('images/'.auth()->user()->image_path) }}">
								</div>
								<div class="welcome-det">
									<h3>{{$employee->first_name}}</h3>
									<p>{{$employee->job->name}}</p>
								</div>
							</div>
						</div>
					</div>

					<!-- check -->

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
                                    <form method="post" action="{{route('employee.check_in')}}" >
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
									<h5 class="card-title">This Month</h5>
									<div class="stats-list">

										<div class="stats-info">
											<p>Attendances <strong>{{$employee->hours_per_month}}/208 hrs <small></small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-success" role="progressbar" style="{{'width:' . $employee->hours_per_month*100/208 .'%'}}"
													aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>

										<div class="stats-info">
												<p>Overtime <strong>{{$employee->overtime_hours}}/10</strong></p>
											<div class="progress">
												<div class="progress-bar bg-warning" role="progressbar" style="{{'width:' . $employee->overtime_hours*100/10 .'%'}}"
													aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>Leaves <strong>{{$leave}}/ {{$leave_day}}<small> </small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-danger" role="progressbar" style="{{'width:' . $leave*100/($leave_day == 0 ? 3 : $leave_day) .'%'}}"
													aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>


									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card recent-activity">
								<div class="card-body">
									<h5 class="card-title">Today Activity</h5>
								@foreach($employee->notifications as $notification)
									<ul class="activity-list">
										<li>
											<div class="activity-user">
												<a href="profile.html" title="{{ $notification->data['employee_name'] }}" data-toggle="tooltip"
													class="avatar">
													<img src="{{ asset('images/' . $employee->image_path)}}" alt="">
												</a>
											</div>
											<div class="activity-content">
												<div class="timeline-content">
													<a href="profile.html" class="name">{{ $notification->data['employee_name'] }} </a> {{ $notification->data['description'] }}
													<span class="time">{{ $notification->created_at }}</span>
												</div>
											</div>
										</li>

									</ul>
                                @endforeach
								</div>
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
