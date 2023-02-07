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
            <li><a class="active" style="text-decoration: none" href="{{ route('admin.leaves.index') }}"> Employees Leaves </a></li>
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
							<h3 class="page-title">Leaves</h3>

						</div>
						<div class="col-auto float-right ml-auto">
							<a href="{{ route('admin.leaves.addleave') }}" class="btn add-btn" ><i
									class="fa fa-plus"></i> Add Leave</a>
						</div>

					</div>
				</div>
				<!-- /Page Header -->

				<!-- Leave Statistics -->
				<div class="row">
					<div class="col-md-3">
						<div class="stats-info">
							<h6>Today Leaves</h6>
							<h4>{{ $approved_leaves->count() }}</h4>
						</div>
					</div>

					<div class="col-md-3">
						<div class="stats-info">
							<h6>Pending Requests</h6>
							<h4>{{ $pending_leaves->count() }}</h4>
						</div>
					</div>
				</div>
				<!-- /Leave Statistics -->

				<!-- Search Filter -->
				<div class="row filter-row">
					<div class="col-sm-3">
						<div class="form-group form-focus">
                            <form id="search-leave-form" method="post" action="{{ route('admin.leaves.search') }}">
                                @csrf
							    <input id="employee_name" name="employee_name" type="text" class="form-control floating">
							    <label class="focus-label">Employee Name</label>

                        </div>
					</div>
					<div class="col-sm-3">
						<div class="form-group form-focus select-focus">
                                <select id="leave_name" name="leave_name" class="select floating">
                                    <option value="" > -- Select -- </option>
                                    @foreach($leaves as $leave)
                                        <option value="{{ $leave->name }}"> {{ $leave->name }} </option>
                                    @endforeach
                                </select>
							<label class="focus-label">Leave Type</label>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group form-focus select-focus">
							<select id="status" name="status" class="select floating">
                                <option value="" > -- Select -- </option>
                                <option value="pending"> Pending </option>
								<option value="approved"> Approved </option>
							</select>
							<label class="focus-label">Leave Status</label>
						</div>
                        </form>
                    </div>


					<div class="col-sm-3">
						<a class="btn btn-success btn-block" href="{{ route('admin.leaves.search') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('search-leave-form').submit();" > Search </a>
					</div>
				</div>
				<!-- /Search Filter -->

				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table mb-0 datatable">
								<thead>
									<tr>
										<th>Employee</th>
										<th>Leave Type</th>
										<th>From</th>
										<th>To</th>
										<th>Number of Days</th>
										<th>Reason</th>
										<th class="text-center">Status</th>
										<th >Action</th>
										<!-- <th class="text-right">Actions</th> -->
									</tr>
								</thead>
                                @if(Session::has('search_return_employees'))
                                    @foreach( Session::get('search_return_employees')  as $employee)
                                        @foreach($employee->leaves()->get() as $leave)
                                        <tbody>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="{{ route('admin.profile.index' , $employee->id) }}" class="avatar"><img alt=""
                                                                                                  src="{{ asset('images/'.App\Models\User::find($leave->pivot->user_id)->image_path) }}"></a>
                                                    <a href="{{ route('admin.profile.index' , $employee->id) }}">{{ App\Models\User::find($leave->pivot->user_id)->first_name }} <span>{{App\Models\User::find($leave->pivot->user_id)->job->name}}</span></a>
                                                </h2>
                                            </td>
                                            <td>{{ App\Models\Leave::find($leave->pivot->leave_id)->name }}</td>
                                            <td>{{ $leave->pivot->from }}</td>
                                            <td>{{ $leave->pivot->to }}</td>
                                            <td>{{ $leave->pivot->days }}</td>
                                            <td> {{$leave->pivot->reason}} </td>
                                            <td class="text-center">

                                            <div class="dropdown action-label">
                                                @if($leave->pivot->status == 'approved')
                                                    <i class="fa fa-dot-circle-o text-purple"></i> {{ $leave->pivot->status }}
                                                @else
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                       data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-purple"></i> Pending
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">

                                                        <form method="post" action="{{ route('admin.leaves.approve' , $leave->pivot->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="approved">
                                                            <input class="dropdown-item" class="fa fa-dot-circle-o text-success" type="submit" value="Approve">
                                                        </form>

                                                        <form method="post" action="{{ route('admin.leaves.approve' , $leave->pivot->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="declined">
                                                            <input class="dropdown-item" class="fa fa-dot-circle-o text-success" type="submit" value="Decline">
                                                        </form>
                                                    </div>
                                                @endif


                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                           aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    @if($leave->pivot->status == 'approved')
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                               data-target="#delete_approve" onclick="saveId({{$leave->pivot->id}})"><i
                                                                    class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        </div>

                                                    </div>
                                                </td>
                                            @endif

                                            </div>
                                            </td>

                                        </tbody>
                                        @endforeach
                                    @endforeach

                                @elseif(Session::has('search_return_leaves'))
                                    @foreach( Session::get('search_return_leaves')  as $leave)
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ route('admin.profile.index' , $leave->user_id) }}" class="avatar"><img alt=""
                                                                                              src="{{ asset('images/'.App\Models\User::find($leave->user_id)->image_path) }}"></a>
                                                <a href="{{ route('admin.profile.index' , $leave->user_id) }}">{{ App\Models\User::find($leave->user_id)->first_name }} <span>{{App\Models\User::find($leave->user_id)->job->name}}</span></a>
                                            </h2>
                                        </td>
                                        <td>{{ App\Models\Leave::find($leave->leave_id)->name }}</td>
                                        <td>{{ $leave->from }}</td>
                                        <td>{{ $leave->to }}</td>
                                        <td>{{ $leave->days }}</td>
                                        <td> {{$leave->reason}} </td>
                                        <td class="text-center">

                                        <div class="dropdown action-label">

                                            @if($leave->status == 'approved')
                                                    <i class="fa fa-dot-circle-o text-purple"></i> {{ $leave->status }}
                                            @else
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                       data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-purple"></i> Pending
                                                    </a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <form method="post" action="{{ route('admin.leaves.approve' , $leave->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <input class="dropdown-item" class="fa fa-dot-circle-o text-success" type="submit" value="Approve">
                                                </form>

                                                <form method="post" action="{{ route('admin.leaves.approve' , $leave->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="declined">
                                                    <input class="dropdown-item" class="fa fa-dot-circle-o text-success" type="submit" value="Decline">
                                                </form>
                                                </div>
                                            @endif

                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                @if($leave->status == 'approved')

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                           data-target="#delete_approve" onclick="saveId({{$leave->id}})"><i
                                                                class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>

                                            </div>
                                        </td>
                                      @endif
                                            </div>
                                        </td>

                                    </tbody>
                                    @endforeach

                                @elseif(Session::has('search_return_leaves_pivot'))
                                    @foreach( Session::get('search_return_leaves_pivot')  as $leave)
                                    <tbody>
                                    <tr>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ route('admin.profile.index' , $leave->pivot->user_id) }}" class="avatar"><img alt=""
                                                                                              src="{{ asset('images/'.App\Models\User::find($leave->pivot->user_id)->image_path) }}"></a>
                                                <a href="{{ route('admin.profile.index' , $leave->pivot->user_id) }}">{{ App\Models\User::find($leave->user_id)->first_name }} <span>{{App\Models\User::find($leave->user_id)->job->name}}</span></a>
                                            </h2>
                                        </td>
                                        <td>{{ App\Models\Leave::find($leave->leave_id)->name }}</td>
                                        <td>{{ $leave->from }}</td>
                                        <td>{{ $leave->to }}</td>
                                        <td>{{ $leave->days }}</td>
                                        <td> {{$leave->reason}} </td>
                                        <td class="text-center">

                                        <div class="dropdown action-label">

                                            @if($leave->status == 'approved')
                                                    <i class="fa fa-dot-circle-o text-purple"></i> {{ $leave->status }}
                                            @else
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                       data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-purple"></i> Pending
                                                    </a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <form method="post" action="{{ route('admin.leaves.approve' , $leave->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <input class="dropdown-item" class="fa fa-dot-circle-o text-success" type="submit" value="Approve">
                                                </form>

                                                <form method="post" action="{{ route('admin.leaves.approve' , $leave->id) }}">
                                                    @csrf
                                                    <input type="hidden" name="status" value="declined">
                                                    <input class="dropdown-item" class="fa fa-dot-circle-o text-success" type="submit" value="Decline">
                                                </form>
                                                </div>
                                            @endif

                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>

                                                @if($leave->status == 'approved')
                                                <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                           data-target="#delete_approve" onclick="saveId({{$leave->id}})"><i
                                                                class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>

                                            </div>
                                           </td>
                                       @endif

                                            </div>
                                        </td>

                                    </tbody>
                                    @endforeach

                                @else
                                    @foreach($pending_leaves as $pleave)
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="{{ route('admin.profile.index' , $pleave->user_id) }}" class="avatar"><img alt=""
                                                                                                  src="{{ asset('images/'.App\Models\User::find($pleave->user_id)->image_path) }}"></a>
                                                    <a href="{{ route('admin.profile.index' , $pleave->user_id) }}">{{ App\Models\User::find($pleave->user_id)->first_name }} <span>{{App\Models\User::find($pleave->user_id)->job->name}}</span></a>
                                                </h2>
                                            </td>
                                            <td>{{ App\Models\Leave::find($pleave->leave_id)->name }}</td>
                                            <td>{{ $pleave->from }}</td>
                                            <td>{{ $pleave->to }}</td>
                                            <td>{{ $pleave->days }}</td>
                                            <td> {{$pleave->reason}} </td>
                                            <td class="text-center">
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-dot-circle-o text-purple"></i> Pending
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- <a class="dropdown-item" href="#"><i
                                                                class="fa fa-dot-circle-o text-purple"></i> New</a> -->
                                                        <form method="post" action="{{ route('admin.leaves.approve' , $pleave->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="approved">
                                                            <input class="dropdown-item" class="fa fa-dot-circle-o text-success" type="submit" value="Approve">
                                                        </form>

                                                        <form method="post" action="{{ route('admin.leaves.approve' , $pleave->id) }}">
                                                            @csrf
                                                            <input type="hidden" name="status" value="declined">
                                                            <input class="dropdown-item" class="fa fa-dot-circle-o text-success" type="submit" value="Decline">
                                                        </form>

                                                        <td class="text-right">
                                                            <div class="dropdown dropdown-action">
                                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                                   aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                                @if($leave->status == 'approved')

                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                                           data-target="#delete_approve" onclick="saveId({{$leave->id}})"><i
                                                                                class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                                    </div>
                                                            </div>
                                                        </td>
                                                      @endif


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
{{--			<!-- Add Leave Modal -->--}}
{{--			<div id="add_leave" class="modal custom-modal fade" role="dialog">--}}
{{--				<div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--					<div class="modal-content">--}}
{{--						<div class="modal-header">--}}
{{--							<h5 class="modal-title">Add Leave</h5>--}}
{{--							<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--								<span aria-hidden="true">&times;</span>--}}
{{--							</button>--}}
{{--						</div>--}}
{{--						<div class="modal-body">--}}
{{--							<form>--}}
{{--								<div class="form-group">--}}
{{--									<label> Name Employee <span class="text-danger"></span></label>--}}
{{--									<input class="form-control" type="text">--}}
{{--								</div>--}}
{{--								<div class="form-group">--}}
{{--									<label>Leave Type <span class="text-danger"></span></label>--}}
{{--									<select class="select">--}}
{{--										<option>Select Leave Type</option>--}}
{{--										<option>Medical Leave</option>--}}
{{--										<option>Leave Unpaid </option>--}}
{{--										<option>Leave with Pay</option>--}}
{{--									</select>--}}
{{--								</div>--}}
{{--								<div class="form-group">--}}
{{--									<label>From <span class="text-danger"></span></label>--}}
{{--									<div class="cal-icon">--}}
{{--										<input class="form-control datetimepicker" type="text">--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="form-group">--}}
{{--									<label>To <span class="text-danger"></span></label>--}}
{{--									<div class="cal-icon">--}}
{{--										<input class="form-control datetimepicker" type="text">--}}
{{--									</div>--}}
{{--								</div>--}}
{{--								<div class="form-group">--}}
{{--									<label>Number of days <span class="text-danger"></span></label>--}}
{{--									<input class="form-control" readonly type="text">--}}
{{--								</div>--}}
{{--								<div class="form-group">--}}
{{--									<label>Remaining Leaves <span class="text-danger"></span></label>--}}
{{--									<input class="form-control" readonly value="35" type="text">--}}
{{--								</div>--}}
{{--								<div class="form-group">--}}
{{--									<label>Leave Reason <span class="text-danger"></span></label>--}}
{{--									<textarea rows="4" class="form-control"></textarea>--}}
{{--								</div>--}}
{{--								<div class="submit-section">--}}
{{--									<button class="btn btn-primary submit-btn">Submit</button>--}}
{{--								</div>--}}
{{--							</form>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--			<!-- /Add Leave Modal -->--}}



			<!-- Approve Leave Modal -->
			<div class="modal custom-modal fade" id="approve_leave" role="dialog">
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body">
							<div class="form-header">
								<h3>Leave Approve</h3>
								<p>Are you sure want to approve for this leave?</p>
							</div>
							<div class="modal-btn delete-action">
								<div class="row">
									<div class="col-6">
										<a href="javascript:void(0);" class="btn btn-primary continue-btn">Approve</a>
									</div>
									<div class="col-6">
										<a href="javascript:void(0);" data-dismiss="modal"
											class="btn btn-primary cancel-btn">Decline</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Approve Leave Modal -->

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
