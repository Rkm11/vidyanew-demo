<?php
Route::get('/', function () {
	return view('dashboard');
});

Route::resource('enquiry', 'EnquiryController');
Route::resource('admission', 'AdmissionController');
Route::resource('parent', 'ParentController');
Route::resource('attendance', 'AttendanceController');
Route::resource('marksheet', 'MarksheetController');
Route::resource('standard', 'StandardController');
Route::resource('medium', 'MediumController');
Route::resource('subject', 'SubjectController');
Route::resource('batch', 'BatchController');
Route::resource('school', 'SchoolController');
Route::resource('previous', 'PreviousController');
Route::resource('invoice', 'InvoiceController');
Route::resource('payment', 'PaymentController');
Route::resource('balance-sheet', 'BalanceSheetController');
Route::resource('relative', 'StudentRelativeController');
Route::resource('student', 'StudentController');
Route::resource('installment', 'InstallmentController');
Route::resource('test', 'TestController');
Route::resource('settings', 'ChangeSettingController');
Route::resource('certification', 'CertificationController');

Route::resource('telecalling', 'TelecallingController', ['name' => ['update' => 'telecalling.update'], ['store' => 'telecalling.store']]);
Route::get('telecalling-data', 'TelecallingController@getdata')->name('enquiry.data');
Route::resource('viewcall', 'ViewTelecallingController');

Route::get('others/create', function () {
	return view('create_others');
})->name('others');
Route::get('installment-data', 'InstallmentController@data')->name('installment.data');
Route::post('filtered-certification-data', 'CertificationController@filteredData')->name('filtered-certification-data');
Route::get('certification-data', 'CertificationController@data')->name('certification.data');
Route::get('get-enquiry', 'TelecallingController@getFollowdata');

Route::get('generate-att-report', 'AttendanceController@generateReport')->name('generate-att-report');
Route::get('view-marksheet/{id}', 'MarksheetController@viewMarksheet')->name('view-marksheet');
Route::get('read-file', 'AttendanceController@readExcel')->name('read-file');
Route::get('attendance-data', 'AttendanceController@data')->name('attendance.data');
Route::get('attendance-view-data', 'AttendanceController@dataAttendance')->name('attendance-view.data');

Route::get('marksheet-data', 'MarksheetController@data')->name('marksheet.data');
Route::get('marksheet-all', 'MarksheetController@all')->name('marksheet.all');

// Route::get('marksheet-all', 'MarksheetController@allStudent')->name('marksheet.all');

Route::get('marksheet-view-data', 'MarksheetController@dataMarksheet')->name('marksheet-view.data');
Route::get('marksheet-view-alldata', 'MarksheetController@allMarksheet')->name('marksheet-view.alldata');
Route::post('marksheet-get', 'MarksheetController@getTestData')->name('marksheet-get');
Route::post('subject-get', 'SubjectController@data')->name('subject-get');
Route::post('subject-data', 'SubjectController@getData')->name('subject-data');
Route::get('standard-data', 'StandardController@standardData')->name('standard-data');

Route::get('enquiry-data', 'EnquiryController@data')->name('enquiry.data');
Route::get('enquiry-data-2', 'EnquiryController@stuData')->name('enquiry.data2');
Route::get('/', 'EnquiryController@e_cout')->name('enquiry.e_cout');
Route::get('student-data', 'StudentController@data')->name('student.data');
Route::get('invoice-data', 'InvoiceController@data')->name('invoice.data');
Route::get('admission-data', 'AdmissionController@data')->name('admission.data');
Route::post('test-data', 'TestController@getData')->name('test-data');

Route::post('find-school', 'SchoolController@findSchool')->name('find-school');

Route::get('balance-data', 'BalanceSheetController@data')->name('balance.data');
Route::get('data-invoice', 'InvoiceController@getAll')->name('data-invoice');

Route::get('datatables', 'DatatablesController@getIndex');
Route::get('data', 'DatatablesController@anyData')->name('datatables.data');

Route::get('download-invoice/{id}', 'InvoiceController@downloadPDF')->name('d-invoice');
Route::get('download-receipt/{id}', 'InvoiceController@downloadReceipt')->name('d-receipt');
Route::get('download-admission/{id}', 'AdmissionController@downloadPDF')->name('ad-invoice');
Route::get('download-telecalling/{id}', 'TelecallingController@downloadPDF')->name('ad-invoice');
Route::get('download-alltelecalling/{id}', 'TelecallingController@downloadAllPDF')->name('all-tele');
Route::get('download-marksheet/{id}', 'MarksheetController@downloadPDF')->name('ad-invoice');
Route::get('download-all/{id}', 'MarksheetController@allPDF')->name('d-all-mark');
Route::get('admission/confirm/{id}', 'AdmissionController@confirm');

Route::get('/changepassword', 'ChangePasswordController@showchangepassword');

Route::post('/changepassword', 'ChangePasswordController@changepassword')->name('changepassword');

Route::get('/changesetting', 'ChangeSettingController@showchangesetting');

Route::post('/changesetting', 'ChangePasswordController@changesetting')->name('changesetting');

Auth::routes();
