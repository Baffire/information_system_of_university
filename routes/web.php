<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes([
    'register' => false,
]);

/*ROUTS FOR ADMIN ROLE
=============================================*/
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'ShowProfile@showProfile')->name('admin');
	Route::match(['get', 'post'], '/users', 'ShowAllUsers@showAllUsers')->name('admin_users');
	Route::match(['get', 'post'], '/users/edit/{id}', 'EditUser@editUser')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/students/', 'ShowStudents@showStudents')->name('admin_students');
    Route::match(['get', 'post'], '/students/edit/{id}', 'EditStudent@editStudent')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/teachers', 'ShowTeachers@showTeachers')->name('admin_teachers');
    Route::match(['get', 'post'], '/teachers/edit/{id}', 'EditTeacher@editTeacher')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/employees', 'ShowEmployees@showEmployees')->name('admin_employees');
    Route::match(['get', 'post'], '/employees/edit/{id}', 'EditEmployee@editEmployee')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/employees/create', 'CreateEmployee@createEmployee');
    Route::match(['get', 'post'], '/heads', 'ShowHeads@showHeads')->name('admin_heads');
    Route::match(['get', 'post'], '/heads/edit/{id}', 'EditHead@editHead')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/heads/create', 'CreateHead@createHead');
});

/*ROUTS FOR STUDENT ROLE
=============================================*/
Route::group(['namespace' => 'Student', 'prefix' => 'student', 'middleware' => 'auth'], function () {
    Route::get('/', 'ShowProfile@showProfile')->name('student');
    Route::match(['get', 'post'], '/check', 'CheckFirstLogin@checkFirstLogin');
    Route::match(['get', 'post'], '/titles', 'ShowTitles@showTitles')->name('student_titles');
    Route::match(['get', 'post'], '/titles/requests', 'ShowTitlesRequests@showTitlesRequests')->name('student_titles_requests');
    Route::match(['get', 'post'], '/titles/requests/delete/{id}', 'DeleteTitlesRequests@deleteTitlesRequests')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/teachers', 'ShowTeachers@showTeachers')->name('student_teachers');
    Route::match(['get', 'post'], '/teachers/create_title/{id}', 'CreateTitle@createTitle')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/teachers/show_titles', 'ShowTeacherTitles@showTeacherTitles');
    Route::match(['get', 'post'], '/teachers/edit_title/{id}', 'EditTitle@editTitle')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/teachers/delete_title/{id}', 'DeleteTitle@deleteTitle')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/progress', 'ShowProgress@showProgress')->name('student_progress');
    Route::match(['get', 'post'], '/progress/upload/{id}', 'UploadFile@uploadFile')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/progress/download/{id}', 'DownloadFile@downloadFile')->where(['id' => '[0-9]+']);
});

/*ROUTS FOR TEACHER ROLE
=============================================*/
Route::group(['namespace' => 'Teacher', 'prefix' => 'teacher', 'middleware' => 'auth'], function () {
    Route::get('/', 'ShowProfile@showProfile')->name('teacher');
    Route::match(['get', 'post'], '/check', 'CheckFirstLogin@checkFirstLogin');
    Route::match(['get', 'post'], '/students/', 'ShowStudents@showStudents')->name('teacher_students');
    Route::match(['get', 'post'], '/students/{confirm}/{id}', 'WriteStudents@writeStudents')->where(['confirm' => '[0-1]+', 'id' => '[0-9]+']);
    Route::match(['get', 'post'], '/students/titles', 'ShowStudentsTitles@showStudentsTitles')->name('teacher_students');
    Route::match(['get', 'post'], '/students/titles/{confirm}/{id}', 'WriteStudentsTitles@writeStudentsTitles')->where(['confirm' => '[0-1]+', 'id' => '[0-9]+']);
    Route::match(['get', 'post'], '/titles', 'ShowTitles@showTitles')->name('teacher_titles');
    Route::match(['get', 'post'], '/my_titles', 'ShowMyTitles@showMyTitles')->name('teacher_my_titles');
    Route::match(['get', 'post'], '/my_titles/edit/{id}', 'EditMyTitles@editMyTitles')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/my_titles/delete/{id}', 'DeleteMyTitles@deleteMyTitles')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/create_title', 'CreateTitle@createTitle')->name('teacher_create_title');
    Route::match(['get', 'post'], '/create_titles', 'CreateTitles@createTitles')->name('teacher_create_titles');
    Route::match(['get', 'post'], '/my_students', 'ShowMyStudents@showMyStudents')->name('teacher_my_students');
    Route::match(['get', 'post'], '/my_students/progress/{id}', 'ProgressMyStudents@progressMyStudents')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/my_students/progress/download/{id}/{student_id}', 'DownloadFileMyStudents@downloadFileMyStudents')->where(['id' => '[0-9]+', 'student_id' => '[0-9]+']);
    Route::match(['get', 'post'], '/my_students/progress/control/{confirm}/{id}/{student_id}', 'ProgressControlMyStudents@progressControlMyStudents')->where(['confirm' => '[0-1]+', 'id' => '[0-9]+', 'student_id' => '[0-9]+']);
    Route::match(['get', 'post'], '/templates', 'ShowTemplates@showTemplates')->name('teacher_templates');
    Route::match(['get', 'post'], '/templates/{name}', 'DownloadTemplate@downloadTemplate')->where(['name' => '[a-zA-Z]+']);
    Route::match(['get', 'post'], '/archive', 'ShowArchive@showArchive')->name('teacher_archive');
});

