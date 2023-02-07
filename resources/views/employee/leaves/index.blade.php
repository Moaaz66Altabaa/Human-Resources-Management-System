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
								
								<li><a class="active" style="text-decoration: none" href="{{ route('employee.leaves.index') }}">Leave Type</a></li>
								
							</ul>
						</li>
						<li class="submenu">
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

				

				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>#</th>
										<th>Leave Type</th>
										<th>Max Days Per Month </th>
										<th>Status</th>
										
									</tr>
								</thead>
								    @foreach($leaves as $leave)
								<tbody>
									<tr>
										<td>{{$leave->id}}</td>
										<td>{{$leave->name}}</td>
										<td>{{$leave->max_per_month}}</td>
									
										<td>{{$leave->is_paid? 'paid' : 'un_paid'}}</td>
										
									</tr>
								
									
								</tbody>
								@endforeach
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Content -->

			<!-- Add Leavetype Modal -->
			<div id="add_leavetype" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Add Leave Type</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form> 
								
								<div class="form-group">
									<label>Leave Type <span class="text-danger"></span></label>
									<input class="form-control" type="text">
								</div>
								<div class="form-group">
									<label>Max Days Per Month <span class="text-danger"></span></label>
									<input class="form-control" type="number">
								</div>
								<div class="form-group">
									<label>Stauts <span class="text-danger"></span></label>
									<select class="form-control">
										<option>Paid</option>
										<option>Unpaid</option>
										
									</select>
								</div>
								

								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Add</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<!-- /Add Leavetype Modal -->

			<!-- Edit Leavetype Modal -->
			<div id="edit_leavetype" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Edit Leave Type</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label>Leave Type <span class="text-danger"></span></label>
									<input class="form-control" type="text" value="Medical Leave">
								</div>
								<div class="form-group">
									<label>Max Days Per Month  <span class="text-danger"></span></label>
									<input class="form-control" type="number" value="12">
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Edit Leavetype Modal -->

			<!-- Delete Leavetype Modal -->
			<div class="modal custom-modal fade" id="delete_leavetype" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Delete Leave Type</h3>
								<p>Are you sure want to delete?</p>
							</div>
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
										<a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
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
			<!-- /Delete Leavetype Modal -->

		</div>
		<!-- /Page Wrapper -->

	</div>
	<!-- /Main Wrapper -->

@endsection