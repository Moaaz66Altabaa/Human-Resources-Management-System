@extends('admin_layout')

@section('navbar_items')
    <li ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li ><a  href="{{ route('admin.employees.index') }}">All Employees</a></li>
            <li><a  href="{{ route('admin.departments.index') }}">Departments</a></li>
            <li><a  style="text-decoration: none" href="{{ route('admin.jobs.index') }}">Jobs</a></li>

        </ul>
    </li>
    <li class="submenu"><a href="#" class="noti-dot"><i class="	la la-edit"></i> <span> Leaves</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a  href="{{ route('admin.leaves.index') }}"> Employees Leaves </a></li>
            <li><a href="{{ route('admin.leaves.my_leaves') }}">My Leaves </a></li>
            <li><a class="active" style="text-decoration: none" href="{{ route('admin.leaves.leave_type') }}">Leave Type</a></li>
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
            <li><a href="{{ route('admin.overtime.my_overtime') }}l"> My Overtime </a></li>
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
				<div class="content container-fluid">
					<div class="row">
						<div class="col-md-6 offset-md-2">

							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-4">
										<h3 class="page-title">Add Leave</h3>
									</div>
								</div>
							</div>


                            <form method="post" action="{{route('admin.leaves.my_leaves_storeleave')}}">
                                @csrf

                                <input name="user_id" type="hidden" value="{{ auth()->user()->id }}">

                                @if(Session::has('add_leave_error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('add_leave_error') }}
                                        @php
                                            Session::forget('add_leave_error');
                                        @endphp
                                    </div>
                                @endif

                                @if(Session::has('invalid_date_error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('invalid_date_error') }}
                                        @php
                                            Session::forget('invalid_date_error');
                                        @endphp
                                    </div>
                                @endif

								<div class="form-group">
									<label>Leave Type <span class="text-danger"></span></label>
                                    <select class="select" name="leave_id" required >
                                        <option>Select Leave Type</option>
                                        @foreach($leaves as $leave)
                                            <option  value="{{ $leave->id }}">{{ $leave->name }} </option>
                                        @endforeach
                                    </select>
                                    @error('leave_id')
                                    <p style="color: red"> {{ $message }} </p>
                                    <br>
                                    @enderror
								</div>
								<div class="form-group">
									<label>From <span class="text-danger"></span></label>
                                    <div >
                                        <input class="form-control" type="date" name="from" value="{{ old('from') }}" required>
                                    </div>
                                    @error('from')
                                    <p style="color: red"> {{ $message }} </p>
                                    <br>
                                    @enderror
								</div>
								<div class="form-group">
									<label>To <span class="text-danger"></span></label>
                                    <div >
                                        <input class="form-control" type="date" name="to"
                                               value="{{ old('to') }}" required>
                                    </div>
                                    @error('to')
                                    <p style="color: red"> {{ $message }} </p>
                                    <br>
                                    @enderror
								</div>

								<div class="form-group">
									<label>Leave Reason <span class="text-danger"></span></label>
                                    <textarea rows="4" class="form-control" name="reason" value="{{ old('reason') }}" required></textarea>
                                    @error('reason')
                                    <p style="color: red"> {{ $message }} </p>
                                    <br>
                                    @enderror								</div>
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
