
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
            <li><a  href="{{ route('admin.salaries.index') }}"> Employee Salary </a></li>
            <li><a class="active" style="text-decoration: none" href="{{ route('admin.salaries.my_salary') }}"> My  Salary </a></li>

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

					<!-- /Page Header -->

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="payslip-title">Payslip for the month of {{ now()->monthName }} {{ now()->year }}</h4>
									<div class="row">

										<div class="col-sm-6 m-b-20">
											<div class="invoice-details">
												<h3 class="text-uppercase">Payslip #1</h3>
												<ul class="list-unstyled">
													<li>Salary Month: <span>{{ now()->monthName }} , {{ now()->year }}</span></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 m-b-20">
											<ul class="list-unstyled">
												<li><h5 class="mb-0"><strong> {{ $employee->first_name }} {{ $employee->last_name }} </strong></h5></li>
												<li><span>{{ $employee->job->name }}</span></li>
												<li>Employee ID : {{$employee->is_admin? 'A' : 'E'}} - {{$employee->id}}</li>
												<!-- <li>Joining Date: 1 Jan 2013</li> -->
											</ul>
										</div>
									</div>
                            @if($employee->salary != null)
									<div class="row">
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Earnings</strong></h4>
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td><strong>Hour Price</strong> <span class="">({{$employee->hours_per_month}} hrs )</span> <span class="float-right">{{$employee->salary->net}} s.p</span></td>
														</tr>
														<tr>
															<td><strong>House Rent Allowance (H.R.A.)</strong> <span class="float-right">{{$employee->salary->hra}} s.p</span></td>
														</tr>
														<tr>
															<td><strong>Conveyance</strong> <span class="float-right">{{$employee->salary->conveyance}} s.p</span></td>
														</tr>
														<tr>
															<td><strong>living allowance</strong> <span class="float-right">{{$employee->salary->la}} s.p</span></td>
														</tr>
														<tr>
															<td><strong>Food allowance</strong> <span class="float-right">{{$employee->salary->fa}} s.p</span></td>
														</tr>

														<tr>
															<td><strong>Total Earnings</strong> <span class="float-right"><strong>{{ ($employee->salary->total - $employee->salary->net*30) + $employee->salary->net*$employee->hours_per_month}} s.p</strong></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-sm-6">
											<div>
                                                @if(!$employee->leaves()->where('is_paid' , 1)->get()->isEmpty())
												<h4 class="m-b-10"><strong> Paid Leaves</strong></h4>
												<table class="table table-bordered">
													<tbody>
                                                    @foreach($employee->leaves()->where('is_paid' , 1)->get() as $leave)
														<tr>
															<td><strong>{{ $leave->name }} </strong> <span class="float-right">({{ $leave->pivot->days }} Days )</span> </td>
														</tr>
                                                    @endforeach
													</tbody>
												</table>
                                                @endif

                                                @if(!$employee->leaves()->where('is_paid' , 0)->get()->isEmpty())
                                                <h4 class="m-b-10"><strong>Un Paid Leaves</strong></h4>
												<table class="table table-bordered">
													<tbody>

                                                    @foreach($employee->leaves()->where('is_paid' , 0)->get() as $leave)
                                                        <tr>
                                                            <td><strong>{{ $leave->name }}  </strong> <span class="float-right">({{ $leave->pivot->days }} Days )</span></td>
                                                        </tr>
                                                    @endforeach
													</tbody>
												</table>
                                                @endif
											</div>
										</div>

                                        @if(!$employee->overtimes()->get()->isEmpty())
                                        <div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Overtime</strong></h4>
												<table class="table table-bordered">
													<tbody>
                                                    @foreach($employee->overtimes()->get() as $overtime)
                                                        <tr>
                                                            <td><strong>Overtime Date : {{ $overtime->created_at->format('y-m-d') }} </strong><span class="float-right"> ({{ $overtime->hours }} hrs )</span>  </td>
                                                        </tr>
                                                    @endforeach
													</tbody>
												</table>
											</div>
										</div>
                                        @endif
										<div class="col-sm-12">
											<p><strong>Total Salary: {{ ($employee->salary->total - $employee->salary->net*30) + ($employee->salary->net*$employee->hours_per_month )+ ($employee->salary->overtime*$employee->overtime_hours) }} s.p</strong> </p>
										</div>
									</div>
								</div>
                                @endif
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

	<!-- jQuery -->

@endsection
