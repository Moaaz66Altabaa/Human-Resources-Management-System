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
						</li>
						<li class="submenu">
							<a href="#" class="noti-dot"><i class="	la la-edit"></i> <span> leaves</span> <span
									class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="{{ route('employee.leaves.myleaves') }}">My Leaves  </a></li>

								<li><a href="{{ route('employee.leaves.index') }}">Leave Type</a></li>

							</ul>
						</li>
						<li class="submenu">
							<a href="#" class="noti-dot"><i class="	la la-calendar-o"></i> <span> Attendances</span>
								<span class="menu-arrow"></span></a>
							<ul style="display: none;">

								<li><a href="{{ route('employee.attendance.my_attendance') }}">My Attendance </a></li>

								<li><a class="active" style="text-decoration: none" href="{{ route('employee.attendance.overtime') }}">Overtime</a></li>
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
							<h3 class="page-title">Overtime Employees</h3>

						</div>
						<div class="col-auto float-right ml-auto">
						<button onclick="window.location.href='{{ route('employee.attendance.add_overtime') }}'" class="btn add-btn" data-toggle="modal" style="color: white; text-decoration: none; font-size: 15px"><i
						 class="fa fa-plus"></i>Add overtime</button>
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
										<th>Overtime Date </th>
										<th>Overtime Hours </th>
										<th class="text-center">Status</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								@foreach($overtimes as $overtime)
								<tbody>
									<tr>
										<td>{{$overtime->id}}</td>
										<td>{{$overtime->created_at->format('y-m-d')}}</td>
										<td>{{$overtime->hours}}</td>
										<td class="text-center">
											<div class="action-label">
												<a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
													<i class="fa fa-dot-circle-o text-purple"></i> {{$overtime->status}}
												</a>
											</div>
										</td>
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
													aria-expanded="false"><i class="material-icons">more_vert</i></a>
													@if($overtime->status=='pending')

													<div class="dropdown-menu dropdown-menu-right">
													<a href="{{route('employee.attendance.edit_overtime',$overtime->id)}}" class="dropdown-item"
														><i
														class="fa fa-pencil m-r-5"></i> Edit</a>
													<a class="dropdown-item" href="#" data-toggle="modal"
														data-target="#delete_designation" onclick="saveId( {{$overtime->id}} )" ><i
															class="fa fa-trash-o m-r-5"></i> Delete</a>
															@endif

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


			<!-- Delete Designation Modal -->
			<div class="modal custom-modal fade" id="delete_designation" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Overtime</h3>
								<p>Are you sure want to delete?</p>
							</div>
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
										<a href="javascript:void(0);" class="btn btn-primary continue-btn" href="{{route('employee.attendance.delete')}}"
										onclick="event.preventDefault();
										document.getElementById('delete-ovretime-form').submit();"
										>Delete</a>
										<form id="delete-ovretime-form" action="{{route('employee.attendance.delete')}}" method="POST" class="d-none">
											@csrf
											@method('DELETE')

											<input name="overtime_id" id="overtime_id" type="hidden">
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
			<!-- /Delete Designation Modal -->

		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->
	@endsection
