@extends('admin_layout')

@section('navbar_items')
    <li ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li ><a  href="{{ route('admin.employees.index') }}">All Employees</a></li>
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
    <li class="active">
        <a href="{{ route('admin.company.index') }}"><i class="la la-cog"></i> <span>Company Settings</span> </a>
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

							<form method="post" action="{{route('admin.company.update')}}">
                                @csrf
                                @method('PUT')

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Company Name </label>
											<input name="name" class="form-control" type="text" value="{{ $company->name }}" required>
                                            @error('name')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
										</div>
									</div>

                                    <div class="col-sm-6">
										<div class="form-group">
											<label>Tel Number</label>
											<input name="tel_number" class="form-control" type="number" value="{{ $company->tel_number }}" required>
                                            @error('tel_number')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Start Work Time</label>
											<input name="start_time" class="form-control" value="{{ $company->start_time }}" type="time" required>
                                            @error('start_time')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Finish Work Time</label>
                                            <input name="finish_time" class="form-control" value="{{ $company->finish_time }}" type="time" required>
                                            @error('finish_time')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Address</label>
											<textarea name="address" rows="6" class="form-control" required >{{ $company->address }}</textarea>
                                            @error('address')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
									</div>
								</div>
                                <div class="row">
									<div class="col-sm-12">
										<div class="form-group">
											<label>Descrption</label>
											<textarea name="description" rows="6" class="form-control" required >{{ $company->description }}</textarea>
                                            @error('description')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
									</div>
								</div>
								<div class="submit-section">
                                    <input type="submit" value="Save" class="btn btn-primary submit-btn">
								</div>
							</form>
						</div>
					</div>
                </div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->

@endsection
