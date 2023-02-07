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
            <li><a href="{{ route('admin.leaves.leave_type') }}">Leave Type</a></li>
            <li><a class="active" style="text-decoration: none" href="{{ route('admin.leaves.leave_settings') }}">Leave Settings</a></li>
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
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Leave Settings</h3>

						</div>
					</div>
				</div>
				<!-- /Page Header -->



				<div class="row">
					<div class="col-md-12">


						<!-- Medical Leave -->
                @foreach($leaves as $leave)
                    <form method="post" action="{{route('admin.leaves.updateLeaveSettings' , $leave->id)}}" >
                        @csrf
                        @method('PUT')

						<div class="card leave-box" id="leave_sick">
							<div class="card-body">
								<div class="h3 card-title with-switch">
                                    {{ $leave->name }}

								</div>


								<div class="leave-item">
									<div class="leave-row">
										<div class="leave-left">
											<div class="input-box">

												<div class="form-group">
													<label>Max Days Per Month</label>
													<input  type="number" class="form-control" name="max_per_month" value="{{ $leave->max_per_month }}" required disabled>
                                                    @error('max_per_month')
                                                    <p style="color: red"> {{ $message }} </p>
                                                    <br>
                                                    @enderror
												</div>
											</div>
                                            <div class="leave-right">
                                                <button class="leave-edit-btn">
                                                    Edit
                                                </button>
                                            </div>
                                            <div class="input-box">
                                                <label class="d-block">Status</label>
                                                <div class="leave-inline-form">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" {{ $leave->is_paid ? '' : 'checked' }}
                                                               name="is_paid" id="earned_no" value="{{ 0 }}" required
                                                               disabled>
                                                        <label class="form-check-label" for="earned_no">UnPaid</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" {{ $leave->is_paid ? 'checked' : '' }}
                                                               name="is_paid" id="earned_yes" value="{{ 1 }}" required
                                                               disabled>
                                                        <label class="form-check-label" for="earned_yes">Paid</label>
                                                    </div>
										</div>
                                                @error('is_paid')
                                                <p style="color: red"> {{ $message }} </p>
                                                <br>
                                                @enderror
									</div>
								</div>
                            </form>

								<!-- Medical Earned Leave -->
								<div class="leave-row">
									<div class="leave-left">

											</div>
										</div>
									</div>

								</div>

								<!-- /Earned Leave -->
							</div>
						</div>
                    @endforeach
						<!-- /Medical Leave -->


					</div>
				</div>

			</div>

		</div>

	</div>

	<!-- /Main Wrapper -->

@endsection
