<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middlewareGroups' => ['web']], function () {
		//Registration
	//disable registration from guest
	/*Route::get('auth/register',['as'=>'register','uses'=> 'Auth\AuthController@getRegister']);
	Route::post('auth/register','Auth\AuthController@postRegister');*/
	//End disable
	//Reroute /auth/register
		//Route::any('/auth/register','PagesController@getIndex');
	//End Reroute

	//GUEST
	//Authenticate
	Route::get('auth/login',['as'=>'login','uses'=>'Auth\AuthController@getLogin']);
	Route::post('auth/login','Auth\AuthController@postLogin');
	Route::get('auth/logout',['as'=>'logout','uses'=> 'Auth\AuthController@logout']);
	
	//Password Reset Routes
	Route::get('password/reset/{token?}','Auth\PasswordController@showResetForm');
	Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset','Auth\PasswordController@reset');

	Route::get('/', 'HomeController@getIndex');
	Route::get('/contact', ['uses'=>'HomeController@getContact','as'=>'contact']);
	Route::post('/contact', ['uses'=>'HomeController@postContact','as'=>'contact']);

	Route::get('/about', ['uses'=>'HomeController@getAbout','as'=>'about']);

	//AUTHORISED

	Route::get('dashboard', ['uses'=>'HomeController@getDashboard','as'=>'dashboard',
		'middleware'=>'roles',
		'roles'=>['Reception','Admin','Coordinator','Faculty']
		]);

	//USERS
	//Route::resource('users','UserController',['except'=>['create']]);
	Route::get('users',['as'=>'users.index','uses'=>'UserController@index','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('users/create',['as'=>'users.create','uses'=>'UserController@create','middleware' => 'roles','roles' => ['Admin']]);
	Route::post('users/create',['as'=>'users.store','uses'=>'UserController@store','middleware' => 'roles','roles' => ['Admin']]);
	Route::get('users/{id}',['as'=>'users.show','uses'=>'UserController@show','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('users/{id}/edit',['as'=>'users.edit','uses'=>'UserController@edit','middleware' => 'roles','roles' => ['Admin']]);
	Route::put('users/{id}',['as'=>'users.update','uses'=>'UserController@update']);
	Route::delete('users/{id}',['as'=>'users.destroy','uses'=>'UserController@destroy','middleware' => 'roles','roles' => ['Admin']]);
	//END USERS

	//Admin Route
	Route::post('assign',['uses'=>'AdminController@postAssign', 'as'=>'admin.assign','middleware' => 'roles','roles' => ['Admin']]);



/*	
	Route::get('public/student/{id}',['as'=>'public.single','uses'=>'PublicController@getSingle']);
	Route::get('public',['uses'=>'PublicController@getIndex','as'=>'public.index']);
	Route::get('public/{id}',['uses'=>'PublicController@getIndex','as'=>'public.index']);

	Route::get('public.search', ['uses'=>'PublicController@getSearch','as'=>'public.search']);
//PAGES/////////////////////
*/    


	Route::get('sms/dashboard', ['as'=>'sms.dashboard','uses'=>'Sms\PagesController@getDashboard',
		'middleware'=>'roles',
		'roles'=>['Reception','Admin','Coordinator','Faculty']
		]);
	
	Route::get('sms/pages/students/{id}',['as'=>'sms.pages.students','uses'=>'Sms\PagesController@getStudents','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);

	//STUDENT
	//Route::resource('students','StudentController');
	Route::get('sms/students',['as'=>'sms.students.index','uses'=>'Sms\StudentController@index']);
	Route::get('sms/students/create',['as'=>'sms.students.create','uses'=>'Sms\StudentController@create','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::post('sms/students/create',['as'=>'sms.students.store','uses'=>'Sms\StudentController@store','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('sms/students/{id}',['as'=>'sms.students.show','uses'=>'Sms\StudentController@show']);
	Route::get('sms/students/{id}/edit',['as'=>'sms.students.edit','uses'=>'Sms\StudentController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::put('sms/students/{id}',['as'=>'sms.students.update','uses'=>'Sms\StudentController@update','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::delete('sms/students/{id}',['as'=>'sms.students.destroy','uses'=>'Sms\StudentController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);

	Route::get('sms/students/editSubject/{id}',['as'=>'sms.students.editSubject','uses'=>'Sms\StudentController@editSubject','middleware'=>'roles','roles'=> ['Admin','Coordinator','Faculty','Reception']]);
	Route::put('sms/students/updateSubject/{id}',['uses'=>'Sms\StudentController@updateSubject', 'as'=>'sms.students.updateSubject','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('sms/students/addAll/{id}',['uses'=>'Sms\StudentController@addAll', 'as'=>'sms.students.addAll','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	//END STUDENT

	//REGISTRATION
	Route::get('sms/registrations',['as'=>'sms.registrations.index','uses'=>'Sms\RegistrationController@index']);
	Route::get('sms/registrations/create/{id}',['as'=>'sms.registrations.create','uses'=>'Sms\RegistrationController@create','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::post('sms/registrations/create',['as'=>'sms.registrations.store','uses'=>'Sms\RegistrationController@store','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('sms/registrations/{id}',['as'=>'sms.registrations.show','uses'=>'Sms\RegistrationController@show','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('sms/registrations/{id}/edit',['as'=>'sms.registrations.edit','uses'=>'Sms\RegistrationController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::put('sms/registrations/{id}',['as'=>'sms.registrations.update','uses'=>'Sms\RegistrationController@update','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::delete('sms/registrations/{id}',['as'=>'sms.registrations.destroy','uses'=>'Sms\RegistrationController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);

	Route::get('sms/registrations.search', ['uses'=>'Sms\RegistrationController@search','as'=>'sms.registrations.search',
		'middleware'=>'roles',
		'roles'=>['Reception','Admin','Coordinator','Faculty']
		]);
	//END REGISTRATION

	//CATEGORIES
	//Route::resource('categories','CategoryController',['except'=>['create']]);
	Route::get('sms/categories',['as'=>'sms.categories.index','uses'=>'Sms\CategoryController@index']);
	Route::get('sms/categories/create',['as'=>'sms.categories.create','uses'=>'Sms\CategoryController@create','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::post('sms/categories/create',['as'=>'sms.categories.store','uses'=>'Sms\CategoryController@store','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('sms/categories/{id}',['as'=>'sms.categories.show','uses'=>'Sms\CategoryController@show']);
	Route::get('sms/categories/{id}/edit',['as'=>'sms.categories.edit','uses'=>'Sms\CategoryController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::put('sms/categories/{id}',['as'=>'sms.categories.update','uses'=>'Sms\CategoryController@update','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::delete('sms/categories/{id}',['as'=>'sms.categories.destroy','uses'=>'Sms\CategoryController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	//END CATEGORIES

	//COURSES
	//Route::resource('courses','CourseController',['except'=>['create']]);
	Route::get('sms/courses',['as'=>'sms.courses.index','uses'=>'Sms\CourseController@index']);
	Route::get('sms/courses/create',['as'=>'sms.courses.create','uses'=>'Sms\CourseController@create','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::post('sms/courses/create',['as'=>'sms.courses.store','uses'=>'Sms\CourseController@store','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('sms/courses/{id}',['as'=>'sms.courses.show','uses'=>'Sms\CourseController@show']);
	Route::get('sms/courses/{id}/edit',['as'=>'sms.courses.edit','uses'=>'Sms\CourseController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::put('sms/courses/{id}',['as'=>'sms.courses.update','uses'=>'Sms\CourseController@update','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::delete('sms/courses/{id}',['as'=>'sms.courses.destroy','uses'=>'Sms\CourseController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	//END COURSES


	//COMMUNITIES
	//Route::resource('communities','CommunityController',['except'=>['create']]);
	Route::get('sms/communities',['as'=>'sms.communities.index','uses'=>'Sms\CommunityController@index']);
	Route::get('sms/communities/create',['as'=>'sms.communities.create','uses'=>'Sms\CommunityController@create','middleware' => 'roles','roles' => ['Admin']]);
	Route::post('sms/communities/create',['as'=>'sms.communities.store','uses'=>'Sms\CommunityController@store','middleware' => 'roles','roles' => ['Admin']]);
	Route::get('sms/communities/{id}',['as'=>'sms.communities.show','uses'=>'Sms\CommunityController@show']);
	Route::get('sms/communities/{id}/edit',['as'=>'sms.communities.edit','uses'=>'Sms\CommunityController@edit','middleware' => 'roles','roles' => ['Admin']]);
	Route::put('sms/communities/{id}',['as'=>'sms.communities.update','uses'=>'Sms\CommunityController@update','middleware' => 'roles','roles' => ['Admin']]);
	Route::delete('sms/communities/{id}',['as'=>'sms.communities.destroy','uses'=>'Sms\CommunityController@destroy','middleware' => 'roles','roles' => ['Admin']]);
	//END COMMUNITIES

	//STATUSES
	//Route::resource('statuses','StatusController',['except'=>['create']]);
	Route::get('sms/statuses',['as'=>'sms.statuses.index','uses'=>'Sms\StatusController@index']);
	Route::get('sms/statuses/create',['as'=>'sms.statuses.create','uses'=>'Sms\StatusController@create','middleware' => 'roles','roles' => ['Admin']]);
	Route::post('sms/statuses/create',['as'=>'sms.statuses.store','uses'=>'Sms\StatusController@store','middleware' => 'roles','roles' => ['Admin']]);
	Route::get('sms/statuses/{id}',['as'=>'sms.statuses.show','uses'=>'Sms\StatusController@show']);
	Route::get('sms/statuses/{id}/edit',['as'=>'sms.statuses.edit','uses'=>'Sms\StatusController@edit','middleware' => 'roles','roles' => ['Admin']]);
	Route::put('sms/statuses/{id}',['as'=>'sms.statuses.update','uses'=>'Sms\StatusController@update','middleware' => 'roles','roles' => ['Admin']]);
	Route::delete('sms/statuses/{id}',['as'=>'sms.statuses.destroy','uses'=>'Sms\StatusController@destroy','middleware' => 'roles','roles' => ['Admin']]);
	//END STATUSES

	
	
	//Subject
	//Route::resource('subjects','SubjectController',['except'=>['create']]);
	Route::get('sms/subjects',['as'=>'sms.subjects.index','uses'=>'Sms\SubjectController@index']);
	Route::get('sms/subjects/create',['as'=>'sms.subjects.create','uses'=>'Sms\SubjectController@create','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::post('sms/subjects/create',['as'=>'sms.subjects.store','uses'=>'Sms\SubjectController@store','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('sms/subjects/{id}',['as'=>'sms.subjects.show','uses'=>'Sms\SubjectController@show','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('sms/subjects/{id}/edit',['as'=>'sms.subjects.edit','uses'=>'Sms\SubjectController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::put('sms/subjects/{id}',['as'=>'sms.subjects.update','uses'=>'Sms\SubjectController@update','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::delete('sms/subjects/{id}',['as'=>'sms.subjects.destroy','uses'=>'Sms\SubjectController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
//End Subject

	//RESULTS
	//Route::resource('results','ResultController');
	Route::get('sms/results',['as'=>'sms.results.index','uses'=>'Sms\ResultController@index']);
	Route::get('sms/results/create',['as'=>'sms.results.create','uses'=>'Sms\ResultController@create','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::post('sms/results/create',['as'=>'sms.results.store','uses'=>'Sms\ResultController@store','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('sms/results/{id}',['as'=>'sms.results.show','uses'=>'Sms\ResultController@show','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('sms/results/{id}/edit',['as'=>'sms.results.edit','uses'=>'Sms\ResultController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::put('sms/results/{id}',['as'=>'sms.results.update','uses'=>'Sms\ResultController@update','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::delete('sms/results/{id}',['as'=>'sms.results.destroy','uses'=>'Sms\ResultController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	
	Route::get('sms/search', ['uses'=>'Sms\ResultController@search','as'=>'sms.results.search']);
	//END RESULTS

	//INTERNALS
	//Route::resource('internals','InternalController');
	Route::get('sms/internals',['as'=>'sms.internals.index','uses'=>'Sms\InternalController@index']);
	Route::get('sms/internals/create',['as'=>'sms.internals.create','uses'=>'Sms\InternalController@create','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty']]);
	Route::post('sms/internals/create',['as'=>'sms.internals.store','uses'=>'Sms\InternalController@store','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty']]);
	Route::get('sms/internals/{id}',['as'=>'sms.internals.show','uses'=>'Sms\InternalController@show','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty']]);
	Route::get('sms/internals/{id}/edit',['as'=>'sms.internals.edit','uses'=>'Sms\InternalController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty']]);
	Route::put('sms/internals/{id}',['as'=>'sms.internals.update','uses'=>'Sms\InternalController@update','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty']]);
	Route::delete('sms/internals/{id}',['as'=>'sms.internals.destroy','uses'=>'Sms\InternalController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	
	Route::get('sms/internals.search', ['uses'=>'Sms\InternalController@search','as'=>'sms.internals.search']);
	//END INTERNALS

	

	//REPORT
	Route::get('sms/reports/registration',['as'=>'sms.reports.registration','uses'=>'Sms\ReportController@getRegistration']);
	Route::get('sms/exportRegistraation',['uses'=>'Sms\ReportController@getExportRegistration','as'=>'sms.reports.exportRegistration']);

	Route::get('sms/reports/internal',['as'=>'sms.reports.internal','uses'=>'Sms\ReportController@getInternal']);
	Route::get('sms/exportInternal',['uses'=>'Sms\ReportController@getExportInternal','as'=>'sms.reports.exportInternal']);

	Route::get('sms/reports/result',['as'=>'sms.reports.result','uses'=>'Sms\ReportController@getResult']);
	Route::get('sms/exportResult',['uses'=>'Sms\ReportController@getExportResult','as'=>'sms.reports.exportResult']);

	Route::get('sms/reports/subplan',['as'=>'sms.reports.subplan','uses'=>'Sms\ReportController@getSubPlan']);
	Route::get('sms/exportSubPlan',['uses'=>'Sms\ReportController@getExportSubPlan','as'=>'sms.reports.exportSubPlan']);


	Route::get('sms/reports/student',['as'=>'sms.reports.student','uses'=>'Sms\ReportController@getStudent']);
	Route::get('sms/exportStudent',['uses'=>'Sms\ReportController@getExportStudent','as'=>'sms.reports.exportStudent']);
	//END REPORT

	//SEARCH
	Route::get('sms/studentsearch', ['uses'=>'Sms\StudentController@search','as'=>'sms.students.search',
		'middleware'=>'roles',
		'roles'=>['Reception','Admin','Coordinator','Faculty']
		]);

	
	//END SEARCH

	//EXCEL IMPORT AND EXPORT
	Route::get('sms/reports/index',['uses'=>'Sms\ExcelController@getIndex','as'=>'sms.excel.export']);
	Route::get('sms/reports/export',['uses'=>'Sms\ExcelController@getExport','as'=>'sms.excel.export']);
	Route::post('sms/import',['uses'=>'Sms\ExcelController@getImport','as'=>'sms.excel.import','middleware' => 'roles','roles' => ['Admin','Coordinator','Reception']]);
	//END EXCEL IMPORT AND EXPORT

	Route::get('sms/exportSubjects',['uses'=>'Sms\ExcelController@getExportSubjects','as'=>'sms.excel.exportSubjects']);
	Route::post('sms/importSubject',['uses'=>'Sms\ExcelController@getImportSubject','as'=>'sms.excel.importSubject','middleware' => 'roles','roles' => ['Admin','Coordinator','Reception']]);

	

	//Documents
	Route::get('sms/documents/show/{id}',['uses' => 'Sms\DocumentController@show','as'=>'sms.documents.show']);
	Route::get('sms/documents/edit/{id}',['uses' => 'Sms\DocumentController@edit','as'=>'sms.documents.edit']);
	Route::put('sms/documents/update/{id}',['as'=>'sms.documents.update','uses'=>'Sms\DocumentController@update']);
	Route::post('sms/documents/save','DocumentController@saveDocument');

	Route::get('sms/documents/destroy/{id}',['uses' => 'Sms\DocumentController@destroy','as'=>'sms.documents.destroy','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::post('sms/documents/upload',['uses'=>'Sms\DocumentController@documentUpload','as'=>'sms.documents.upload']);

	//Route::get('documents/delete/{id}','DocumentController@deleteDocument');
	//End Documents

	//PROSPECTUS



	Route::get('reception/dashboard', ['as'=>'reception.dashboard','uses'=>'Reception\PagesController@getDashboard',
		'middleware'=>'roles',
		'roles'=>['Reception','Admin','Coordinator','Faculty']
		]);


	Route::get('reception/prospectuses',['as'=>'reception.prospectuses.index','uses'=>'Reception\ProspectusController@index']);

	Route::get('reception/prospectuses/create',['as'=>'reception.prospectuses.create','uses'=>'Reception\ProspectusController@create','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::post('reception/prospectuses/create',['as'=>'reception.prospectuses.store','uses'=>'Reception\ProspectusController@store','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::get('reception/prospectuses/{id}',['as'=>'reception.prospectuses.show','uses'=>'Reception\ProspectusController@show']);
	Route::get('reception/prospectuses/{id}/edit',['as'=>'reception.prospectuses.edit','uses'=>'Reception\ProspectusController@edit','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::put('reception/prospectuses/{id}',['as'=>'reception.prospectuses.update','uses'=>'Reception\ProspectusController@update','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::delete('reception/prospectuses/{id}',['as'=>'reception.prospectuses.destroy','uses'=>'Reception\ProspectusController@destroy','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::get('reception/prospectuses.search', ['as'=>'reception.prospectuses.search','uses'=>'Reception\ProspectusController@search','middleware' => 'roles','roles' => ['Admin','Reception']]);
	
	Route::get('reception/reports/candidates',['as'=>'reception.reports.candidates','uses'=>'Reception\ReportController@getCandidates']);
	Route::get('reception/exportCandidates',['uses'=>'Reception\ReportController@getExportCandidates','as'=>'reception.reports.exportCandidates']);

	Route::get('reception/reports/prospectuses',['as'=>'reception.reports.prospectuses','uses'=>'Reception\ReportController@getProspectus']);
	Route::get('reception/exportProspectus',['uses'=>'Reception\ReportController@getExportProspectus','as'=>'reception.reports.exportProspectus']);

	//END PROSPECTUS

// START CANDIDATES
	Route::get('reception/candidates',['as'=>'reception.candidates.index','uses'=>'Reception\CandidateController@index']);

	Route::get('reception/candidates/create',['as'=>'reception.candidates.create','uses'=>'Reception\CandidateController@create','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::post('reception/candidates/create',['as'=>'reception.candidates.store','uses'=>'Reception\CandidateController@store','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::get('reception/candidates/{id}',['as'=>'reception.candidates.show','uses'=>'Reception\CandidateController@show']);
	Route::get('reception/candidates/{id}/edit',['as'=>'reception.candidates.edit','uses'=>'Reception\CandidateController@edit','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::put('reception/candidates/{id}',['as'=>'reception.candidates.update','uses'=>'Reception\CandidateController@update','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::delete('reception/candidates/{id}',['as'=>'reception.candidates.destroy','uses'=>'Reception\CandidateController@destroy','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::get('reception/candidates.search', ['as'=>'reception.candidates.search','uses'=>'Reception\CandidateController@search','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::get('reception/candidates.createsearch', ['as'=>'reception.candidates.createsearch','uses'=>'Reception\CandidateController@createsearch','middleware' => 'roles','roles' => ['Admin','Reception']]);
	
	//END CANDIDATES


	// START ENTRANCE
	Route::get('reception/entrances',['as'=>'reception.entrances.index','uses'=>'Reception\EntranceController@index']);

	Route::get('reception/entrances/create',['as'=>'reception.entrances.create','uses'=>'Reception\EntranceController@create','middleware' => 'roles','roles' => ['Admin','Reception','Faculty']]);
	Route::post('reception/entrances/create',['as'=>'reception.entrances.store','uses'=>'Reception\EntranceController@store','middleware' => 'roles','roles' => ['Admin','Reception','Faculty']]);
	Route::get('reception/entrances/{id}',['as'=>'reception.entrances.show','uses'=>'Reception\EntranceController@show']);
	Route::get('reception/entrances/{id}/edit',['as'=>'reception.entrances.edit','uses'=>'Reception\EntranceController@edit','middleware' => 'roles','roles' => ['Admin','Reception','Faculty']]);
	Route::put('reception/entrances/{id}',['as'=>'reception.entrances.update','uses'=>'Reception\EntranceController@update','middleware' => 'roles','roles' => ['Admin','Reception','Faculty']]);
	Route::delete('reception/entrances/{id}',['as'=>'reception.entrances.destroy','uses'=>'Reception\EntranceController@destroy','middleware' => 'roles','roles' => ['Admin','Reception']]);
	Route::get('reception/entrances.search', ['as'=>'reception.entrances.search','uses'=>'Reception\EntranceController@search','middleware' => 'roles','roles' => ['Admin','Reception','Faculty']]);
	Route::post('reception/entrances.exportcsv', ['as'=>'reception.entrances.exportcsv','uses'=>'Reception\EntranceController@exportcsv','middleware' => 'roles','roles' => ['Admin','Reception','Faculty']]);
	Route::post('reception/entrances.importcsv', ['as'=>'reception.entrances.importcsv','uses'=>'Reception\EntranceController@importcsv','middleware' => 'roles','roles' => ['Admin','Reception','Faculty']]);
	
	//END ENTRANCE


	// START ATTENDANCE
	Route::get('Sms/attendances',['as'=>'sms.attendances.index','uses'=>'Sms\AttendanceController@index']);

	Route::get('Sms/attendances/create',['as'=>'sms.attendances.create','uses'=>'Sms\AttendanceController@create','middleware' => 'roles','roles' => ['Admin','Faculty']]);
	Route::post('Sms/attendances/create',['as'=>'sms.attendances.store','uses'=>'Sms\AttendanceController@store','middleware' => 'roles','roles' => ['Admin','Faculty']]);
	Route::get('Sms/attendances/{id}',['as'=>'sms.attendances.show','uses'=>'Sms\AttendanceController@show']);
	Route::get('Sms/attendances/{id}/edit',['as'=>'sms.attendances.edit','uses'=>'Sms\AttendanceController@edit','middleware' => 'roles','roles' => ['Admin','Faculty']]);
	Route::put('Sms/attendances/{id}',['as'=>'sms.attendances.update','uses'=>'Sms\AttendanceController@update','middleware' => 'roles','roles' => ['Admin','Faculty']]);
	Route::delete('Sms/attendances/{id}',['as'=>'sms.attendances.destroy','uses'=>'Sms\AttendanceController@destroy','middleware' => 'roles','roles' => ['Admin','Faculty']]);
	Route::get('Sms/attendances.search', ['as'=>'sms.attendances.search','uses'=>'Sms\AttendanceController@search','middleware' => 'roles','roles' => ['Admin','Faculty']]);
	Route::post('Sms/attendances.exportcsv', ['as'=>'sms.attendances.exportcsv','uses'=>'Sms\AttendanceController@exportcsv','middleware' => 'roles','roles' => ['Admin','Faculty']]);
	Route::post('Sms/attendances.importcsv', ['as'=>'sms.attendances.importcsv','uses'=>'Sms\AttendanceController@importcsv','middleware' => 'roles','roles' => ['Admin','Faculty']]);
	
	//END ATTENDANCE



	Route::get('systems/dashboard', ['as'=>'systems.dashboard','uses'=>'Systems\PagesController@getDashboard',
		'middleware'=>'roles',
		'roles'=>['Admin','Coordinator']
		]);

	Route::get('account/dashboard', ['as'=>'account.dashboard','uses'=>'Account\PagesController@getDashboard',
		'middleware'=>'roles',
		'roles'=>['Reception','Admin']
		]);

	Route::get('inventory/dashboard', ['as'=>'inventory.dashboard','uses'=>'Inventory\PagesController@getDashboard',
		'middleware'=>'roles',
		'roles'=>['Admin','Coordinator']
		]);

	Route::get('hostel/dashboard', ['as'=>'hostel.dashboard','uses'=>'Hostel\PagesController@getDashboard',
		'middleware'=>'roles',
		'roles'=>['Reception','Admin','Coordinator','Faculty']
		]);


//EMPLOYEES
	//Route::resource('students','StudentController');

	Route::get('ems/dashboard', ['as'=>'ems.dashboard','uses'=>'Ems\PagesController@getDashboard', 'middleware'=>'roles', 'roles'=>['Reception','Admin','Coordinator','Faculty']]);

	Route::post('employee/mypage', ['as'=>'employee','uses'=>'emp\EmployeeController@index']);
	Route::post('employee/detail', ['as'=>'detail','uses'=>'emp\EmployeeController@show']);

	Route::get('employee/mypage', ['as'=>'employee','uses'=>'emp\EmployeeController@index']);
	Route::get('employee/detail', ['as'=>'detail','uses'=>'emp\EmployeeController@show']);

	
	Route::get('ems/pages/employees/{id}',['as'=>'ems.pages.employees','uses'=>'Ems\PagesController@getStudents','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('ems/employees', ['as'=>'ems.employees.index','uses'=>'Ems\EmployeeController@index']);
	Route::get('ems/employees/create',['as'=>'ems.employees.create','uses'=>'Ems\EmployeeController@create','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::post('ems/employees/create',['as'=>'ems.employees.store','uses'=>'Ems\EmployeeController@store','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('ems/employees/{id}',['as'=>'ems.employees.show','uses'=>'Ems\EmployeeController@show']);
	Route::get('ems/employeess/{id}/edit',['as'=>'ems.employees.edit','uses'=>'Ems\EmployeeController@edit','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::put('ems/employees/{id}',['as'=>'ems.employees.update','uses'=>'Ems\EmployeeController@update','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::delete('ems/employees/{id}',['as'=>'ems.employees.destroy','uses'=>'Ems\EmployeeController@destroy','middleware' => 'roles','roles' => ['Admin','Coordinator']]);
	Route::get('ems/employeesearch', ['uses'=>'Ems\EmployeeController@search','as'=>'ems.employees.search',
		'middleware'=>'roles','roles'=>['Reception','Admin','Coordinator','Faculty']]);

 

	Route::get('ems/documents/show/{id}',['uses' => 'ems\DocumentController@show','as'=>'ems.documents.show']);
	Route::get('ems/documents/edit/{id}',['uses' => 'Ems\DocumentController@edit','as'=>'ems.documents.edit']);
	Route::put('ems/documents/update/{id}',['as'=>'ems.documents.update','uses'=>'Ems\DocumentController@update']);
	Route::post('ems/documents/save','DocumentController@saveDocument');
	Route::get('ems/documents/destroy/{id}',['uses' => 'Ems\DocumentController@destroy','as'=>'ems.documents.destroy','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::post('ems/documents/upload',['uses'=>'Ems\DocumentController@documentUpload','as'=>'ems.documents.upload']);


	Route::post('ems/leave/show/{id}',['uses' => 'ems\LeaveController@leave','as'=>'ems.leave.show']);
	Route::get('ems/leave/show/{id}',['uses' => 'ems\LeaveController@leave','as'=>'ems.leave.show']); 
	Route::post('ems/leave/view/{id}',['as'=>'ems.leave.view','uses'=>'Ems\LeaveController@view']);
	Route::get('ems/leave/view/{id}',['as'=>'ems.leave.view','uses'=>'Ems\LeaveController@view']);
	Route::post('ems/leave/approve/{id}',['as'=>'ems.leave.approve','uses'=>'Ems\LeaveController@approve']);
	Route::get('ems/leave/approve/{id}',['as'=>'ems.leave.approve','uses'=>'Ems\LeaveController@approve']);
	Route::post('ems/leave/lists/{id}',['as'=>'ems.leave.lists','uses'=>'Ems\LeaveController@lists']);
	Route::get('ems/leave/lists/{id}',['as'=>'ems.leave.lists','uses'=>'Ems\LeaveController@lists']);
	Route::post('ems/leave/reject/{id}',['as'=>'ems.leave.reject','uses'=>'Ems\LeaveController@reject']);
	Route::get('ems/leave/reject/{id}',['as'=>'ems.leave.reject','uses'=>'Ems\LeaveController@reject']);
	Route::post('ems/leave/confirm/{id}',['as'=>'ems.leave.confirm','uses'=>'Ems\LeaveController@confirm']);
	Route::get('ems/leave/confirm/{id}',['as'=>'ems.leave.confirm','uses'=>'Ems\LeaveController@confirm']);
	Route::post('ems/leave/pending/{id}',['as'=>'ems.leave.pending','uses'=>'Ems\LeaveController@pending']);
	Route::get('ems/leave/pending/{id}',['as'=>'ems.leave.pending','uses'=>'Ems\LeaveController@pending']);
	Route::post('ems/leave/submit',['as'=>'ems.leave.store','uses'=>'Ems\LeaveController@store','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('ems/leave/destroy/{id}',['uses' => 'Ems\LeaveController@destroy','as'=>'ems.leave.destroy','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	

	Route::post('ems/outpass/show/{id}',['uses' => 'ems\OutpassController@leave','as'=>'ems.outpass.show']);
	Route::get('ems/outpass/show/{id}',['uses' => 'ems\OutpassController@leave','as'=>'ems.outpass.show']); 
	Route::post('ems/outpass/view/{id}',['as'=>'ems.outpass.view','uses'=>'Ems\OutpassController@view']);
	Route::get('ems/outpass/view/{id}',['as'=>'ems.outpass.view','uses'=>'Ems\OutpassController@view']);
	Route::post('ems/outpass/approve/{id}',['as'=>'ems.outpass.approve','uses'=>'Ems\OutpassController@approve']);
	Route::get('ems/outpass/approve/{id}',['as'=>'ems.outpass.approve','uses'=>'Ems\OutpassController@approve']);
	Route::post('ems/outpass/lists/{id}',['as'=>'ems.outpass.lists','uses'=>'Ems\OutpassController@lists']);
	Route::get('ems/outpass/lists/{id}',['as'=>'ems.outpass.lists','uses'=>'Ems\OutpassController@lists']);
	Route::post('ems/outpass/reject/{id}',['as'=>'ems.outpass.reject','uses'=>'Ems\OutpassController@reject']);
	Route::get('ems/outpass/reject/{id}',['as'=>'ems.outpass.reject','uses'=>'Ems\OutpassController@reject']);
	Route::post('ems/outpass/confirm/{id}',['as'=>'ems.outpass.confirm','uses'=>'Ems\OutpassController@confirm']);
	Route::get('ems/outpass/confirm/{id}',['as'=>'ems.outpass.confirm','uses'=>'Ems\OutpassController@confirm']);
	Route::post('ems/outpass/pending/{id}',['as'=>'ems.outpass.pending','uses'=>'Ems\OutpassController@pending']);
	Route::get('ems/outpass/pending/{id}',['as'=>'ems.outpass.pending','uses'=>'Ems\OutpassController@pending']);
	Route::post('ems/outpass/submit',['as'=>'ems.outpass.store','uses'=>'Ems\OutpassController@store','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	Route::get('ems/outpass/destroy/{id}',['uses' => 'Ems\OutpassController@destroy','as'=>'ems.outpass.destroy','middleware' => 'roles','roles' => ['Admin','Coordinator','Faculty','Reception']]);
	//END EMPLOYEES



});