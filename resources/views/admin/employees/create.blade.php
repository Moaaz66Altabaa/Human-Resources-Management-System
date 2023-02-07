@extends('admin_layout')

@section('navbar_items')
    <li ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li ><a class="active" style="text-decoration: none" href="{{ route('admin.employees.index') }}">All Employees</a></li>
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
            <li><a href="{{ route('admin.attendance.index') }}l"> Employees Attendance </a></li>
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
				<div class="content container-fluid">
					<div class="row">
						<div class="col-md-8 offset-md-2">

							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-4">
										<h3 class="page-title">Add Employee</h3>
									</div>
								</div>
							</div>


				<!-- Add Employee Modal -->
				<!-- <div id="add_employee" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Employee</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body"> -->
							<form method="post" action="{{route('admin.employees.store')}}">
                                @csrf
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label">First Name <span
													class="text-danger"></span></label>
                                            <input name="first_name" class="form-control" type="text" value="{{ old('first_name') }}" required>
                                            @error('first_name')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label">Last Name</label>
                                            <input name="last_name" class="form-control" type="text" value="{{ old('last_name') }}" required>
                                            @error('last_name')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label">Email <span
													class="text-danger"></span></label>
                                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                                            @error('email')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label">Password</label>
                                            <input class="form-control" type="password" name="password" required>
                                            @error('password')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label">Confirm Password</label>
                                            <input class="form-control" type="password" name="password_confirmation" required>
                                            @error('password_confirmation')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label">Phone </label>
                                            <input class="form-control" name="mobile_number" type="number" required>
                                            @error('mobile_number')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Designation <span class="text-danger"></span></label>
                                            <select name="job_id" class="select">
                                                <option>Select Job</option>
                                                @foreach($jobs as $job)
                                                    <option value="{{ $job->id }}">{{ $job->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('job_id')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label class="col-form-label">Role</label>
                                            <select name="is_admin" class="select">
                                                <option value="" selected >Choose Role</option>
                                                <option value="{{ 1 }}">Admin</option>
                                                <option value="{{ 0 }}">Employee</option>
                                            </select>
                                            @error('is_admin')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
										</div>
									</div>
								</div>

								<div class="submit-section">
                                    <input type="submit" value="Add" class="btn btn-primary submit-btn">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Add Employee Modal -->
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

@endsection
