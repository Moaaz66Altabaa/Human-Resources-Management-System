@extends('admin_layout')

@section('navbar_items')
    <li ><a href="{{ route('admin.dashboard') }}"><i class="la la-dashboard"></i> <span>Dashbord</span> </a></li>

    <li class="submenu">
        <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li ><a  href="{{ route('admin.employees.index') }}">All Employees</a></li>
            <li><a  href="{{ route('admin.departments.index') }}">Departments</a></li>
            <li><a  href="{{ route('admin.jobs.index') }}">Jobs</a></li>

        </ul>
    </li>
    <li class="submenu"><a href="#" class="noti-dot"><i class="	la la-edit"></i> <span> leaves</span> <span
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
            <li><a href="{{ route('admin.overtime.index') }}"> Employees Overtime </a></li>
            <li><a href="{{ route('admin.salaries.index') }}"> My Overtime </a></li>
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
											<a href="#"><img alt="" src="{{ asset('images/' . $employee->image_path) }}"></a>
										</div>
									</div>
									<div class="profile-basic">
										<div class="row">
											<div class="col-md-5">
												<div class="profile-info-left">
													<h3 class="user-name m-t-0 mb-0">{{$employee->first_name . ' ' .  $employee->last_name}}</h3>
                                                    <div class="staff-id">Employee ID :  {{ $employee->is_admin? 'A' : 'E' }} - {{$employee->id}}</div>
                                                    <br>
                                                    <h6 class="text-muted">Job : {{$employee->job->name}}</h6>
                                                    <h6 class="text-muted">Department : Department : {{$employee->job->department->name}}</h6>
													<h6 class="text-muted">Date of Join : {{$employee->created_at->format('y-m-d')}}</h6>

												</div>
											</div>
											<div class="col-md-7">
												<ul class="personal-info">
													<li>
														<div class="title">Phone:</div>
														<div class="text">{{$employee->mobile_number != null? $employee->mobile_number : '--' }}</div>
													</li>
													<li>
														<div class="title">Email:</div>
														<div class="text">{{$employee->email != null ? $employee->email : '--'}}</div>
													</li>

													<li>
														<div class="title">Birthday:</div>
														<div class="text">{{$employee->birth_date != null? $employee->birth_date : '--'}} </div>
													</li>

													<li>
														<div class="title">Address:</div>
														<div class="text">{{$employee->address != null? $employee->address : '--'}} </div>
													</li>

													<li>
														<div class="title">Gender:</div>
														<div class="text">{{$employee->gender != null? $employee->gender : '--'}}</div>
													</li>

												</ul>
											</div>
										</div>
									</div>
									<div class="pro-edit"><a class="edit-icon" href="{{route('admin.profile.edit_profile' , $employee->id)}}"><i class="fa fa-pencil"></i></a></div>
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
										<h3 class="card-title">Personal Informations <a href="{{route('admin.profile.edit_info' , $employee->id)}}" class="edit-icon"><i class="fa fa-pencil"></i></a></h3>
										<ul class="personal-info">


											<li>
												<div class="title">Nationality</div>
												<div  class="text">{{$employee->nationality != null? $employee->nationality : '--'}} </div>
											</li>
											<li>
												<div class="title">Hometown</div>
												<div class="text">{{$employee->hometown != null? $employee->hometown : '--'}}</div>
											</li>

											<li>
												<div class="title">Marital status</div>
												<div class="text">{{$employee->marital_status != null? $employee->marital_status : '--'}}</div>
											</li>

											<li>
												<div class="title">No. of children</div>
												<div class="text">{{ $employee->number_of_children}}</div>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-6 d-flex">
								<div class="card profile-box flex-fill">
									<div class="card-body">
										<h3 class="card-title">Emergency Contact <a href="{{route('admin.profile.edit_emergency' , $employee->id)}}" class="edit-icon"><i
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

									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 d-flex">
								<div class="card profile-box flex-fill">
									<div class="card-body">
										<h3 class="card-title">Education Informations <a href="{{route('admin.profile.edit_education' , $employee->id)}}" class="edit-icon"><i
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
										<h3 class="card-title">Experience <a  href="{{route('admin.profile.edit_experience' , $employee->id)}}" class="edit-icon"
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

	@endsection

