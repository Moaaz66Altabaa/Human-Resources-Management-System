@extends('admin_layout')

@section('navbar_items')
    <li ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li ><a  href="{{ route('admin.employees.index') }}">All Employees</a></li>
            <li><a  href="{{ route('admin.departments.index') }}">Departments</a></li>
            <li><a style="text-decoration: none" href="{{ route('admin.jobs.index') }}">Jobs</a></li>

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
            <li><a class="active" style="text-decoration: none" href="{{ route('admin.attendance.index') }}"> Employees Attendance </a></li>
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

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Attendance</h3>

						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<!-- Search Filter -->
				<div class="row filter-row">


					<div class="col-sm-6 col-md-3">
                        <form id="search-attendance-form" action="{{ route('admin.attendance.search') }}" method="post">
                            @csrf
						<div class="form-group form-focus">
							<input name="employee_name" type="text" class="form-control floating">
							<label class="focus-label">Employee Name</label>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group form-focus select-focus">
							<select name="month" class="select floating">
								<option value="" >-</option>
								<option value="1">Jan</option>
								<option value="2">Feb</option>
								<option value="3">Mar</option>
								<option value="4">Apr</option>
								<option value="5">May</option>
								<option value="6">Jun</option>
								<option value="7">Jul</option>
								<option value="8">Aug</option>
								<option value="9">Sep</option>
								<option value="10">Oct</option>
								<option value="11">Nov</option>
								<option value="12">Dec</option>
							</select>
							<label class="focus-label">Select Month</label>
						</div>
                    </form>

                </div>
					<div class="col-sm-6 col-md-3">
						<a href="{{ route('admin.attendance.search') }}" class="btn btn-success btn-block" onclick="event.preventDefault();
                             document.getElementById('search-attendance-form').submit();"> Search </a>
					</div>
				</div>
				<!-- /Search Filter -->

				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table table-nowrap mb-0">
								<thead>
									<tr>
										<th>Employee</th>
										<th>1</th>
										<th>2</th>
										<th>3</th>
										<th>4</th>
										<th>5</th>
										<th>6</th>
										<th>7</th>
										<th>8</th>
										<th>9</th>
										<th>10</th>
										<th>11</th>
										<th>12</th>
										<th>13</th>
										<th>14</th>
										<th>15</th>
										<th>16</th>
										<th>17</th>
										<th>18</th>
										<th>19</th>
										<th>20</th>
										<th>22</th>
										<th>23</th>
										<th>24</th>
										<th>25</th>
										<th>26</th>
										<th>27</th>
										<th>28</th>
										<th>29</th>
										<th>30</th>
										<th>31</th>
									</tr>
								</thead>

                                @if(Session::has('search_employee_month'))
                                @foreach(Session::get('search_employee_month') as $employee)

								<tbody>
									<tr>
                                        <td>
											<h2 class="table-avatar">
												<a class="avatar avatar-xs" href="{{ route('admin.profile.index' , $employee->id) }}"><img alt=""
														src="{{ asset('images/' . $employee->image_path) }}"></a>
												<a href="{{ route('admin.profile.index' , $employee->id) }}"> {{ $employee->first_name  }} {{ $employee->last_name }} </a>
											</h2>
										</td>
                                        @foreach($employee->attendence()->whereMonth('created_at' , Session::get('month'))->get() as $attendance)


                                        @if($attendance->status == 'present')
                                                <td><a href="{{ route('admin.attendance.show' , [$attendance->id , $employee->id]) }}" ><i
                                                            class="fa fa-check text-success" ></i></a></td>
                                            @elseif($attendance->status == 'absent')
										    <td><i class="fa fa-close text-danger"></i> </td>
                                            @else
                                            <td><a href="{{ route('admin.attendance.show' , [$attendance->id , $employee->id]) }}" >
                                                    <i class="fa fa-leaf text-success"></i> </a></td>
                                            @endif
                                        @endforeach
									</tr>

								</tbody>
                                @endforeach

                                @elseif(Session::has('search_month'))
                                    @foreach(Session::get('employees') as $employee)

								<tbody>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a class="avatar avatar-xs" href="{{ route('admin.profile.index' , $employee->id) }}"><img alt=""
														src="{{ asset('images/' . $employee->image_path) }}"></a>
												<a href="{{ route('admin.profile.index' , $employee->id) }}"> {{ $employee->first_name  }} {{ $employee->last_name }} </a>
											</h2>

                                        </td>
                                        @foreach($employee->attendence()->whereMonth('created_at' , Session::get('month'))->get() as $attendance)

                                        @if($attendance->status == 'present')
                                                <td><a href="{{ route('admin.attendance.show' , [$attendance->id , $employee->id]) }}" ><i
                                                            class="fa fa-check text-success" ></i></a></td>
                                            @elseif($attendance->status == 'absent')
										    <td><i class="fa fa-close text-danger"></i> </td>
                                            @else
                                                <td><a href="{{ route('admin.attendance.show' , [$attendance->id , $employee->id]) }}" >
                                                        <i class="fa fa-leaf text-success"></i> </a></td>
                                            @endif
                                        @endforeach

                                    </tr>

								</tbody>
                                @endforeach

                                @elseif(Session::has('search_employee'))
                                    @foreach(Session::get('search_employee') as $employee)

								<tbody>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a class="avatar avatar-xs" href="{{ route('admin.profile.index' , $employee->id) }}"><img alt=""
														src="{{ asset('images/' . $employee->image_path) }}"></a>
												<a href="{{ route('admin.profile.index' , $employee->id) }}"> {{ $employee->first_name  }} {{ $employee->last_name }} </a>
											</h2>
										</td>
                                        @foreach($employee->attendence()->get() as $attendance)
                                            @if($attendance->status == 'present')
                                                <td><a href="{{ route('admin.attendance.show' , [$attendance->id , $employee->id]) }}" ><i
                                                            class="fa fa-check text-success" ></i></a></td>
                                            @elseif($attendance->status == 'absent')
										    <td><i class="fa fa-close text-danger"></i> </td>
                                            @else
                                                <td><a href="{{ route('admin.attendance.show' , [$attendance->id , $employee->id]) }}" >
                                                        <i class="fa fa-leaf text-success"></i> </a></td>
                                            @endif
                                        @endforeach

									</tr>

								</tbody>
                                 @endforeach

                                @else
                                @foreach($employees as $employee)
								<tbody>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a class="avatar avatar-xs" href="{{ route('admin.profile.index' , $employee->id) }}"><img alt=""
														src="{{ asset('images/' . $employee->image_path) }}"></a>
												<a href="{{ route('admin.profile.index' , $employee->id) }}"> {{ $employee->first_name  }} {{ $employee->last_name }} </a>
											</h2>
										</td>

                                        @foreach($employee->attendence()->whereMonth('created_at' , now()->month)->get() as $attendance)
                                            @if($attendance->status == 'present')
                                            <td><a href="{{ route('admin.attendance.show' , [$attendance->id , $employee->id]) }}" ><i
                                                        class="fa fa-check text-success" ></i></a></td>
                                            @elseif($attendance->status == 'absent')
										    <td><i class="fa fa-close text-danger"></i> </td>
                                            @else
                                                <td><a href="{{ route('admin.attendance.show' , [$attendance->id , $employee->id]) }}" >
                                                        <i class="fa fa-leaf text-success"></i> </a></td>
                                            @endif
                                        @endforeach
									</tr>

								</tbody>
                                @endforeach
                                @endif

							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Content -->

			<!-- Attendance Modal -->
			<div class="modal custom-modal fade" id="attendance_info" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Attendance Info</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-md-6">
									<div class="card punch-status">
										<div class="card-body">
											<h5 class="card-title">Timesheet <small class="text-muted"> {{ now()->format('y-m-d') }} </small></h5>
											<div class="punch-det">
												<h6>Checked In at</h6>
												<p id="check_in"> </p>
											</div>
											<div class="punch-info">
												<div class="punch-hours">
													<span>8 hrs</span>
												</div>
											</div>
											<div class="punch-det">
												<h6>Checked Out at</h6>
												<p id="check_out"></p>
											</div>
											<div class="statistics">
												<div class="row">
													<div class="col-md-6 col-6 text-center">
														<div class="stats-box">
															<p>Overtime</p>
															<h6 id="overtime"></h6>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="card recent-activity">
										<div class="card-body">
											<h5 class="card-title">Activity</h5>
											<ul class="res-activity-list">
												<li>
													<p class="mb-0">Punch In at</p>
													<p class="res-activity-time">
														<i class="fa fa-clock-o"></i>
														10.00 AM.
													</p>
												</li>
												<li>
													<p class="mb-0">Punch Out at</p>
													<p class="res-activity-time">
														<i class="fa fa-clock-o"></i>
														11.00 AM.
													</p>
												</li>
												<li>
													<p class="mb-0">Punch In at</p>
													<p class="res-activity-time">
														<i class="fa fa-clock-o"></i>
														11.15 AM.
													</p>
												</li>
												<li>
													<p class="mb-0">Punch Out at</p>
													<p class="res-activity-time">
														<i class="fa fa-clock-o"></i>
														1.30 PM.
													</p>
												</li>
												<li>
													<p class="mb-0">Punch In at</p>
													<p class="res-activity-time">
														<i class="fa fa-clock-o"></i>
														2.00 PM.
													</p>
												</li>
												<li>
													<p class="mb-0">Punch Out at</p>
													<p class="res-activity-time">
														<i class="fa fa-clock-o"></i>
														7.30 PM.
													</p>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Attendance Modal -->

		</div>
		<!-- Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

@endsection
