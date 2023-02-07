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
		
		<!-- /Sidebar -->
		<!-- Page Wrapper -->
		<!-- Page Wrapper -->
		<div class="page-wrapper">

			<!-- Page Content -->
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Profile</h3>

						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<div class="card mb-0">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="profile-view">
									<div class="profile-img-wrap">
										<div class="profile-img">
											<a href="#"><img alt="" src="{{asset('images/'.$employee->image_path)}}"></a>
										</div>
									</div>
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-5">
												<div class="profile-info-left">
													<h3 class="user-name m-t-0 mb-0">{{$employee->first_name}}-{{$employee->last_name}}</h3>
													<div class="staff-id">Employee ID :  {{ $employee->is_admin? 'A' : 'E' }}-{{$employee->id}}</div>
													<br>
													<h6 class="text-muted">Job:{{$employee->job->name}}</h6>
													<h6 class="text-muted">Department:{{$department->name}}</h6>				
													<h6 class="small doj text-muted">Date of Join : {{$employee->created_at->format('y-m-d')}}</h6>

												</div>
											</div>
											<div class="col-md-7">
												<ul class="personal-info">
													<li>
														<div class="title">Phone:</div>
														<div class="text">{{$employee->mobile_number}}</div>
													</li>
													<li>
														<div class="title">Email:</div>
														<div class="text">{{$employee->email}}</div>
													</li>
													
													<!-- <li>
														<div class="title">Password:</div>
														<div class="text">{{$employee->password}}</div>
													</li> -->
													<li>
														<div class="title">Birthday:</div>
														<div class="text">{{$employee->birth_date}} </div>
													</li>
													
													<li>
														<div class="title">Address:</div>
														<div class="text">{{$employee->address}} </div>
													</li>
													
													<li>
														<div class="title">Gender:</div>
														<div class="text">{{$employee->gender}}</div>
													</li>
													
												</ul>
											</div>
										</div>
									</div>
									<div class="pro-edit"><a class="edit-icon" href="{{route('employee.employee.edit_profile')}}"><i class="fa fa-pencil"></i></a></div>
								</div>
							</div>
						</div>
					</div>
				</div>



				<div class="tab-content">

					<!-- Profile Info Tab -->
					<div id="emp_profile" class="pro-overview tab-pane fade show active">
						<div class="row">
							<div class="col-md-6 col-sm-4 ">
								<div class="card profile-box flex-fill">
									<div class="card-body">
										<h3 class="card-title">Personal Informations <a href="{{route('employee.employee.edit_info')}}" class="edit-icon"><i class="fa fa-pencil"></i></a></h3>
										<ul class="personal-info">
											
											<!-- <li>
												<div class="title">Tel</div>
												<div class="text">0115133146</div>
											</li> -->
											<br>
											<li>
												<div class="title">Nationality</div>
												<div class="text">{{$employee->nationality}}</div>
											</li>
											<li>
												<div class="title">Hometown</div>
												<div class="text">{{$employee->hometown}}</div>
											</li>
											
											<li>
												<div class="title">Marital status</div>
												<div class="text">{{$employee->marital_status}}</div>
											</li>
											
											<li>
												<div class="title">No. of children</div>
												<div class="text">{{$employee->number_of_children}}</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6 d-flex">
								<div class="card profile-box flex-fill">
									<div class="card-body">
										<h3 class="card-title">Emergency Contact <a href="{{route('employee.employee.edit_emergency')}}" class="edit-icon"><i
													class="fa fa-pencil"></i></a></h3>
										<!-- <h5 class="section-title">Primary</h5> -->
										<ul class="personal-info">
											<li>
												<div class="title">Name</div>
												<div class="text">{{$employee->emergency_name}}</div>
											</li>
											<br>
											<li>
												<div class="title">Relationship</div>
												<div class="text">{{$employee->emergency_relation}}</div>
											</li>
											<br>
											<li>
												<div class="title">Phone </div>
												<div class="text">{{$employee->emergency_number}}</div>
											</li>
										</ul>
										<!-- <hr>
										<h5 class="section-title">Secondary</h5>
										<ul class="personal-info">
											<li>
												<div class="title">Name</div>
												<div class="text">Hussam Khateb</div>
											</li>
											<li>
												<div class="title">Relationship</div>
												<div class="text">Brother</div>
											</li>
											<li>
												<div class="title">Phone </div>
												<div class="text">0938646195, 094025875</div>
											</li>
										</ul> -->
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 d-flex">
								<div class="card profile-box flex-fill">
									<div class="card-body">
										<h3 class="card-title">Education Informations <a href="{{route('employee.employee.edit_education')}}" class="edit-icon"><i
													class="fa fa-pencil"></i></a></h3>
													@foreach($employee->educations as $education)
										<div class="experience-box">
											<ul class="experience-list">
												<li>
													<div class="experience-user">
														<div class="before-circle"></div>
													</div>
													<div class="experience-content">
														<div class="timeline-content">
															<a href="#/" class="name">{{$education ->university}}
															</a>
															<div>AI specialty:{{$education->speciality}}</div>
															<span class="time">from:{{$education->from}} - to:{{$education->to}}</span>
															<span class="text">degree:{{$education->degree}} - grade:{{$education->grade}}-Info:{{$education->information}}</span>
																
														</div>
													</div>
												</li>
											</ul>
										</div>
										@endforeach
									</div>
								</div>
							</div>
							<div class="col-md-6 d-flex">
								<div class="card profile-box flex-fill">
									<div class="card-body">
										<h3 class="card-title">Experience <a  href="{{route('employee.employee.edit_experience')}}" class="edit-icon"
												><i
													class="fa fa-pencil"></i></a></h3>
													
										<div class="experience-box">
											<ul class="experience-list">
											@foreach($employee->experiences as $experience)
												<li>
													<div class="experience-user">
														<div class="before-circle"></div>
													</div>
													
													<div class="experience-content">
														<div class="timeline-content">
															<a href="#/" class="name">{{$experience->company}}</a>
															<span class="time">from:{{$experience->from}}-to:{{$experience->to}}</span>
															<span class="text">Location:{{$experience->location}}-Info:{{$experience->information}}</span>
																
														</div>
													</div>
													
												</li>
												@endforeach
												
												
											</ul>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Page Wrapper -->
	
	<!-- /Main Wrapper -->
	@endsection
	
	