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
									<div class="col-sm-4">
										<h3 class="page-title"></h3>
									</div>
								</div>
							</div>


                            <form method="post" action="{{route('employee.employee.update_profile' )}}" enctype="multipart/form-data">
        						@csrf
        						@method('PUT')

								<div class="row">
									<div class="col-md-12">
										<div class="profile-img-wrap edit-img">
											<img class="inline-block" src="{{asset('images/'.$employee->image_path)}}" alt="user">
											<div class="fileupload btn">
												<span class="btn-text">edit</span>
												<input  name="image" class="upload" type="file" value="{{ asset('images/' . $employee->image_path) }}">
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="first_name">First Name</label>
													<input type="text" name="first_name" class="form-control"    readonly value="{{$employee->first_name}}" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label for="last_name">Last Name</label>
													<input  name="last_name" type="text" class="form-control"   readonly value="{{$employee->last_name}}" required>
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label for="email">Email</label>
													<input name="email" type="email" class="form-control"  style=" @error('email') border: red solid 2px @enderror" value="{{ $employee->email }}" required>
													@error('email')
       										 <p style="color: red"> {{ $message }} </p>
       										 <br>
        										@enderror
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label for="password">Paasword</label>
													<input  class="form-control" type="password"  name="password"  required>
													@error('password')
        										    <p style="color: red"> {{ $message }} </p>
       											    <br>
       										        @enderror
												</div>
											</div>

											<div class="col-md-6">
												<div class="form-group">
													<label>Birth Date</label>
													<input type="date" class="form-control"  name="birth_date" value="{{$employee->birth_date}}"  required>
													@error('birth_date')
        										    <p style="color: red"> {{ $message }} </p>
       											    <br>
       										        @enderror
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Gender</label>
													<select   name="gender" class="select form-control">
													    <option  value="">gender</option>
														<option {{$employee->gender=='male'? 'selected':''}} value="male">Male</option>
														<option {{$employee->gender=='female'?'selected':''}} value="female">Female</option>
													</select>
												</div>

											</div>




									<div class="col-md-6">
										<div class="form-group">
											<label>Address</label>
											 <input  name="address" type="text" class="form-control"   value="{{$employee->address}}" required>
										     	@error('address')
        										    <p style="color: red"> {{ $message }} </p>
       											    <br>
       										        @enderror
										</div>
									</div>


									<div class="col-md-6">
										<div class="form-group">
											<label>Phone Number</label>
											<input type="text" name="mobile_number"class="form-control"  value="{{$employee->mobile_number}}" required>
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Job </label>
											<input type="text" class="form-control"  value="{{$employee->job->name}}" readonly>
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
        </div>
		<!-- /Main Wrapper -->
		@endsection
