<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Smarthr - Bootstrap Admin Template">
    <meta name="keywords"
          content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>MainPower </title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/HR_Logo.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">

    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="/assets/css/line-awesome.min.css">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="/assets/css/select2.min.css">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">


</head>

<body>
<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Header -->
    <div class="header">

        <!-- Logo -->
        <div class="header-left">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="/assets/img/HR_Logo.png" width="60px"  alt="">
            </a>
        </div>
        <!-- /Logo -->

        <a id="toggle_btn" href="javascript:void(0);">
				<span class="bar-icon">
					<span></span>
					<span></span>
					<span></span>
				</span>
        </a>

        <!-- Header Title -->
        <div class="page-title-box">
            <h3>Menpower</h3>
        </div>
        <!-- /Header Title -->

        <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

        <!-- Header Menu -->
        <ul class="nav user-menu">




            <!-- Notifications -->
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" onclick="{{ auth()->user()->unReadNotifications->markAsRead() }}">
                    @if(auth()->user()->unReadNotifications->isEmpty())
                    <i class="fa fa-bell-o"></i> <span class="badge badge-pill"></span>
                    @else
                    <i class="fa fa-bell-o"></i> <span class="badge badge-pill">{{ auth()->user()->unReadNotifications->count() }}</span>
                    @endif
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            @foreach(auth()->user()->notifications as $notification)
                            <li class="notification-message">
                                <a href="">
                                    <div class="media">
											<span class="avatar">
												<img alt="" src="{{ asset('images/' . $notification->data['image_path'] ) }}">
											</span>
                                        <div class="media-body">
                                            <p class="noti-details"><span class="noti-title">{{ $notification->data['employee_name'] }}</span>
                                                {{ $notification->data['description'] }} <span class="noti-title">
													</span></p>
                                            <p class="noti-time"><span class="notification-time">{{ $notification->created_at }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach

                            <div class="topnav-dropdown-footer">
                                <a href="{{ route('admin.activities.index') }}">View all Notifications</a>
                            </div>
                    </div>
            </li>
            <!-- /Notifications -->



            <li class="nav-item dropdown has-arrow main-drop">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <span class="user-img"><img src="{{ asset('images/' . auth()->user()->image_path) }}" alt=""></span>
                    <!-- <span class="status online"></span> -->
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('admin.profile.index' , auth()->user()->id) }}">My Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <!-- /Header Menu -->

        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                    class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('admin.profile.index' , auth()->user()->id) }}">My Profile</a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>            </div>
        </div>
        <!-- /Mobile Menu -->

    </div>
    <!-- /Header -->

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>Menpower</span>
                    </li>

                    <!-- *************  يلي عم يتغير بالسايد بار ************ -->
                  @yield('navbar_items')
                    <!-- لهون  -->
                </ul>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->



</div>
<!-- /Main Wrapper -->

@yield('content')

<!-- jQuery -->
<script src="/assets/js/jquery-3.5.1.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<!-- Slimscroll JS -->
<script src="/assets/js/jquery.slimscroll.min.js"></script>

<!-- Select2 JS -->
<script src="/assets/js/select2.min.js"></script>

<!-- Datetimepicker JS -->
<script src="/assets/js/moment.min.js"></script>
<script src="/assets/js/bootstrap-datetimepicker.min.js"></script>

<!-- Datatable JS -->
<script src="/assets/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/dataTables.bootstrap4.min.js"></script>

<!-- Custom JS -->
<script src="/assets/js/app.js"></script>


</body>
</html>

