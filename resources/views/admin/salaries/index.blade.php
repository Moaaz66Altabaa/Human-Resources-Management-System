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

    <script>
        function saveId(id){
            var id = id;
            localStorage.setItem('id' , id);
            document.getElementById('salary_id').value = id;
            return false;
        }

    </script>

			<!-- Page Wrapper -->
            <div class="page-wrapper">

				<!-- Page Content -->
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Employee Salary</h3>

							</div>
							<div class="col-auto float-right ml-auto">
								<a href="{{ route('admin.salaries.create') }}" class="btn add-btn" ><i class="fa fa-plus"></i> Add Salary</a>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					<!-- Search Filter -->
					<div class="row filter-row">

						<div class="col-sm-6 col-md-3">
                            <form id="search-salary-form" method="post" action="{{ route('admin.salaries.search') }}">
                                @csrf

							<div class="form-group form-focus">
								<input name="employee_name" type="text" class="form-control floating">
								<label class="focus-label">Employee Name</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group form-focus select-focus">
								<select name="department_id" class="select floating">
                                    <option value="">-select-</option>
                                @foreach($departments as $department)
									<option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
								</select>
								<label class="focus-label">Departments</label>
							</div>
                            </form>
						</div>

						<div class="col-sm-6 col-md-3">
                            <a href="{{ route('admin.salaries.search') }}" class="btn btn-success btn-block" onclick="event.preventDefault();
                             document.getElementById('search-salary-form').submit();"> Search </a>
						</div>
                    </div>
					<!-- /Search Filter -->

					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>Employee</th>
											<th>Employee ID</th>


											<th>Department</th>


											<th>Salary</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>

                                    @if(Session::has('search_return_employees'))
                                    @foreach(Session::get('search_return_employees') as $employee)
                                           @if($employee->salary != null)
									<tbody>
										<tr>
											<td>
												<h2 class="table-avatar">
													<a href="{{ route('admin.profile.index' , $employee->id) }}" class="avatar"><img alt="" src="{{ asset('images/' . $employee->image_path) }}"></a>
													<a href="{{ route('admin.profile.index' , $employee->id) }}">{{ $employee->first_name }} {{ $employee->last_name }}<span>{{ $employee->job->name }}</span></a>
												</h2>
											</td>
											<td>{{ $employee->is_admin ? 'A' : 'E'}} - {{$employee->id}}</td>

										    <td> {{ $employee->job->department->name }} </td>
											<td>{{ $employee->salary->total }} s.p</td>
											<!-- <td><a class="btn btn-sm btn-primary" href="salary-view.html">Generate Slip</a></td> -->
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('admin.salaries.edit' , $employee->salary->id) }}" ><i
                                                                class="fa fa-pencil m-r-5"></i> Edit</a>

                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                           data-target="#delete_salary" onclick="saveId({{$employee->salary->id}})"><i
                                                                class="fa fa-trash-o m-r-5"></i>Delete</a>
													</div>
												</div>
											</td>
										</tr>

									</tbody>
                                                @endif
                                        @endforeach

                                @elseif(Session::has('name'))
                                     @foreach(Session::get('jobs') as $job)
                                       @foreach($job->users()->where('first_name' , Session::get('name'))->get() as $employee)
                                             @if($employee->salary != null)
									<tbody>
										<tr>
											<td>
												<h2 class="table-avatar">
													<a href="{{ route('admin.profile.index' , $employee->id) }}" class="avatar"><img alt="" src="{{ asset('images/' . $employee->image_path) }}"></a>
													<a href="{{ route('admin.profile.index' , $employee->id) }}">{{ $employee->first_name }} {{ $employee->last_name }}<span>{{ $employee->job->name }}</span></a>
												</h2>
											</td>
											<td>{{ $employee->is_admin ? 'A' : 'E'}} - {{$employee->id}}</td>

										    <td> {{ $employee->job->department->name }} </td>
											<td>{{ $employee->salary->total }} s.p</td>
											<!-- <td><a class="btn btn-sm btn-primary" href="salary-view.html">Generate Slip</a></td> -->
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('admin.salaries.edit' , $employee->salary->id) }}" ><i
                                                                class="fa fa-pencil m-r-5"></i> Edit</a>

                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                           data-target="#delete_salary" onclick="saveId({{$employee->salary->id}})"><i
                                                                class="fa fa-trash-o m-r-5"></i>Delete</a>
													</div>
												</div>
											</td>
										</tr>

									</tbody>
                                                @endif
                                        @endforeach
                                    @endforeach

                                    @elseif(Session::has('search_return_jobs'))
                                    @foreach(Session::get('search_return_jobs') as $job)
                                       @foreach($job->users()->get() as $employee)
                                             @if($employee->salary != null)
									<tbody>
										<tr>
											<td>
												<h2 class="table-avatar">
													<a href="{{ route('admin.profile.index' , $employee->id) }}" class="avatar"><img alt="" src="{{ asset('images/' . $employee->image_path) }}"></a>
													<a href="{{ route('admin.profile.index' , $employee->id) }}">{{ $employee->first_name }} {{ $employee->last_name }}<span>{{ $employee->job->name }}</span></a>
												</h2>
											</td>
											<td>{{ $employee->is_admin ? 'A' : 'E'}} - {{$employee->id}}</td>

										    <td> {{ $employee->job->department->name }} </td>
											<td>{{ $employee->salary->total }} s.p</td>
											<!-- <td><a class="btn btn-sm btn-primary" href="salary-view.html">Generate Slip</a></td> -->
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('admin.salaries.edit' , $employee->salary->id) }}" ><i
                                                                class="fa fa-pencil m-r-5"></i> Edit</a>

                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                           data-target="#delete_salary" onclick="saveId({{$employee->salary->id}})"><i
                                                                class="fa fa-trash-o m-r-5"></i>Delete</a>
													</div>
												</div>
											</td>
										</tr>

									</tbody>
                                                @endif
                                        @endforeach
                                    @endforeach

                                    @else

                                    @foreach($salaries as $salary)
									<tbody>
										<tr>
											<td>
												<h2 class="table-avatar">
													<a href="{{ route('admin.profile.index' , $salary->user_id) }}" class="avatar"><img alt="" src="{{ asset('images/' . \App\Models\User::find($salary->user_id)->image_path) }}"></a>
													<a href="{{ route('admin.profile.index' , $salary->user_id) }}">{{ \App\Models\User::find($salary->user_id)->first_name }} {{ \App\Models\User::find($salary->user_id)->last_name }}<span>{{ \App\Models\User::find($salary->user_id)->job->name }}</span></a>
												</h2>
											</td>
											<td>{{ \App\Models\User::find($salary->user_id)->is_admin ? 'A' : 'E'}} - {{\App\Models\User::find($salary->user_id)->id}}</td>

										    <td> {{ \App\Models\User::find($salary->user_id)->job->department->name }} </td>
											<td>{{ $salary->total }} s.p</td>
											<!-- <td><a class="btn btn-sm btn-primary" href="salary-view.html">Generate Slip</a></td> -->
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="{{ route('admin.salaries.edit' , $salary->id) }}" ><i
                                                                class="fa fa-pencil m-r-5"></i> Edit</a>

                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                           data-target="#delete_salary" onclick="saveId({{$salary->id}})"><i
                                                                class="fa fa-trash-o m-r-5"></i>Delete</a>
													</div>
												</div>
											</td>
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




				<!-- Delete Salary Modal -->
				<div class="modal custom-modal fade" id="delete_salary" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Salary</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
                                        <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" href="{{ route('admin.salaries.delete') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('delete-salary-form').submit();" >Delete</a>

                                        <form id="delete-salary-form" action="{{ route('admin.salaries.delete') }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                            <input name="salary_id" id="salary_id" type="hidden" >

                                        </form>
                                    </div>
                                        <div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Delete Salary Modal -->

            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->


@endsection
