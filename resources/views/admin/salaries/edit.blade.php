


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
            <li><a class="active" style="text-decoration: none" href="{{ route('admin.salaries.index') }}"> Employee Salary </a></li>
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
						<div class="col-md-8 offset-md-2">

							<!-- Page Header -->
							<div class="page-header">
								<div class="row">
									<div class="col-sm-4">
										<h3 class="page-title">Edit Salary </h3>
									</div>
								</div>
							</div>
                            <form method="post" action="{{ route('admin.salaries.update' , $salary->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hour Price</label>
                                            <input name="net" class="form-control" type="number" value="{{ $salary->net }}" required>
                                            @error('net')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Conveyance</label>
                                            <input name="conveyance" class="form-control" type="number" value="{{ $salary->conveyance }}" required>
                                            @error('conveyance')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>HRA	</label>
                                            <input name="hra" class="form-control" type="number" value="{{ $salary->hra }}" required>
                                            @error('hra')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>living allowance</label>
                                            <input name="la" class="form-control" type="number" value="{{ $salary->la }}" required>
                                            @error('la')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Food allowance</label>
                                            <input name="fa" class="form-control" type="number" value="{{ $salary->fa }}" required>
                                            @error('fa')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Overtime Hour</label>
                                            <input name="overtime" class="form-control" type="number" value="{{ $salary->overtime }}" required>
                                            @error('overtime')
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
			</div>
			<!-- /Add Employee Modal -->
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

@endsection