/*ROUTS FOR HEAD OF DEPARTMENT ROLE
=============================================*/
Route::group(['namespace' => 'Head', 'prefix' => 'head', 'middleware' => 'auth'], function () {
    Route::get('/', 'ShowProfile@showProfile')->name('head');
    Route::match(['get', 'post'], '/check', 'CheckFirstLogin@checkFirstLogin');
    Route::match(['get', 'post'], '/titles', 'ShowTitles@showTitles')->name('head_titles');
    Route::match(['get', 'post'], '/titles/{confirm}/{id}', 'ConfirmTitles@confirmTitles')->where(['confirm' => '[0-9]+', 'id' => '[0-9]+']);
    Route::match(['get', 'post'], '/titles/confirm', 'ShowTitlesConfirm@showTitlesConfirm')->name('head_titles_confirm');
    Route::match(['get', 'post'], '/titles/negative', 'ShowTitlesNegative@showTitlesNegative')->name('head_titles_negative');
    Route::match(['get', 'post'], '/titles/negative/comment/{id}', 'CreateTitlesNegativeComment@createTitlesNegativeComment')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/advisers', 'ShowAdvisers@showAdvisers')->name('head_advisers');
    Route::match(['get', 'post'], '/advisers/{confirm}/{id}', 'confirmAdvisers@confirmAdvisers')->where(['confirm' => '[0-9]+', 'id' => '[0-9]+']);
    Route::match(['get', 'post'], '/advisers/edit/{id}', 'EditAdvisers@editAdvisers')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/advisers/confirm', 'ShowConfirmAdvisers@showConfirmAdvisers')->name('head_advisers_confirm');
    Route::match(['get', 'post'], '/advisers/confirm/edit/{id}', 'EditConfirmAdvisers@editConfirmAdvisers')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/advisers/negative', 'ShowNegativeAdvisers@showNegativeAdvisers')->name('head_advisers_negative');
    Route::match(['get', 'post'], '/advisers/negative/edit/{id}', 'EditNegativeAdvisers@editNegativeAdvisers')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/students', 'ShowStudents@showStudents')->name('head_students');
    Route::match(['get', 'post'], '/students/get', 'GetStudents@getStudents');
    Route::match(['get', 'post'], '/teachers', 'ShowTeachers@showTeachers')->name('head_teachers');
    Route::match(['get', 'post'], '/teachers/rating/{id}', 'ShowTeacherRating@showTeacherRating')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/progress', 'ShowProgress@showProgress')->name('head_progress');
    Route::match(['get', 'post'], '/progress/get', 'GetProgress@getProgress')->name('head_progress_get');
    Route::match(['get', 'post'], '/progress/download', 'DownloadProgress@downloadProgress')->name('head_progress_download');
    Route::match(['get', 'post'], '/archive', 'ShowArchive@showArchive')->name('head_archive');
    Route::match(['get', 'post'], '/archive/edit/{id}', 'EditArchive@editArchive')->where(['id' => '[0-9]+']);

});

