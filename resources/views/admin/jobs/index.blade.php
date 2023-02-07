@extends('admin_layout')

@section('navbar_items')
    <li ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li ><a  href="{{ route('admin.employees.index') }}">All Employees</a></li>
            <li><a  href="{{ route('admin.departments.index') }}">Departments</a></li>
            <li><a class="active" style="text-decoration: none" href="{{ route('admin.jobs.index') }}">Jobs</a></li>

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
    <li>
        <a href="{{ route('admin.company.index') }}"><i class="la la-cog"></i> <span>Company Settings</span> </a>
    </li>
@endsection

@section('content')

    <script>
        function saveId(id){
            var id = id;
            localStorage.setItem('id' , id);
            document.getElementById('job_id').value = id;
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
							<h3 class="page-title">Jobs</h3>

						</div>
						<div class="col-auto float-right ml-auto">
							<a href="{{ route('admin.jobs.create') }}" class="btn add-btn" ><i
									class="fa fa-plus"></i> Add Job</a>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table mb-0 datatable">
								<thead>
									<tr>
										<th style="width: 30px;">#</th>
										<th>Designation </th>
										<th>Department </th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
                                @foreach($jobs as $job)
								<tbody>
									<tr>
										<td>{{$job->id}}</td>
										<td>{{$job->name}}</td>
										<td>{{$job->department->name}}</td>
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
													aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="{{ route('admin.jobs.edit' , $job->id) }}" ><i
															class="fa fa-pencil m-r-5"></i> Edit</a>

                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                       data-target="#delete_designation" onclick="saveId({{$job->id}})"><i
                                                            class="fa fa-trash-o m-r-5"></i>Delete</a>
												</div>
											</div>
										</td>

								</tbody>
                                @endforeach
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Content -->

			<!-- Add Designation Modal -->
{{--			<div id="add_designation" class="modal custom-modal fade" role="dialog">--}}
{{--				<div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--					<div class="modal-content">--}}
{{--						<div class="modal-header">--}}
{{--							<h5 class="modal-title">Add Designation</h5>--}}
{{--							<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--								<span aria-hidden="true">&times;</span>--}}
{{--							</button>--}}
{{--						</div>--}}
{{--						<div class="modal-body">--}}
{{--							<form method="post" action="{{route('admin.jobs.store')}}">--}}
{{--                                @csrf--}}

{{--								<div class="form-group">--}}
{{--									<label>Job Name <span class="text-danger"></span></label>--}}
{{--                                    <input name="name" class="form-control" type="text" value="{{ old('name') }}" required>--}}
{{--                                    @error('name')--}}
{{--                                    <p style="color: red"> {{ $message }} </p>--}}
{{--                                    <br>--}}
{{--                                    @enderror--}}
{{--								</div>--}}
{{--								<div class="form-group">--}}
{{--									<label>Department <span class="text-danger"></span></label>--}}
{{--									<select name="department_id" class="select" required>--}}
{{--										<option>Select Department</option>--}}
{{--                                        @foreach($departments as $department)--}}
{{--										<option value="{{ $department->id }}">{{ $department->name }}</option>--}}
{{--										@endforeach--}}
{{--									</select>--}}
{{--                                    @error('department_id')--}}
{{--                                    <p style="color: red"> {{ $message }} </p>--}}
{{--                                    <br>--}}
{{--                                    @enderror--}}
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
			<!-- /Add Designation Modal -->

			<!-- Edit Designation Modal -->
			<div id="edit_designation" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Designation</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label>Designation Name <span class="text-danger"></span></label>
                                    <input name="name" class="form-control" type="text" value="{{ old('name') }}" required>
                                </div>
								<div class="form-group">
									<label>Department <span class="text-danger"></span></label>
									<select class="select">
										<option>Select Department</option>
										<option>Web Development</option>
										<option>IT Management</option>
										<option>Marketing</option>
									</select>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Edit Designation Modal -->

			<!-- Delete Designation Modal -->
			<div class="modal custom-modal fade" id="delete_designation" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Designation</h3>
								<p>Are you sure want to delete?</p>
							</div>
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" href="{{ route('admin.jobs.delete') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('delete-job-form').submit();" >Delete</a>

                                        <form id="delete-job-form" action="{{ route('admin.jobs.delete') }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                            <input name="job_id" id="job_id" type="hidden" >

                                        </form>									</div>
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
			<!-- /Delete Designation Modal -->

		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

@endsection
