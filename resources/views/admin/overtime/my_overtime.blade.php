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
            <li><a href="{{ route('admin.attendance.index') }}"> Employees Attendance </a></li>
            <li><a href="{{ route('admin.attendance.my_attendance') }}"> My Attendance </a></li>
            <li><a  href="{{ route('admin.overtime.index') }}"> Employees Overtime </a></li>
            <li><a class="active" style="text-decoration: none" href="{{ route('admin.overtime.my_overtime') }}"> My Overtime </a></li>
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
            document.getElementById('overtime_id').value = id;
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
							<h3 class="page-title">My Overtime</h3>

						</div>
						<div class="col-auto float-right ml-auto">
							<a href="{{ route('admin.overtime.my_overtime_add') }}" class="btn add-btn" ><i
									class="fa fa-plus"></i> Add Overtime</a>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

                <!-- Search Filter -->
                <div class="row filter-row">
                    <div class="col-sm-3">
                        <form id="search-overtime-form" action="{{ route('admin.overtime.search') }}" method="post">
                            @csrf
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
                    </div>
                    </form>

                    <div class="col-sm-3">
                        <a href="{{ route('admin.overtime.search') }}" class="btn btn-success btn-block" onclick="event.preventDefault();
                             document.getElementById('search-overtime-form').submit();"> Search </a>					</div>
                </div>
                <!-- /Search Filter -->


				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table mb-0 datatable">
								<thead>
									<tr>
										<th style="width: 30px;">#</th>
										<th>Overtime Date </th>
										<th>Overtime Hours </th>
										<th class="text-center">Status</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>

                                @if(Session::has('search'))

                                @foreach(Session::get('search') as $overtime)
								<tbody>
									<tr>
										<td>{{ $overtime->id }}</td>
										<td>{{ $overtime->created_at->format('y-m-d') }}</td>
										<td>{{ $overtime->hours }}</td>
										<td class="text-center">
											<div class="action-label">
												<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
													<i class="fa fa-dot-circle-o text-purple"></i> {{ $overtime->status }}
												</a>
											</div>
										</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                       data-target="#delete_approve" onclick="saveId({{$overtime->id}})"><i
                                                            class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>

								</tbody>
                                @endforeach

                                @else

                                @foreach($overtimes as $overtime)
								<tbody>
									<tr>
										<td>{{ $overtime->id }}</td>
										<td>{{ $overtime->created_at->format('y-m-d') }}</td>
										<td>{{ $overtime->hours }}</td>
										<td class="text-center">
											<div class="action-label">
												<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
													<i class="fa fa-dot-circle-o text-purple"></i> {{ $overtime->status }}
												</a>
											</div>
										</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                       data-target="#delete_approve" onclick="saveId({{$overtime->id}})"><i
                                                            class="fa fa-trash-o m-r-5"></i> Delete</a>
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

            <!-- Delete Leave Modal -->
            <div class="modal custom-modal fade" id="delete_approve" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-header">
                                <h3>Delete Leave</h3>
                                <p>Are you sure want to Cancel this leave?</p>
                            </div>
                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" href="{{ route('admin.overtime.delete') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('delete-overtime-form').submit();" >Delete</a>

                                        <form id="delete-overtime-form" action="{{ route('admin.overtime.delete') }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                            <input name="overtime_id" type="hidden" id="overtime_id" >

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
            <!-- /Delete Leave Modal -->

		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->


@endsection
