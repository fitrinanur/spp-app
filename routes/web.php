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
});

Route::get('user-payments','PaymentController@userPayment')->name('user_payment.create');
Route::post('/ajax-user-student/user-students.json', 'PaymentController@getUserStudent')->name('get_user_student');
Route::post('user-payments', 'PaymentController@doUploadUser')->name('user_payment.store');
Route::get('user-payment', 'AuthController@guide')->name('user_payment.guide');
Route::get('check-spp','PaymentController@getCheckSpp')->name('user.check_spp');
Route::post('check-spp','PaymentController@doCheckSpp')->name('user.do_check_spp');
Route::get('user-payment/success-page','PaymentController@successPage')->name('user.success_page');
// Route::get('user-payment', 'PaymentController@userPayment')->route('user-payment');

Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('register', 'AuthController@showFormRegister')->name('register');
Route::post('register', 'AuthController@register');
 
Route::group(['middleware' => 'auth'], function () {
 
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('logout', 'AuthController@logout')->name('logout');

    Route::get('students','StudentController@index')->name('student.index');
    Route::get('create-students','StudentController@create')->name('student.create');
    Route::post('create-students','StudentController@store')->name('student.store');
    Route::get('edit-students/{student_nisn}','StudentController@edit')->name('student.edit');
    Route::put('update-students','StudentController@update')->name('student.update');
    Route::delete('students/{student_nisn}','StudentController@destroy')->name('student.destroy');

    Route::get('students/export', 'StudentController@doExport')->name('student.export');

    Route::get('classes','ClassController@index')->name('class.index');
    Route::get('create-classes','ClassController@create')->name('class.create');
    Route::post('create-classes','ClassController@store')->name('class.store');
    Route::get('edit-classes/{id}','ClassController@edit')->name('class.edit');
    Route::put('update-classes','ClassController@update')->name('class.update');
    Route::delete('classes/{id}','ClassController@destroy')->name('class.destroy');

    Route::get('classes/{id}/students','ClassController@indexStudentClass')->name('class.student.index');
    //Route::get('classes/{id}/student','ClassController@createStudent')->name('class.student.create');
    Route::post('classes/{id}/student','ClassController@storeStudent')->name('class.student.store');
    Route::delete('classes/{class_id}/student/{student_class_id}','ClassController@deleteStudent')->name('class.student.delete');

    Route::get('payment','PaymentController@index')->name('payment.index');
    Route::get('create-payment','PaymentController@create')->name('payment.create');
    Route::post('create-payment','PaymentController@store')->name('payment.store');
    Route::get('edit-payment/{id}','PaymentController@edit')->name('payment.edit');
    Route::put('update-payment','PaymentController@update')->name('payment.update');
    Route::delete('payment/{id}','PaymentController@destroy')->name('payment.destroy');


    Route::get('payment-confirmations','PaymentConfirmationController@index')->name('payment_confirmation.index');
    Route::put('payment-confirmations/{id}','PaymentConfirmationController@update')->name('payment_confirmation.update');



    //report
    Route::get('payment-report','ReportPaymentController@index')->name('reports_payments.index');
    Route::post('payment-report','ReportPaymentController@doExport')->name('reports_payments.export');

    //route get image preview
    Route::get('payment/{id}/image','PaymentController@getImage')->name('get_image');
    //route get for select2
    Route::post('/ajax-subcat-student/students.json', 'PaymentController@getStudent')->name('get_student');
    

    Route::get('semester','SemesterController@index')->name('semester.index');
    Route::get('create-cost-semester','SemesterController@create')->name('semester.create');
    Route::post('create-cost-semester','SemesterController@store')->name('semester.store');
    Route::get('edit-cost-semester/{id}','SemesterController@edit')->name('semester.edit');
    Route::put('edit-cost-semester/{id}','SemesterController@update')->name('semester.update');
    Route::put('status-semester/{id}','SemesterController@changeStatus')->name('semester_status.update');
    Route::delete('semester/{id}','SemesterController@destroy')->name('semester.destroy');


});



