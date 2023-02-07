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

				<!-- Page Content -->
                <div class="content container-fluid">

					<!-- Page Header -->

					<!-- /Page Header -->

					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h4 class="payslip-title">Payslip for the month {{ now()->monthName}}</h4>
									<div class="row">

										<div class="col-sm-6 m-b-20">
											<div class="invoice-details">
												<h3 class="text-uppercase">Payslip #1</h3>
												<ul class="list-unstyled">
													<li>Salary Month: <span>{{$date->format('m')}} , 20{{$date->format('y')}}</span></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 m-b-20">
											<ul class="list-unstyled">
												<li><h5 class="mb-0"><strong>{{$employee->first_name . ' ' . $employee->last_name}}</strong></h5></li>
												<li><span>Job : {{$employee->job->name}}</span></li>
												<li>Employee ID : {{ $employee->is_admin? 'A' : 'E' }}-{{$employee->id}}</li>
												<li>Join Date: {{ $employee->created_at->format('y-m-d')}}</li>
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
															<td><strong>Basic Salary ({{ $employee->hours_per_month }} hrs )</strong> <span class="float-right">{{ $employee->salary->net }} s.p</span></td>
														</tr>
														<tr>
															<td><strong>House Rent Allowance (H.R.A.)</strong> <span class="float-right">{{ $employee->salary->hra }} s.p</span></td>
														</tr>
														<tr>
															<td><strong>Conveyance</strong> <span class="float-right">{{ $employee->salary->conveyance }} s.p</span></td>
														</tr>
														<tr>
															<td><strong>living allowance</strong> <span class="float-right">{{ $employee->salary->la}} s.p</span></td>
														</tr>
														<tr>
															<td><strong>Food allowance</strong> <span class="float-right">{{ $employee->salary->fa  }} s.p</span></td>
														</tr>

														<tr>
															<td><strong>Total Earnings</strong> <span class="float-right"><strong>{{ ($employee->total - $employee->net*30) + $employee->net*$employee->hours_per_month }} s.p</strong></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>

										@if(!$leaves->where('is_paid' , 1)->get()->isEmpty())
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Paid Leaves</strong></h4>
												<table class="table table-bordered">

												<tbody>
														@foreach($leaves->where('is_paid' , 1)->get() as $leave)
														<tr>
															<td><strong>{{$leave->name}}  ( {{$leave->pivot->days}} Days )</strong> <span class="float-right"></span></td>
														</tr>

													</tbody>
														@endforeach
												</table>
											</div>
										</div>
										@endif

										@if(!$leaves->where('is_paid' , 0)->get()->isEmpty())
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>UnPaid Leaves</strong></h4>
												<table class="table table-bordered">

												<tbody>
														@foreach($leaves->where('is_paid' , 0)->get() as $leave)
														<tr>
															<td><strong>{{$leave->name}}  ( {{$leave->pivot->days}} Days )</strong> <span class="float-right"></span></td>
														</tr>

													</tbody>
														@endforeach
												</table>
											</div>
										</div>
										@endif
										<div class="col-sm-6">
											<div>
												<h4 class="m-b-10"><strong>Overtime</strong></h4>
												<table class="table table-bordered">
													<tbody>
														<tr>
															<td><strong>Normal overtime  ({{ $employee->overtime_hours }} hrs)</strong> <span class="float-right">{{ $employee->salary->overtime*$employee->overtime_hours }} s.p</span></td>
														</tr>


													</tbody>
												</table>
											</div>
										</div>
										<div class="col-sm-12">
											<p><strong>Net Salary: {{ ($employee->salary->total - $employee->salary->net*30) + ($employee->salary->net*$employee->hours_per_month )+ ($employee->salary->overtime*$employee->overtime_hours) }} s.p</strong> </p>
										</div>
									</div>
                                    @else

                                    @endif
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
