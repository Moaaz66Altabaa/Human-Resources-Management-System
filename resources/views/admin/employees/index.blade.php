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
            <li><a href="{{ route('admin.attendance.index') }}"> Employees Attendance </a></li>
            <li><a href="{{ route('admin.attendance.my_attendance')}}"> My Attendance </a></li>
            <li><a href="{{ route('admin.overtime.index') }}"> Employees Overtime </a></li>
            <li><a href="{{ route('admin.overtime.index') }}"> My Overtime </a></li>
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

    <script>
        function saveId(id){
            var id = id;
            localStorage.setItem('id' , id);
            document.getElementById('employee_id').value = id;
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
							<h3 class="page-title">All Employees</h3>

						</div>
						<div class="col-auto float-right ml-auto">
{{--							<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i--}}
{{--									class="fa fa-plus"></i> Add Employee</a>--}}

                            <a href="{{ route('admin.employees.create') }}" class="btn add-btn" ><i
									class="fa fa-plus"></i> Add Employee</a>

						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<!-- Search Filter -->
				<div class="row filter-row">

					<div class="col-sm-6 col-md-3">
						<div class="form-group form-focus">
                            <form id="search-employee-form" method="post" action="{{ route('admin.employees.search') }}">
                                @csrf
                                <input id="employee_name" name="employee_name" type="text" class="form-control floating">
                                <label class="focus-label">Employee Name</label>
						</div>
					</div>
					<div class="col-sm-6 col-md-3">
						<div class="form-group form-focus select-focus">
							<select id="job_id" name="job_id" class="select floating">
								<option value="">Select a Job</option>
                                @foreach($jobs as $job)
                                <option value="{{$job->id}}">{{ $job->name }}</option>
                                @endforeach
							</select>
							<label class="focus-label">Job</label>
						</div>
					</div>
                   </form>
					<div class="col-sm-6 col-md-3">
                        <a class="btn btn-success btn-block" href="{{ route('admin.employees.search') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('search-employee-form').submit();" > Search </a>
					</div>
				</div>
				<!-- /Search Filter -->

				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table datatable">
								<thead>
									<tr>
										<th>Name</th>
										<th>Employee ID</th>
										<th>Role</th>

										<!-- <th>Mobile</th> -->
										<!-- <th class="text-nowrap">Join Date</th> -->
										<th>Department</th>
										<th>Email</th>
										<th class="text-right no-sort">Action</th>
									</tr>
								</thead>

                        @if(Session::has('search'))
                            @foreach(Session::get('search') as $employee)
								<tbody>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="{{ route('admin.profile.index' , $employee->id) }}" class="avatar"><img alt=""
                                                                                              src="{{asset('images/'.$employee->image_path)}}"></a>
												<a href="{{ route('admin.profile.index' , $employee->id) }}"> {{$employee->first_name}} {{ $employee->last_name }} <span>{{$employee->job->name}}</span></a>
											</h2>
										</td>
										<td>{{$employee->is_admin? 'A' : 'E'}} - {{$employee->id}}</td>
										<td>
											<span class="badge bg-inverse-danger">{{$employee->is_admin? 'Admin' : 'Employee'}}</span>
										</td>

										<td> {{$employee->job->department->name}} </td>
										<td>{{$employee->email}}</td>




										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
													aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">

													<a class="dropdown-item" href="{{ route('admin.employees.edit' , $employee->id) }}" ><i class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>

                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                       data-target="#delete_employee" onclick="saveId({{$employee->id}})"><i
                                                            class="fa fa-trash-o m-r-5"></i>Delete</a>

                                                </div>
											</div>
										</td>

								</tbody>
                            @endforeach

                            @else

                            @foreach($employees as $employee)
								<tbody>
									<tr>
										<td>
											<h2 class="table-avatar">
												<a href="{{ route('admin.profile.index' , $employee->id) }}" class="avatar"><img alt=""
                                                                                              src="{{asset('images/'.$employee->image_path)}}"></a>
												<a href="{{ route('admin.profile.index' , $employee->id) }}"> {{$employee->first_name}} {{ $employee->last_name }} <span>{{$employee->job->name}}</span></a>
											</h2>
										</td>
										<td>{{$employee->is_admin? 'A' : 'E'}} - {{$employee->id}}</td>
										<td>
											<span class="badge bg-inverse-danger">{{$employee->is_admin? 'Admin' : 'Employee'}}</span>
										</td>

										<td> {{$employee->job->department->name}} </td>
										<td>{{$employee->email}}</td>




										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
													aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">

													<a class="dropdown-item" href="{{ route('admin.employees.edit' , $employee->id) }}" ><i class="fa fa-pencil m-r-5"></i>
                                                        Edit</a>

                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                       data-target="#delete_employee" onclick="saveId({{$employee->id}})"><i
                                                            class="fa fa-trash-o m-r-5"></i>Delete</a>

                                                </div>
											</div>
										</td>

								</tbody>

                            @endforeach
                        @endif

							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Content -->

			<!-- Add Employee Modal -->
{{--			<div id="add_employee" class="modal custom-modal fade" role="dialog">--}}
{{--				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">--}}
{{--					<div class="modal-content">--}}
{{--						<div class="modal-header">--}}
{{--							<h5 class="modal-title">Add Employee</h5>--}}
{{--							<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--								<span aria-hidden="true">&times;</span>--}}
{{--							</button>--}}
{{--						</div>--}}
{{--						<div class="modal-body">--}}
{{--							<form method="post" action="{{route('admin.employees.store')}}">--}}
{{--                                @csrf--}}
{{--								<div class="row">--}}
{{--									<div class="col-sm-6">--}}
{{--										<div class="form-group">--}}
{{--											<label class="col-form-label">First Name <span--}}
{{--													class="text-danger"></span></label>--}}
{{--											<input name="first_name" class="form-control" type="text" value="{{ old('first_name') }}" required>--}}
{{--                                            @error('first_name')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--										</div>--}}
{{--									</div>--}}
{{--									<div class="col-sm-6">--}}
{{--										<div class="form-group">--}}
{{--											<label class="col-form-label">Last Name</label>--}}
{{--											<input name="last_name" class="form-control" type="text" value="{{ old('last_name') }}" required>--}}
{{--                                            @error('last_name')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--										</div>--}}
{{--									</div>--}}

{{--									<div class="col-sm-6">--}}
{{--										<div class="form-group">--}}
{{--											<label class="col-form-label">Email <span--}}
{{--													class="text-danger"></span></label>--}}
{{--											<input class="form-control" type="email" name="email" value="{{ old('email') }}" required>--}}
{{--                                            @error('email')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--									</div>--}}
{{--									<div class="col-sm-6">--}}
{{--										<div class="form-group">--}}
{{--											<label class="col-form-label">Password</label>--}}
{{--											<input class="form-control" type="password" name="password" required>--}}
{{--                                            @error('password')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--										</div>--}}
{{--									</div>--}}
{{--									<div class="col-sm-6">--}}
{{--										<div class="form-group">--}}
{{--											<label class="col-form-label">Confirm Password</label>--}}
{{--											<input class="form-control" type="password" name="password_confirmation" required>--}}
{{--                                            @error('password_confirmation')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--										</div>--}}
{{--									</div>--}}

{{--									<div class="col-sm-6">--}}
{{--										<div class="form-group">--}}
{{--											<label class="col-form-label">Phone Number </label>--}}
{{--											<input class="form-control" name="mobile_number" type="number" required>--}}
{{--                                            @error('mobile_number')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--										</div>--}}
{{--									</div>--}}

{{--									<div class="col-md-6">--}}
{{--										<div class="form-group">--}}
{{--											<label>Job <span class="text-danger"></span></label>--}}
{{--											<select name="job_id" class="select">--}}
{{--												<option>Select Job</option>--}}
{{--                                                @foreach($jobs as $job)--}}
{{--                                                    <option value="{{ $job->id }}">{{ $job->name }}</option>--}}
{{--                                                @endforeach--}}
{{--											</select>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--									<div class="col-sm-6">--}}
{{--										<div class="form-group">--}}
{{--											<label class="col-form-label">Role</label>--}}
{{--											<select name="is_admin" class="select">--}}
{{--                                                <option value="" selected >Choose Role</option>--}}
{{--                                                <option value="{{ 1 }}">Admin</option>--}}
{{--                                                <option value="{{ 0 }}">Employee</option>--}}
{{--											</select>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--								</div>--}}

{{--								<div class="submit-section">--}}
{{--									<button class="btn btn-primary submit-btn">Add</button>--}}
{{--                                    <input type="submit" value="Add" class="btn btn-primary submit-btn">--}}
{{--								</div>--}}
{{--							</form>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--			<!-- /Add Employee Modal -->--}}

{{--			<!-- Edit Employee Modal -->--}}
{{--			<div id="edit_employee" class="modal custom-modal fade" role="dialog">--}}
{{--				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">--}}
{{--					<div class="modal-content">--}}
{{--						<div class="modal-header">--}}
{{--							<h5 class="modal-title">Edit Employee</h5>--}}
{{--							<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--								<span aria-hidden="true">&times;</span>--}}
{{--							</button>--}}
{{--						</div>--}}
{{--						<div class="modal-body">--}}
{{--							<form method="post" action="{{route('admin.employees.update')}}">--}}
{{--                                @csrf--}}
{{--                                @method('PUT')--}}

{{--                                <input name="user_id" id="employee_id" type="hidden" >--}}

{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-form-label">First Name <span--}}
{{--                                                    class="text-danger"></span></label>--}}
{{--                                            <input name="first_name" class="form-control" type="text" value="" required>--}}
{{--                                            @error('first_name')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-form-label">Last Name</label>--}}
{{--                                            <input name="last_name" class="form-control" type="text" value="{{ old('last_name') }}" required>--}}
{{--                                            @error('last_name')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-sm-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-form-label">Email <span--}}
{{--                                                    class="text-danger"></span></label>--}}
{{--                                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>--}}
{{--                                            @error('email')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-form-label">Password</label>--}}
{{--                                            <input class="form-control" type="password" name="password" required>--}}
{{--                                            @error('password')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-form-label">Confirm Password</label>--}}
{{--                                            <input class="form-control" type="password" name="password_confirmation" required>--}}
{{--                                            @error('password_confirmation')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-sm-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-form-label">Phone Number </label>--}}
{{--                                            <input class="form-control" name="mobile_number" type="number" required>--}}
{{--                                            @error('mobile_number')--}}
{{--                                            <p style="color: red"> {{ $message }} </p>--}}
{{--                                            <br>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="col-md-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Job <span class="text-danger"></span></label>--}}
{{--                                            <select name="job_id" class="select">--}}
{{--                                                <option>Select Job</option>--}}
{{--                                                @foreach($jobs as $job)--}}
{{--                                                    <option value="{{ $job->id }}">{{ $job->name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label class="col-form-label">Role</label>--}}
{{--                                            <select name="is_admin" class="select">--}}
{{--                                                <option value="" selected >Choose Role</option>--}}
{{--                                                <option value="{{ 1 }}">Admin</option>--}}
{{--                                                <option value="{{ 0 }}">Employee</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="submit-section">--}}
{{--                                    --}}{{--<button class="btn btn-primary submit-btn">Add</button>--}}
{{--                                    <input type="submit" value="Edit" class="btn btn-primary submit-btn">--}}
{{--                                </div>--}}
{{--							</form>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
			<!-- /Edit Employee Modal -->

			<!-- Delete Employee Modal -->
            <div class="modal custom-modal fade" id="delete_employee" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Employee</h3>
                                <p>Are you sure want to delete?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" href="{{ route('admin.employees.delete') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('delete-employee-form').submit();" >Delete</a>

                                        <form id="delete-employee-form" action="{{ route('admin.employees.delete') }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                            <input name="user_id" id="employee_id" type="hidden" >

                                        </form>

                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal"
                                           class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<!-- /Delete Employee Modal -->

		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->


@endsection
