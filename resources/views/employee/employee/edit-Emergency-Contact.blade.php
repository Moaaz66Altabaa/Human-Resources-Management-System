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
							<a href="#" class="noti-dot"><i class="	la la-edit"></i> <span> leaves</span> <span
									class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="{{ route('employee.leaves.myleaves') }}">My Leaves  </a></li>
								
								<li><a href="{{ route('employee.leaves.index') }}">Leave Type</a></li>
								
							</ul>
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
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <!-- Page Header -->
                        <div class="page-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="page-title"> Edit Emergency-Contact </h3>
                                </div>
                            </div>
                        </div>


                        <form method="post" action="{{route('employee.employee.update_emergency' )}}" >
        						@csrf
        						@method('PUT')
                               


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergency_name">Name <span class="text-danger"></span></label>
                                        <input name="emergency_name" type="text" style=" @error('emergency_name') border: red solid 2px @enderror" class="form-control" value="{{$employee->emergency_name}}" required>
                                        @error('emergency_name')
       										 <p style="color: red"> {{ $message }} </p>
       										 <br>
        										@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergency_relation">Relationship <span class="text-danger"></span></label>
                                        <input name="emergency_relation" class="form-control" type="text" style=" @error('emergency_number') border: red solid 2px @enderror" class="form-control" value="{{$employee->emergency_relation}}" required>
                                        @error('emergency_relation')
       										 <p style="color: red"> {{ $message }} </p>
       										 <br>
        										@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emergency_number">Phone <span class="text-danger"></span></label>
                                        <input name="emergency_number"class="form-control" type="text"  style=" @error('emergency_relation') border: red solid 2px @enderror" class="form-control" value="{{$employee->emergency_number}}" required>
                                        @error('emergency_number')
       										 <p style="color: red"> {{ $message }} </p>
       										 <br>
        										@enderror
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Wrapper -->
		@endsection
   
   