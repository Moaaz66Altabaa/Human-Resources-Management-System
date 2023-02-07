@extends('admin_layout')

@section('navbar_items')
    <li ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li ><a  href="{{ route('admin.employees.index') }}">All Employees</a></li>
            <li><a  href="{{ route('admin.departments.index') }}">Departments</a></li>
            <li><a  style="text-decoration: none" href="{{ route('admin.jobs.index') }}">Jobs</a></li>

        </ul>
    </li>
    <li class="submenu"><a href="#" class="noti-dot"><i class="	la la-edit"></i> <span> Leaves</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li><a  href="{{ route('admin.leaves.index') }}"> Employees Leaves </a></li>
            <li><a class="active"  style="text-decoration: none" href="{{ route('admin.leaves.my_leaves') }}">My Leaves </a></li>
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
        <a href="{{ route('admin.company.index') }}"><i class="la la-cog"></i> <span>Company Settings</span> </a>
    </li>
@endsection


@section('content')

    <script>
        function saveId(id){
            var id = id;
            localStorage.setItem('id' , id);
            document.getElementById('leave_id').value = id;
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
							<h3 class="page-title">My Leaves</h3>

						</div>
						<div class="col-auto float-right ml-auto">
							<a href="{{ route('admin.leaves.my_leaves_addleave') }}" class="btn add-btn" ><i
									class="fa fa-plus"></i> Add Leave</a>
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<!-- Leave Statistics -->
				<div class="row">
					<div class="col-md-3">
						<div class="stats-info">
							<h6>Total Leave (days)</h6>
							<h4>{{ $total_leaves }}</h4>
						</div>
					</div>
					<!-- <div class="col-md-3">
						<div class="stats-info">
							<h6>Medical Leave</h6>
							<h4> 1 </h4>
						</div>
					</div> -->
					<div class="col-md-3">
						<div class="stats-info">
							<h6> Unpaid leaves</h6>
							<h4>{{ $unpaid_leaves->count() }}</h4>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stats-info">
							<h6>Paid leaves</h6>
							<h4>{{ $paid_leaves->count() }}</h4>
						</div>
					</div>
					<div class="col-md-3">
						<div class="stats-info">
							<h6>Remaining Leaves (days)</h6>
							<h4>{{ $remaining_leaves }}</h4>
						</div>
					</div>
				</div>
				<!-- /Leave Statistics -->

				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table mb-0 datatable">
								<thead>
									<tr>
										<th>Leave Type</th>
										<th>From</th>
										<th>To</th>
										<th>Number of Days</th>
										<th>Reason</th>
										<th class="text-center">Status</th>
										<!-- <th>Approved by</th> -->
										<th class="text-right">Actions</th>
									</tr>
								</thead>
								@foreach($leaves as $leave)
                                    <tbody>
                                    <tr>
                                        <td>{{ $leave->name }}</td>
                                        <td>{{ $leave->pivot->from }}</td>
                                        <td>{{ $leave->pivot->to }}</td>
                                        <td>{{ $leave->pivot->days }}</td>
                                        <td>{{ $leave->pivot->reason }}</td>
                                        <td class="text-center">
                                            <div class="action-label">
                                                <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                                    <i class="fa fa-dot-circle-o text-purple"></i> {{ $leave->pivot->status }}
                                                </a>
                                            </div>
                                        </td>

                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                                       data-target="#delete_approve" onclick="saveId({{$leave->pivot->id}})"><i
                                                            class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                                        <a href="javascript:void(0);" class="btn btn-primary continue-btn" href="{{ route('admin.leaves.deleteleave') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('delete-leave-form').submit();" >Delete</a>

                                        <form id="delete-leave-form" action="{{ route('admin.leaves.deleteleave') }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                            <input name="leave_id" type="hidden" id="leave_id" >

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