/*ROUTS FOR EMPLOYEE OF DEPARTMENT ROLE
=============================================*/
Route::group(['namespace' => 'Employee', 'prefix' => 'employee', 'middleware' => 'auth'], function () {
    Route::get('/', 'ShowProfile@showProfile')->name('employee');
    Route::match(['get', 'post'], '/check', 'CheckFirstLogin@checkFirstLogin');
    Route::match(['get', 'post'], '/students', 'ShowStudents@showStudents')->name('employee_students');
    Route::match(['get', 'post'], '/students/get', 'GetStudents@getStudents');
    Route::match(['get', 'post'], '/student/create', 'CreateStudent@createStudent')->name('employee_create_student');
    Route::match(['get', 'post'], '/students/create', 'CreateStudents@createStudents')->name('employee_create_students');
    Route::match(['get', 'post'], '/teachers', 'ShowTeachers@showTeachers')->name('employee_teachers');
    Route::match(['get', 'post'], '/teacher/create', 'CreateTeacher@createTeacher')->name('employee_create_teacher');
    Route::match(['get', 'post'], '/teachers/create', 'CreateTeachers@createTeachers')->name('employee_create_teachers');
    Route::match(['get', 'post'], '/titles', 'ShowTitles@showTitles')->name('employee_titles');
    Route::match(['get', 'post'], '/titles/get', 'GetTitles@getTitles');
    Route::match(['get', 'post'], '/advisers', 'ShowAdvisers@showAdvisers')->name('employee_advisers');
    Route::match(['get', 'post'], '/advisers/get', 'GetAdvisers@getAdvisers')->name('employee_advisers_get');
    Route::match(['get', 'post'], '/advisers/edit/{id}', 'Editadvisers@editadvisers')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/notifications', 'ShowNotifications@showNotifications')->name('employee_notifications');
    Route::match(['get', 'post'], '/notifications/edit/{id}', 'EditNotification@editNotification')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/notifications/delete/{id}', 'DeleteNotification@deleteNotification')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/notification/create', 'CreateNotification@createNotification')->name('employee_create_notification');
    Route::match(['get', 'post'], '/roadmap', 'ShowRoadmap@showRoadmap')->name('employee_roadmap');
    Route::match(['get', 'post'], '/roadmap/get', 'GetRoadmap@getRoadmap')->name('employee_roadmap_get');
    Route::match(['get', 'post'], '/roadmap/get/edit/{id}', 'EditRoadmap@editRoadmap')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/roadmap/get/create', 'CreateItemRoadmap@createItemRoadmap');
    Route::match(['get', 'post'], '/roadmap/get/delete/{id}', 'DeleteItemRoadmap@deleteItemRoadmap')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/roadmap/create', 'CreateRoadmap@createRoadmap')->name('employee_roadmap_create');
    Route::match(['get', 'post'], '/progress', 'ShowProgress@showProgress')->name('employee_progress');
    Route::match(['get', 'post'], '/progress/get', 'GetProgress@getProgress')->name('employee_progress_get');
    Route::match(['get', 'post'], '/progress/get/edit/{id}', 'EditProgress@editProgress')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/progress/download', 'DownloadProgress@downloadProgress')->name('employee_progress_download');
    Route::match(['get', 'post'], '/templates', 'ShowTemplates@showTemplates')->name('employee_templates');
    Route::match(['get', 'post'], '/templates/{name}', 'DownloadTemplate@downloadTemplate')->where(['name' => '[a-zA-Z]+']);
    Route::match(['get', 'post'], '/training_programs', 'ShowTrainingPrograms@showTrainingPrograms')->name('employee_training_programs');
    Route::match(['get', 'post'], '/training_programs/create', 'CreateTrainingProgram@createTrainingProgram');
    Route::match(['get', 'post'], '/training_programs/edit/{id}', 'EditTrainingProgram@editTrainingProgram')->where(['id' => '[0-9]+']);
    Route::match(['get', 'post'], '/archive', 'ShowArchive@showArchive')->name('employee_archive');
    Route::match(['get', 'post'], '/archive/edit/{id}', 'EditArchive@editArchive')->where(['id' => '[0-9]+']);
});

















