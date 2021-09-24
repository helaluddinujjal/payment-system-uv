<?php

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


Auth::routes(['verify' => true]);

Route::get('/', function(){
    return view('home');
});
Route::get('/home', 'HomeController@home')->name('/home');

Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Auth'], function () {

    Route::get('/login','admin\LoginController@showLoginForm')->name('login');
    Route::post('/login/submit','admin\LoginController@login')->name('login.submit');
    Route::post('/logout','admin\LoginController@logout')->name('logout');
    // password reset email
    Route::get('/password/reset','admin\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset/email','admin\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

    // password reset token
    Route::get('/password/reset/{token}','admin\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('/password/reset/request','admin\ResetPasswordController@reset')->name('password.reset.request');


});

Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin'], function () {

    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

    Route::get('/department', 'DepartmentController@index')->name('dept');
    Route::get('/dept-create', 'DepartmentController@create')->name('dept.create');
    Route::get('/dept-edit/{id}', 'DepartmentController@edit')->name('dept.edit');
    Route::post('/dept-store', 'DepartmentController@store')->name('dept.store');
    Route::post('/dept-update/{id}', 'DepartmentController@update')->name('dept.update');
    Route::delete('/dept-delete/{id}', 'DepartmentController@destroy')->name('dept.delete');

    Route::get('/batch', 'BatchController@index')->name('batch');
    Route::get('/batch-create', 'BatchController@create')->name('batch.create');
    Route::get('/batch-edit/{id}', 'BatchController@edit')->name('batch.edit');
    Route::post('/batch-store', 'BatchController@store')->name('batch.store');
    Route::post('/batch-update/{id}', 'BatchController@update')->name('batch.update');
    Route::delete('/batch-delete/{id}', 'BatchController@destroy')->name('batch.delete');

    Route::get('/semester', 'SemesterController@index')->name('semester');
    Route::get('/semester-create', 'SemesterController@create')->name('semester.create');
    Route::get('/semester-edit/{id}', 'SemesterController@edit')->name('semester.edit');
    Route::post('/semester-store', 'SemesterController@store')->name('semester.store');
    Route::post('/semester-update/{id}', 'SemesterController@update')->name('semester.update');
    Route::delete('/semester-delete/{id}', 'SemesterController@destroy')->name('semester.delete');

    ///dept/{dept}/batch/{batch}
    Route::get('/tuition', 'TuitionFeeController@index')->name('tuition');
    Route::get('/tuition/tuition-create', 'TuitionFeeController@create')->name('tuition.create');
    Route::get('/tuition/tuition-edit/{id}', 'TuitionFeeController@edit')->name('tuition.edit');
    Route::post('/tuition/tuition-store', 'TuitionFeeController@store')->name('tuition.store');
    Route::post('/tuition/tuition-update/{id}', 'TuitionFeeController@update')->name('tuition.update');
    Route::delete('/tuition/tuition-delete/{id}', 'TuitionFeeController@destroy')->name('tuition.delete');

    Route::get('payment/dept/batch/{dept_id}/{batch_id}', 'AdminController@paymentDetails')->name('payment.details');
    Route::get('all-student', 'AdminController@allStudent')->name('students');
    Route::delete('student/delete{id}', 'AdminController@studentDelete')->name('student.delete');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile/update/', 'ProfileController@update')->name('profile.update');
    Route::post('/password/update/', 'ProfileController@passwordUpdate')->name('password.update');

    Route::get('/theme/setting', 'ThemeSettingController@index')->name('theme.setting');
    Route::post('/theme/update/', 'ThemeSettingController@update')->name('theme.update');
});

Route::group(['as'=>'student.','prefix' => 'student','namespace'=>'Student'], function () {


    Route::get('/dashboard', 'StudentController@dashboard')->name('dashboard');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile/update/', 'ProfileController@update')->name('profile.update');
    Route::post('/profile/password/update/', 'ProfileController@passwordUpdate')->name('password.update');

    Route::get('/payment', 'PaymentController@index')->name('payment');
    Route::get('/payment/history', 'PaymentController@paymentHistory')->name('payment.history');



});

// SSLCOMMERZ Start
Route::get('/example1', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END

// SSLCOMMERZ Start
// Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
// Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

// Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
// Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

// Route::post('/success', [SslCommerzPaymentController::class, 'success']);
// Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
// Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

// Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

/**
* API route
*/

Route::get('get-batch/{id}',function($id){
    return json_encode(App\Batch::where('dept_id',$id)->get()) ;
});
Route::get('get-fee/{id}',function($id){
    return json_encode(App\TuitionFee::where('semester_id',$id)->first()) ;
});

