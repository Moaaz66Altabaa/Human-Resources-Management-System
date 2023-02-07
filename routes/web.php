<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\admin;
use App\Http\Controllers\employee;

//-----------------------------------------------------------------------------------
Route::redirect('/' , 'employee/dashboard');
Route::redirect('/register' , '/login');
//-----------------------------------------------------------------------------------



//------------------------------Admin Routes-----------------------------------------

Route::group(['prefix' => '/admin' , 'as' => 'admin.' , 'middleware' => ['auth' , 'is_admin']] , function(){

    Route::get('/dashboard' , [admin\AdminController::class , 'index'])->name('dashboard');
    Route::put('/dashboard/check_in' , [admin\AdminController::class , 'check_in'])->name('check_in');

//-------------Profile------
    Route::get('/dashboard/admin/profile{id}' , [admin\AdminController::class , 'profile'])->name('profile.index');

    Route::get('/dashboard/admin/edit_profile{id}' , [admin\AdminController::class , 'edit_profile'])->name('profile.edit_profile');
    Route::put('/dashboard/admin/update_profile{id}' , [admin\AdminController::class , 'update_profile'])->name('profile.update_profile');

    Route::get('/dashboard/admin/edit_info{id}' , [admin\AdminController::class , 'edit_info'])->name('profile.edit_info');
    Route::put('/dashboard/admin/update_info{id}' , [admin\AdminController::class , 'update_info'])->name('profile.update_info');

    Route::get('/dashboard/admin/edit_emergency{id}' , [admin\AdminController::class , 'edit_emergency'])->name('profile.edit_emergency');
    Route::put('/dashboard/admin/update_emergency{id}' , [admin\AdminController::class , 'update_emergency'])->name('profile.update_emergency');

    Route::get('/dashboard/admin/edit_experience{id}' , [admin\AdminController::class , 'edit_experience'])->name('profile.edit_experience');
    Route::get('/dashboard/admin/create_experience{id}' , [admin\AdminController::class , 'create_experience'])->name('profile.create_experience');
    Route::post('/dashboard/admin/create_experience{id}' , [admin\AdminController::class , 'store_experience'])->name('profile.store_experience');
    Route::put('/dashboard/admin/update_experience{id}' , [admin\AdminController::class , 'update_experience'])->name('profile.update_experience');
    Route::delete('/dashboard/admin/delete_experience{id}' , [admin\AdminController::class , 'delete_experience'])->name('profile.delete_experience');

    Route::get('/dashboard/admin/edit_education{id}' , [admin\AdminController::class , 'edit_education'])->name('profile.edit_education');
    Route::get('/dashboard/admin/create_education{id}' , [admin\AdminController::class , 'create_education'])->name('profile.create_education');
    Route::post('/dashboard/admin/create_education{id}' , [admin\AdminController::class , 'store_education'])->name('profile.store_education');
    Route::put('/dashboard/admin/update_education{id}' , [admin\AdminController::class , 'update_education'])->name('profile.update_education');
    Route::delete('/dashboard/admin/delete_education{id}' , [admin\AdminController::class , 'delete_education'])->name('profile.delete_education');

//-------------Departments------
    Route::get('/dashboard/departments' , [admin\DepartmentController::class , 'index'])->name('departments.index');
    Route::get('/dashboard/departments/create' , [admin\DepartmentController::class , 'create'])->name('departments.create');
    Route::post('/dashboard/departments/create' , [admin\DepartmentController::class , 'store'])->name('departments.store');
//    Route::get('/dashboard/departments/{id}' , [admin\DepartmentController::class , 'show'])->name('departments.show');
    Route::get('/dashboard/departments/{id}/edit' , [admin\DepartmentController::class , 'edit'])->name('departments.edit');
    Route::put('/dashboard/departments/{id}/edit' , [admin\DepartmentController::class , 'update'])->name('departments.update');
    Route::delete('/dashboard/departments/delete' , [admin\DepartmentController::class , 'delete'])->name('departments.delete');
//-------------Jobs------------
    Route::get('/dashboard/jobs' , [admin\JobController::class , 'index'])->name('jobs.index');
    Route::get('/dashboard/jobs/create' , [admin\JobController::class , 'create'])->name('jobs.create');
    Route::post('/dashboard/jobs/create' , [admin\JobController::class , 'store'])->name('jobs.store');
//    Route::get('/dashboard/jobs/{id}' , [admin\JobController::class , 'show'])->name('jobs.show');
    Route::get('/dashboard/jobs/{id}/edit' , [admin\JobController::class , 'edit'])->name('jobs.edit');
    Route::put('/dashboard/jobs/{id}/edit' , [admin\JobController::class , 'update'])->name('jobs.update');
    Route::delete('/dashboard/jobs/delete' , [admin\JobController::class , 'delete'])->name('jobs.delete');
//-----------Employees----------
    Route::get('/dashboard/employees' , [admin\EmployeeController::class , 'index'])->name('employees.index');
    Route::get('/dashboard/employees/create' , [admin\EmployeeController::class , 'create'])->name('employees.create');
    Route::post('/dashboard/employees/search' , [admin\EmployeeController::class , 'search'])->name('employees.search');
    Route::post('/dashboard/employees/create' , [admin\EmployeeController::class , 'store'])->name('employees.store');
//    Route::get('/dashboard/employees/{id}' , [admin\EmployeeController::class , 'show'])->name('employees.show');
    Route::get('/dashboard/employees/{id}/edit' , [admin\EmployeeController::class , 'edit'])->name('employees.edit');
    Route::put('/dashboard/employees/{id}/edit' , [admin\EmployeeController::class , 'update'])->name('employees.update');
    Route::delete('/dashboard/employees/delete' , [admin\EmployeeController::class , 'delete'])->name('employees.delete');
//-----------Salaries----------
    Route::get('/dashboard/salaries' , [admin\SalaryController::class , 'index'])->name('salaries.index');
    Route::get('/dashboard/salaries/my_salary' , [admin\SalaryController::class , 'my_salary'])->name('salaries.my_salary');
    Route::get('/dashboard/salaries/create' , [admin\SalaryController::class , 'create'])->name('salaries.create');
    Route::post('/dashboard/salaries/search' , [admin\SalaryController::class , 'search'])->name('salaries.search');
    Route::post('/dashboard/salaries/create' , [admin\SalaryController::class , 'store'])->name('salaries.store');
//    Route::get('/dashboard/salaries/{id}' , [admin\SalaryController::class , 'show'])->name('salaries.show');
    Route::get('/dashboard/salaries/{id}/edit' , [admin\SalaryController::class , 'edit'])->name('salaries.edit');
    Route::put('/dashboard/salaries/{id}/edit' , [admin\SalaryController::class , 'update'])->name('salaries.update');
    Route::delete('/dashboard/salaries/delete' , [admin\SalaryController::class , 'delete'])->name('salaries.delete');
//-----------Leaves------------
    Route::get('/dashboard/leaves' , [admin\LeaveController::class , 'index'])->name('leaves.index');
    Route::get('/dashboard/leave_settings' , [admin\LeaveController::class , 'leave_settings'])->name('leaves.leave_settings');
    Route::get('/dashboard/leave_type' , [admin\LeaveController::class , 'leave_type'])->name('leaves.leave_type');
    Route::get('/dashboard/leaves/my_leaves' , [admin\LeaveController::class , 'my_leaves'])->name('leaves.my_leaves');
    Route::get('/dashboard/leaves/my_leaves/addleave' , [admin\LeaveController::class , 'my_leaves_addleave'])->name('leaves.my_leaves_addleave');
    Route::post('/dashboard/my_leaves/addleave' , [admin\LeaveController::class , 'my_leaves_storeleave'])->name('leaves.my_leaves_storeleave');
    Route::get('/dashboard/leaves/addleave' , [admin\LeaveController::class , 'addleave'])->name('leaves.addleave');
    Route::post('/dashboard/leaves/addleave' , [admin\LeaveController::class , 'storeleave'])->name('leaves.storeleave');
    Route::get('/dashboard/leaves/create' , [admin\LeaveController::class , 'create'])->name('leaves.create');
    Route::post('/dashboard/leaves/create' , [admin\LeaveController::class , 'store'])->name('leaves.store');
    Route::post('/dashboard/leaves/search' , [admin\LeaveController::class , 'search'])->name('leaves.search');
//    Route::post('/dashboard/leaves/search_leave_type' , [admin\LeaveController::class , 'search_leave_type'])->name('leaves.search_leave_type');
    Route::post('/dashboard/leaves{leave_id}' , [admin\LeaveController::class , 'approve'])->name('leaves.approve');
//    Route::get('/dashboard/leaves/{id}' , [admin\LeaveController::class , 'show'])->name('leaves.show');
    Route::get('/dashboard/leaves/{id}/edit' , [admin\LeaveController::class , 'edit'])->name('leaves.edit');
    Route::put('/dashboard/leaves/{id}/edit' , [admin\LeaveController::class , 'update'])->name('leaves.update');
    Route::put('/dashboard/leaves/{id}/edit-settings' , [admin\LeaveController::class , 'updateLeaveSettings'])->name('leaves.updateLeaveSettings');
    Route::delete('/dashboard/leaves/delete' , [admin\LeaveController::class , 'delete'])->name('leaves.delete');
    Route::delete('/dashboard/leaves/deleteleave' , [admin\LeaveController::class , 'deleteleave'])->name('leaves.deleteleave');

//-----------attendance------------
    Route::get('/dashboard/attendance' , [admin\AttendanceController::class , 'index'])->name('attendance.index');
    Route::get('/dashboard/attendance/my_attendance' , [admin\AttendanceController::class , 'my_attendance'])->name('attendance.my_attendance');
    Route::get('/dashboard/attendance/create' , [admin\AttendanceController::class , 'create'])->name('attendance.create');
    Route::post('/dashboard/attendance/create' , [admin\AttendanceController::class , 'store'])->name('attendance.store');
    Route::post('/dashboard/attendance/search' , [admin\AttendanceController::class , 'search'])->name('attendance.search');
    Route::get('/dashboard/attendance/{attendance_id}{employee_id}' , [admin\AttendanceController::class , 'show'])->name('attendance.show');
    Route::get('/dashboard/attendance/{id}/edit' , [admin\AttendanceController::class , 'edit'])->name('attendance.edit');
    Route::put('/dashboard/attendance/{id}/edit' , [admin\AttendanceController::class , 'update'])->name('attendance.update');

//-----------Overtime------------
    Route::get('/dashboard/overtime' , [admin\OvertimeController::class , 'index'])->name('overtime.index');
    Route::get('/dashboard/overtime/my_overtime' , [admin\OvertimeController::class , 'my_overtime'])->name('overtime.my_overtime');
    Route::get('/dashboard/overtime/my_overtime_add' , [admin\OvertimeController::class , 'my_overtime_add'])->name('overtime.my_overtime_add');
    Route::post('/dashboard/overtime{overtime_id}' , [admin\OvertimeController::class , 'approve'])->name('overtime.approve');
    Route::get('/dashboard/overtime/create' , [admin\OvertimeController::class , 'create'])->name('overtime.create');
    Route::post('/dashboard/overtime/search' , [admin\OvertimeController::class , 'search'])->name('overtime.search');
    Route::post('/dashboard/overtime/create' , [admin\OvertimeController::class , 'store'])->name('overtime.store');
//    Route::get('/dashboard/overtime/{id}' , [admin\OvertimeController::class , 'show'])->name('overtime.show');
//    Route::get('/dashboard/overtime/{id}/edit' , [admin\OvertimeController::class , 'edit'])->name('overtime.edit');
//    Route::put('/dashboard/overtime/{id}/edit' , [admin\OvertimeController::class , 'update'])->name('overtime.update');
    Route::delete('/dashboard/overtime/delete' , [admin\OvertimeController::class , 'delete'])->name('overtime.delete');

//-----------Company------------
    Route::get('/dashboard/company_info' , [admin\CompanyController::class , 'index'])->name('company.index');
    Route::put('/dashboard/company_info/edit' , [admin\CompanyController::class , 'update'])->name('company.update');
//-----------Holiday------------
    Route::get('/dashboard/holiday' , [admin\HolidayController::class , 'index'])->name('holiday.index');
    Route::get('/dashboard/holiday/create' , [admin\HolidayController::class , 'create'])->name('holiday.create');
    Route::post('/dashboard/holiday/create' , [admin\HolidayController::class , 'store'])->name('holiday.store');
//    Route::get('/dashboard/holiday/{id}' , [admin\HolidayController::class , 'show'])->name('holiday.show');
    Route::get('/dashboard/holiday/{id}/edit' , [admin\HolidayController::class , 'edit'])->name('holiday.edit');
    Route::put('/dashboard/holiday/{id}/edit' , [admin\HolidayController::class , 'update'])->name('holiday.update');
    Route::delete('/dashboard/holiday/delete' , [admin\HolidayController::class , 'delete'])->name('holiday.delete');
//----------Activities-----------
    Route::get('/dashboard/activities' , [admin\NotificationController::class , 'index'])->name('activities.index');
//----------Reports-----------
    Route::get('/dashboard/reports' , [admin\ReportController::class , 'index'])->name('reports.index');
    Route::get('/dashboard/reports/create' , [admin\ReportController::class , 'create'])->name('reports.create');
    Route::post('/dashboard/reports/create' , [admin\ReportController::class , 'store'])->name('reports.store');
    Route::get('/dashboard/reports/{id}/edit' , [admin\ReportController::class , 'edit'])->name('reports.edit');
    Route::put('/dashboard/reports/{id}/edit' , [admin\ReportController::class , 'update'])->name('reports.update');
    Route::get('/dashboard/reports/my_reports' , [admin\ReportController::class , 'my_reports'])->name('reports.my_reports');
    Route::post('/dashboard/reports/search' , [admin\ReportController::class , 'search'])->name('reports.search');
    Route::delete('/dashboard/reports/delete' , [admin\ReportController::class , 'delete'])->name('reports.delete');


});


