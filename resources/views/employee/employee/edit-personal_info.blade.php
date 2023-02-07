
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

						<li>
							<a href="{{ route('employee.company.index') }}"><i class="la la-building"></i> <span>Company Info</span> </a>
						</li>
@endsection
	@section('content')
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				<div class="content container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">

							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-4">
										<h3 class="page-title"> Edit Personal_info </h3>
									</div>
								</div>
							</div>


                            <form method="post" action="{{route('employee.employee.update_info' )}}" >
        						@csrf
        						@method('PUT')

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="nationality">Nationality <span class="text-danger"></span></label>
											<input class="form-control" name="nationality" type="text"  style=" @error('nationality') border: red solid 2px @enderror" value="{{$employee->nationality}}" required>
											@error('nationality')
       										 <p style="color: red"> {{ $message }} </p>
        										<br>
       										 @enderror
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="hometown">Hometown <span class="text-danger"></span></label>
											<input class="form-control" name="hometown" type="text" style=" @error('hometown') border: red solid 2px @enderror" value="{{$employee->hometown}}" required>
											@error('hometown')
       										 <p style="color: red"> {{ $message }} </p>
        										<br>
       										 @enderror
										</div>
									</div>
									</div>
									<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="marital_status">Marital status <span class="text-danger"></span></label>
											<select name="marital_status" class="select form-control">
												<option value=" ">marital status</option>
												<option {{ $employee->marital_status == 'single'? 'selected' : '' }} value="single">Single</option>
												<option {{ $employee->marital_status != 'single'? 'selected' : '' }} value="married">Married</option>
											</select>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label for="number_of_children">No. of children </label>
											<input name="number_of_children" class="form-control" type="text"style=" @error('number_of_children') border: red solid 2px @enderror" value="{{$employee->number_of_children}}" required>
											@error('number_of_children')
       										 <p style="color: red"> {{ $message }} </p>
        										<br>
       										 @enderror
										</div>
									</div>
								</div>
								<div class="submit-section">
                                    <input type="submit" class="btn btn-primary submit-btn">
                                </div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
		@endsection
