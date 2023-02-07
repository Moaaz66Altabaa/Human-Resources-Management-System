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
						<li><a href="{{ route('employee.holiday.index') }}"><i class="la la-flag-o"></i> <span>Holidays</span> </a>
						</li>


						<li>
							<a href="{{ route('employee.activite.index') }}"><i class="la la-bell"></i> <span>Activities</span></a>
						</li>

						<li><a href="{{ route('employee.report.index') }}"><i class="la la-pie-chart"></i> <span> Reports</span> </a></li>

						<li class="active" style="text-decoration: none">
							<a  href="{{ route('employee.company.index') }}"><i class="la la-building"></i> <span>Company Info</span> </a>
						</li>
@endsection
@section('content')

			<!-- Page Wrapper -->
            <div class="page-wrapper">

				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">

							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-12">
										<h3 class="page-title">Company Settings</h3>
									</div>
								</div>
							</div>
							<!-- /Page Header -->

							<form>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Company Name </label>
											<input class="form-control" type="text" readonly value="{{$company->name}}">
										</div>
									</div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input class="form-control" readonly value="{{$company->tel_number}}" type="number">
                                        </div>
                                    </div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Start of Work</label>
											<input class="form-control"readonly value="{{$company->start_time}} AM" type="text">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>End of Work</label>
											<input class="form-control" readonly value="{{$company->finish_time}} PM" type="text">
										</div>
									</div>
								</div>
                                <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea rows="6" class="form-control"readonly >{{$company->address}}  </textarea>
                                    </div>
                                </div>
                                </div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Description</label>
											<textarea rows="6" class="form-control"readonly >{{$company->description}}  </textarea>
										</div>
									</div>
								</div>

							</form>
						</div>
					</div>
                </div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
@endsection
