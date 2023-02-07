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
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Experience</h3>
                    </div>
                </div>
            </div>
            
            <div>

                    @if(Session::has('new'))
                    <form method="post" action="{{route('employee.employee.store_experience') }}" >
                        @csrf

                    <div>
                        <div class="card-body">
                            <h3 class="card-title">Experience Informations  </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input  name="company" type="text" class="form-control floating"
                                                    value="{{old('company')}}" required>
                                            <label for="company"class="focus-label">Company Name</label>
                                            @error('company')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input name="location" type="text" class="form-control floating" value="{{old('location')}}" required>
                                            <label for="location" class="focus-label">Location</label>
                                            @error('location')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input name="position" type="text" class="form-control floating"
                                                   value="{{old('position')}}" required>
                                            <label for="position" class="focus-label">Job Position</label>
                                            @error('position')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input name="from" type="date" class="form-control"
                                                   value="{{old('from')}}" required>
                                            <label for="from" class="focus-label">From</label>
                                            @error('from')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input name="to" type="date" class="form-control"
                                                   value="{{old('to')}}" required>
                                            <label for="from" class="focus-label">To</label>
                                            @error('to')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                         </div>
                        </div>
                        <div class="submit-section">
                            <input type="submit" value="Add" class="btn btn-primary submit-btn">
                        </div>
                    </form>

                        @foreach($employee->experiences()->get() as $experience)

                            <form id="delete-experience-form" method="post" action="{{ route('employee.employee.delete_experience' , $experience->id) }}">
                                @csrf
                                @method('DELETE')
                            </form>

                            <a href="{{ route('employee.employee.delete_experience' , $experience->id) }}"
                               class="delete-icon" onclick="event.preventDefault();
                        document.getElementById('delete-experience-form').submit();"><i class="fa fa-trash-o"></i></a>

                            <form method="post" action="{{route('employee.employee.update_experience' , $experience->id)}}" >
                                @csrf
                                @method('PUT')


                                <div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input  name="company" type="text" class="form-control floating"
                                                            value="{{ $experience->company  }}" required>
                                                    <label for="company"class="focus-label">Company Name</label>
                                                    @error('company')
                                                    <p style="color: red"> {{ $message }} </p>
                                                    <br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input name="location" type="text" class="form-control floating" value="{{ $experience->location }}" required>
                                                    <label for="location" class="focus-label">Location</label>
                                                    @error('location')
                                                    <p style="color: red"> {{ $message }} </p>
                                                    <br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input name="position" type="text" class="form-control floating"
                                                           value="{{ $experience->position }}" required>
                                                    <label for="position" class="focus-label">Job Position</label>
                                                    @error('position')
                                                    <p style="color: red"> {{ $message }} </p>
                                                    <br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input name="from" type="date" class="form-control"
                                                           value="{{ $experience->from }}" required>
                                                    <label for="from" class="focus-label">From</label>
                                                    @error('from')
                                                    <p style="color: red"> {{ $message }} </p>
                                                    <br>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group form-focus">
                                                    <input name="to" type="date" class="form-control"
                                                           value="{{ $experience->to }}" required>
                                                    <label for="from" class="focus-label">To</label>
                                                    @error('to')
                                                    <p style="color: red"> {{ $message }} </p>
                                                    <br>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                    <div class="submit-section">
                                        <input type="submit" value="Save" class="btn btn-primary submit-btn">
                                    </div>
                                @endforeach
                            </form>


                @elseif($employee->experiences()->get()->isEmpty())
                    <form method="post" action="{{route('employee.employee.store_experience' )}}" >
                        @csrf

                    <div>
                        <div class="card-body">
                            <h3 class="card-title">Experience Informations  </h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input  name="company" type="text" class="form-control floating"
                                                    value="{{old('company')}}" required>
                                            <label for="company"class="focus-label">Company Name</label>
                                            @error('company')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input name="location" type="text" class="form-control floating" value="{{old('location')}}" required>
                                            <label for="location" class="focus-label">Location</label>
                                            @error('location')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input name="position" type="text" class="form-control floating"
                                                   value="{{old('position')}}" required>
                                            <label for="position" class="focus-label">Job Position</label>
                                            @error('position')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input name="from" type="date" class="form-control"
                                                   value="{{old('from')}}" required>
                                            <label for="from" class="focus-label">From</label>
                                            @error('from')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input name="to" type="date" class="form-control"
                                                   value="{{old('to')}}" required>
                                            <label for="from" class="focus-label">To</label>
                                            @error('to')
                                            <p style="color: red"> {{ $message }} </p>
                                            <br>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                         </div>
                        <div class="add-more">
                            <a href="{{ route('employee.employee.create_experience' ) }}"><i class="fa fa-plus-circle"></i> Add
                                More</a>
                        </div>

                        <div class="submit-section">
                            <input type="submit" value="Add" class="btn btn-primary submit-btn">
                        </div>
                    </form>

                    @else

                        @foreach($employee->experiences()->get() as $experience)

                        <form id="delete-experience-form" method="post" action="{{ route('employee.employee.delete_experience' , $experience->id) }}">
                            @csrf
                            @method('DELETE')
                        </form>

                        <a href="{{ route('employee.employee.delete_experience' , $experience->id) }}"
                        class="delete-icon" onclick="event.preventDefault();
                        document.getElementById('delete-experience-form').submit();"><i class="fa fa-trash-o"></i></a>

                        <form method="post" action="{{route('employee.employee.update_experience' , $experience->id)}}" >
                            @csrf
                            @method('PUT')



                            <div>
                                <div class="card-body">
                                    <h3 class="card-title">Experience Informations
                                       </h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input  name="company" type="text" class="form-control floating"
                                                        value="{{ $experience->company  }}" required>
                                                <label for="company"class="focus-label">Company Name</label>
                                                @error('company')
                                                <p style="color: red"> {{ $message }} </p>
                                                <br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input name="location" type="text" class="form-control floating" value="{{ $experience->location }}" required>
                                                <label for="location" class="focus-label">Location</label>
                                                @error('location')
                                                <p style="color: red"> {{ $message }} </p>
                                                <br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input name="position" type="text" class="form-control floating"
                                                       value="{{ $experience->position }}" required>
                                                <label for="position" class="focus-label">Job Position</label>
                                                @error('position')
                                                <p style="color: red"> {{ $message }} </p>
                                                <br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input name="from" type="date" class="form-control"
                                                       value="{{ $experience->from }}" required>
                                                <label for="from" class="focus-label">From</label>
                                                @error('from')
                                                <p style="color: red"> {{ $message }} </p>
                                                <br>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <input name="to" type="date" class="form-control"
                                                       value="{{ $experience->to }}" required>
                                                <label for="from" class="focus-label">To</label>
                                                @error('to')
                                                <p style="color: red"> {{ $message }} </p>
                                                <br>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="add-more">
                                    <a href="{{ route('employee.employee.create_experience' ) }}"><i class="fa fa-plus-circle"></i> Add
                                        More</a>
                                </div>

                                <div class="submit-section">
                                    <input type="submit" value="Save" class="btn btn-primary submit-btn">
                                </div>
                            @endforeach
                        </form>

                    @endif
                  </div>
                        </div>

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
   