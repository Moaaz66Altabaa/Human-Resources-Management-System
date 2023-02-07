@extends('employee_layout')
@section('nav-bar-item')
<li><a href="{{ route('employee.dashboard') }}"><i class="la la-dashboard"></i> <span> Dashboard</span></a></li>
						<li class="submenu">
						
							<a href="#" class="noti-dot"><i class="la la-briefcase"></i> <span> Jobs</span> <span
									class="menu-arrow"></span></a>
							<ul style="display: none;">
								

								<li><a href="{{ route('employee.departments.index') }}">Departments</a></li>
								<li><a href="{{ route('employee.jobs.index') }}">job</a></li>

							</ul>
						</li>
						<li class="submenu">
							<a href="#" class="noti-dot"><i class="	la la-edit"></i> <span> leaves</span> <span
									class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="active" style="text-decoration: none" href="{{ route('employee.leaves.myleaves') }}">My Leaves  </a></li>
								
								<li><a href="{{ route('employee.leaves.index') }}">Leave Type</a></li>
								
							</ul>
						</li>
						<li class="submenu">
							<a href="#" class="noti-dot"><i class="	la la-calendar-o"></i> <span> Attendances</span>
								<span class="menu-arrow"></span></a>
							<ul style="display: none;">
								
								<li><a  href="{{ route('employee.attendance.my_attendance') }}">My Attendance </a></li>
								
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
									<div class="col-sm-4">
										<h3 class="page-title">Add Leave</h3>
									</div>
								</div>
							</div>
			
				
                            <form  method="post" action="{{route('employee.leaves.storeleave')}}" >
        					@csrf
							@if(Session::has('add_leave_error'))
           					 <div class="alert alert-danger">
                			{{ Session::get('add_leave_error') }}
               				 @php
                    		Session::forget('add_leave_error');
                			@endphp
            				</div>
        					@endif

       						 @if(Session::has('invalid_date_error'))
            				<div class="alert alert-danger">
                			{{ Session::get('invalid_date_error') }}
                			@php
                    		Session::forget('invalid_date_error');
                			@endphp
            				</div>
        					@endif

								<div class="form-group">
									<label>Leave Type <span class="text-danger"></span></label>
									<select name="leave_id" class="select">
										<option>Select Leave Type</option>
										@foreach($leaves as $leave)
										<option  value="{{$leave->id}} ">{{$leave->name}}</option>
										@endforeach
									</select>
								</div>
								@error('leave_id')
       								<p style="color: red"> {{ $message }} </p>
        							<br>
        						@enderror
								<div class="form-group">
									<label for="from">From<span class="text-danger"></span></label>
										<input type="date" class="form-control" name="from" value="{{ old('from') }}" required>	
								</div>
								<br>
									@error('from')
      								  <p style="color: red"> {{ $message }} </p>
        								<br>
        							@enderror
								<div class="form-group">
									<label  for="to">To<span class="text-danger"></span></label>
									<input type="date" class="form-control" name="to" value="{{ old('to') }}" required>	
									@error('to')
      								  <p style="color: red"> {{ $message }} </p>
        								<br>
        							@enderror
								</div>
									<br>

       							@error('to')
       							 <p style="color: red"> {{ $message }} </p>
        							<br>
        						@enderror
							
								<div class="form-group">
									<label for="reason">Leave Reason <span class="text-danger"></span></label>
									<textarea rows="4" type="text" name="reason"  class="form-control" style=" @error('reason') border: red solid 2px @enderror" value="{{ old('reason') }}" required></textarea>
								</div>
								<br>

        						@error('reason')
        							<p style="color: red"> {{ $message }} </p>
       								 <br>
       							@enderror
								<div class="submit-section">
									<button  type="submit" class="btn btn-primary submit-btn">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /Add Employee Modal -->
            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->
@endsection	
	