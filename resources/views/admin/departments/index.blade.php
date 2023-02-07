@extends('admin_layout')

@section('navbar_items')
    <li ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li ><a  href="{{ route('admin.employees.index') }}">All Employees</a></li>
            <li><a class="active" style="text-decoration: none" href="{{ route('admin.departments.index') }}">Departments</a></li>
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
            <li><a href="{{ route('admin.attendance.index') }}l"> Employees Attendance </a></li>
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

    <script>
        function saveId(id){
            var id = id;
            localStorage.setItem('id' , id);
            document.getElementById('department_id').value = id;
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
							<h3 class="page-title">Department</h3>

						</div>
						<div class="col-auto float-right ml-auto">
							<a href="{{ route('admin.departments.create') }}" class="btn add-btn" ><i
									class="fa fa-plus"></i> Add Department</a>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<div class="row">
					<div class="col-md-12">
						<div>
							<table class="table table-striped custom-table mb-0 datatable">
								<thead>
									<tr>
										<th style="width: 30px;">#</th>
										<th>Department Name</th>
										<th>Tel Number</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
							    @foreach($departments as $department)
                                    <tbody>
                                    <tr>
                                        <td>{{$department->id}}</td>
                                        <td>{{$department->name}}</td>
                                        <td>{{$department->tel_number}}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('admin.departments.edit' , $department->id) }}" ><i
                                                            class="fa fa-pencil m-r-5"></i> Edit</a>

                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                       data-target="#delete_department" onclick="saveId({{$department->id}})"><i
                                                            class="fa fa-trash-o m-r-5"></i>Delete</a>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    </tbody>
                              @endforeach
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Content -->

			<!-- Add Department Modal -->
{{--			<div id="add_department" class="modal custom-modal fade" role="dialog">--}}
{{--				<div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--					<div class="modal-content">--}}
{{--						<div class="modal-header">--}}
{{--							<h5 class="modal-title">Add Department</h5>--}}
{{--							<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--								<span aria-hidden="true">&times;</span>--}}
{{--							</button>--}}
{{--						</div>--}}
{{--						<div class="modal-body">--}}
{{--							<form method="post" action="{{route('admin.departments.store')}}">--}}
{{--                                @csrf--}}

{{--								<div class="form-group">--}}
{{--									<label>Department Name <span class="text-danger"></span></label>--}}
{{--									<input type="text" name="name" value="{{ old('name') }}" class="form-control" required>--}}
{{--                                    @error('name')--}}
{{--                                    <p style="color: red"> {{ $message }} </p>--}}
{{--                                    <br>--}}
{{--                                    @enderror--}}
{{--								</div>--}}
{{--								<div class="form-group">--}}
{{--									<label>Tell <span class="text-danger"></span></label>--}}
{{--									<input name="tel_number" class="form-control" type="number" value="{{ old('tel_number') }}" required>--}}
{{--                                    @error('tel_number')--}}
{{--                                    <p style="color: red"> {{ $message }} </p>--}}
{{--                                    <br>--}}
{{--                                    @enderror--}}
{{--								</div>--}}

{{--								<div class="submit-section">--}}
{{--									<button class="btn btn-primary submit-btn">Add</button>--}}
{{--                                    <input type="submit" class="btn btn-primary submit-btn" value="Add">--}}
{{--								</div>--}}
{{--							</form>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--			<!-- /Add Department Modal -->--}}

{{--			<!-- Edit Department Modal -->--}}
{{--			<div id="edit_department" class="modal custom-modal fade" role="dialog">--}}
{{--				<div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--					<div class="modal-content">--}}
{{--						<div class="modal-header">--}}
{{--							<h5 class="modal-title">Edit Department</h5>--}}
{{--							<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--								<span aria-hidden="true">&times;</span>--}}
{{--							</button>--}}
{{--						</div>--}}
{{--						<div class="modal-body">--}}
{{--							<form>--}}
{{--								<div class="form-group">--}}
{{--									<label>Tel Number <span class="text-danger"></span></label>--}}
{{--									<input class="form-control" value="0118119021" type="number">--}}
{{--								</div>--}}
{{--								<div class="submit-section">--}}
{{--									<button class="btn btn-primary submit-btn">Save</button>--}}
{{--								</div>--}}
{{--							</form>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
			<!-- /Edit Department Modal -->

			<!-- Delete Department Modal -->
			<div class="modal custom-modal fade" id="delete_department" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Department</h3>
								<p>Are you sure want to delete?</p>
							</div>
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" href="{{ route('admin.departments.delete') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('delete-department-form').submit();" >Delete</a>

                                        <form id="delete-department-form" action="{{ route('admin.departments.delete') }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                            <input name="department_id" id="department_id" type="hidden" >

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

		</div>



	<!-- /Main Wrapper -->

@endsection