//------------------------------Employee Routes--------------------------------------

Route::group(['prefix' => '/employee' , 'as' => 'employee.' , 'middleware' => ['auth']] , function(){
    Route::get('/dashboard' , [employee\EmployeeController::class , 'index'])->name('dashboard');


//-------------Departments------
    Route::get('/dashboard/departments' , [employee\DepartmentController::class , 'index'])->name('departments.index');
    //Route::get('/dashboard/departments/{id}' , [employee\DepartmentController::class , 'show'])->name('departments.show');
//-------------jobs-------------
    Route::get('/dashboard/jobs' , [employee\JobController::class , 'index'])->name('jobs.index');
    //Route::get('/dashboard/jobs/{id}' , [employee\JobController::class , 'show'])->name('jobs.show');
//-----------Company------------
    Route::get('/dashboard/company_info/index' , [employee\CompanyController::class , 'index'])->name('company.index');
//-----------Employee--------------
    Route::get('/dashboard/employee/profile' , [employee\EmployeeController::class , 'profile'])->name('employee.profile');
    Route::put('/dashboard/check_in' , [employee\EmployeeController::class , 'check_in'])->name('check_in');

    Route::get('/dashboard/employee/edit_profile' , [employee\EmployeeController::class , 'edit_profile'])->name('employee.edit_profile');
    Route::put('/dashboard/employee/update_profile' , [employee\EmployeeController::class , 'update_profile'])->name('employee.update_profile');



    Route::get('/dashboard/employee/edit_info' , [employee\EmployeeController::class , 'edit_info'])->name('employee.edit_info');
    Route::put('/dashboard/employee/update_info' , [employee\EmployeeController::class , 'update_info'])->name('employee.update_info');

    Route::get('/dashboard/employee/edit_emergency' , [employee\EmployeeController::class , 'edit_emergency'])->name('employee.edit_emergency');
    Route::put('/dashboard/employee/update_emergency' , [employee\EmployeeController::class , 'update_emergency'])->name('employee.update_emergency');

    Route::get('/dashboard/employee/edit_experience' , [employee\EmployeeController::class , 'edit_experience'])->name('employee.edit_experience');
    Route::get('/dashboard/employee/create_experience' , [employee\EmployeeController::class , 'create_experience'])->name('employee.create_experience');
    Route::post('/dashboard/employee/create_experience' , [employee\EmployeeController::class , 'store_experience'])->name('employee.store_experience');
    Route::put('/dashboard/employee/update_experience{id}' , [employee\EmployeeController::class , 'update_experience'])->name('employee.update_experience');
    Route::delete('/dashboard/employee/delete_experience{id}' , [employeee\EmployeeController::class , 'delete_experience'])->name('employee.delete_experience');


    Route::get('/dashboard/employee/edit_education' , [employee\EmployeeController::class , 'edit_education'])->name('employee.edit_education');
    Route::get('/dashboard/employee/create_education' , [employee\EmployeeController::class , 'create_education'])->name('employee.create_education');
    Route::post('/dashboard/employee/create_education' , [employee\EmployeeController::class , 'store_education'])->name('employee.store_education');
    Route::put('/dashboard/employee/update_education{id}' , [employee\EmployeeController::class , 'update_education'])->name('employee.update_education');
    Route::delete('/dashboard/employee/delete_education{id}' , [employee\EmployeeController::class , 'delete_education'])->name('employee.delete_education');

    //Route::get('/dashboard/employee/add_education' , [employee\EmployeeController::class , 'add_education'])->name('employee.add_education');

//-------------Leaves-----------
    Route::get('/dashboard/leaves' , [employee\LeaveController::class , 'index'])->name('leaves.index');
    Route::get('/dashboard/leaves/my_leaves' , [employee\LeaveController::class , 'myleaves'])->name('leaves.myleaves');
    Route::get('/dashboard/leaves/addleave' , [employee\LeaveController::class , 'addleave'])->name('leaves.addleave');
    Route::post('/dashboard/leaves/storeleave' , [employee\LeaveController::class , 'storeleave'])->name('leaves.storeleave');
    Route::get('/dashboard/leaves/edit_leave' , [employee\LeaveController::class , 'edit_leave'])->name('leaves.edit_leave');
    Route::put('/dashboard/leaves/update_leave' , [employee\LeaveController::class , 'update_leave'])->name('leaves.update_leave');
    Route::delete('/dashboard/leaves/delete' , [employee\LeaveController::class , 'delete'])->name('leaves.delete');
//-----------Salaries----------
    Route::get('/dashboard/salaries' , [employee\SalaryController::class , 'index'])->name('salaries.index');
//------------Attendance-------
    Route::get('/dashboard/attendance' , [employee\AttendanceController::class , 'my_attendance'])->name('attendance.my_attendance');
    Route::post('/dashboard/attendance/search' , [employee\AttendanceController::class , 'search'])->name('attendance.search');
//------------OverTime-------
    Route::get('/dashboard/attendance/overtime' , [employee\AttendanceController::class , 'overtime'])->name('attendance.overtime');
    Route::get('/dashboard/attendance/add_overtime' , [employee\AttendanceController::class , 'add_overtime'])->name('attendance.add_overtime');
    Route::post('/dashboard/attendance/store_overtime' , [employee\AttendanceController::class , 'store'])->name('attendance.store_overtime');
    Route::get('/dashboard/attendance/{id}/edit_overtime' , [employee\AttendanceController::class , 'edit_overtime'])->name('attendance.edit_overtime');
    Route::put('/dashboard/attendance/{id}/update_overtime' , [employee\AttendanceController::class , 'update_overtime'])->name('attendance.update_overtime');
    Route::delete('/dashboard/attendance/delete' , [employee\AttendanceController::class , 'delete'])->name('attendance.delete');

    Route::post('/dashboard/attendance' , [employee\AttendanceController::class , 'search'])->name('attendance.search');
    Route::put('/dashboard/attendance' , [employee\AttendanceController::class , 'check_in'])->name('attendance.check_in');
//-----------Reports------------
    Route::get('/dashboard/report' , [employee\ReportController::class , 'index'])->name('report.index');
    Route::get('/dashboard/report/addreport' , [employee\ReportController::class , 'addreport'])->name('report.addreport');
    Route::post('/dashboard/report/store_report' , [employee\ReportController::class , 'store'])->name('report.store_report');
    Route::get('/dashboard/report/{id}/edit_report' , [employee\ReportController::class , 'edit'])->name('report.edit_report');
    Route::post('/dashboard/report/{id}/update_report' , [employee\ReportController::class , 'update'])->name('report.update_report');
    Route::delete('/dashboard/report/delete' , [employee\ReportController::class , 'delete'])->name('report.delete');
//-----------Holidays------------
    Route::get('/dashboard/holiday' , [employee\HolidaysController::class , 'index'])->name('holiday.index');
//-----------Activities------------
    Route::get('/dashboard/activite' , [employee\ActiviteController::class , 'index'])->name('activite.index');


});


//------------------------------Auth Routes--------------------------------------

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'index']);

Route::get('/login', [App\Http\Controllers\SignInController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\SignInController::class, 'login'])->name('login');


