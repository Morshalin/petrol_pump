<?php

Route::group(['middleware' => ['install']], function () {
	Route::get('/', function () {
		return view('welcome');
	});
	Auth::routes();
	Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth']], function () {
		Route::match(['get', 'post'], 'configuration', 'SettingController@index')->name('configuration');
		Route::post('/logo', 'SettingController@upload_logo')->name('logo');
		Route::post('/api', 'SettingController@api')->name('api');
		Route::post('/social', 'SettingController@api')->name('social');
		/*::::::::::::::::::language:::::::::::::::::::::*/
		Route::get('/language', 'LanguageController@index')->name('language');
		Route::match(['get', 'post'], 'create', 'LanguageController@create')->name('language.create');
		Route::get('language/edit/{id?}', 'LanguageController@edit')->name('language.edit');
		Route::patch('language/update/{id}', 'LanguageController@update')->name('language.update');
		Route::delete('/language/delete/{id}', 'LanguageController@delete')->name('language.delete');

/*::::::::::::::::::Our Custom Route Start:::::::::::::::::::::*/

		
		/*::::::::::::::::::Customer:::::::::::::::::::::*/
	
		Route::resource('customer','CustomerController');
		Route::resource('salescustomers', 'SalesCustomerController');
		Route::get('ourcustomer', 'SalesCustomerController@ourcustomer')->name('ourcustomer');
		Route::get('customertype', 'SalesCustomerController@customertype')->name('customertype');
		Route::resource('invoice','InvoiceController');
		
		
		/*::::::::::::::::::Employess:::::::::::::::::::::*/
		Route::resource('employees', 'EmployeesController');
		Route::get('emplye/adsence/{id}', 'EmployeesController@addAdsence')->name('addAdsence');
		Route::post('adsence/insertAdsence', 'EmployeesController@insertAdsence')->name('adsence.insertAdsence');
		Route::get('adsence/list', 'EmployeesController@list')->name('adsence.list');
		Route::get('adsence/view/{id}', 'EmployeesController@absenceview')->name('absence.show');
		Route::get('adsence/edit/{id}', 'EmployeesController@absenceedit')->name('absence.edit');
		Route::post('adsence/update/{id}', 'EmployeesController@absenceupdate')->name('absence.update');
		Route::delete('absence/delete/{id}/{slug}', 'EmployeesController@delete')->name('absence.delete');
		Route::get('attendes/', 'EmployeesController@allattendes')->name('employees.attendes');
		Route::post('employe/', 'EmployeesController@present')->name('employe.present');
		Route::post('take/attendees/', 'EmployeesController@attendees')->name('take.attendees');
		Route::post('attendens/list/', 'EmployeesController@atendenslist')->name('attendens.list');
		Route::resource('post','PostController');
		Route::resource('shift','ShifttimeController');

		/*::::::::::::::::::Product:::::::::::::::::::::*/
		Route::resource('items','ProductItemController');
		Route::resource('product','ProductController');
		Route::resource('companyinfo','CompanyInfoController');

		/*::::::::::::::::::Employer Salay:::::::::::::::::::::*/
		Route::resource('salarysetup','SalarySetupController');
		Route::get('setup','SalarySetupController@setup')->name('setup');
		Route::resource('salarypayment','SalarypaymentController');
		Route::post('salarypayments','SalarypaymentController@insert')->name('salarypayments.insert');

/*::::::::::::::::::Our Custom Route End:::::::::::::::::::::*/


		/*::::::::::::::user role Permission:::::::::*/

		Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
			Route::get('/role', 'RoleController@index')->name('role');
			Route::get('/role/datatable', 'RoleController@datatable')->name('role.datatable');
			Route::any('/role/create', 'RoleController@create')->name('role.create');
			Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
			Route::post('/role/edit', 'RoleController@update')->name('role.update');
			Route::delete('/role/delete/{id}', 'RoleController@distroy')->name('role.delete');
			//user:::::::::::::::::::::::::::::::::
			Route::get('/', 'UserController@index')->name('index');
			Route::any('/create', 'UserController@create')->name('create');
			Route::put('/change/{value}/{id}', 'UserController@status')->name('change');
			Route::get('/edit/{id}', 'UserController@edit')->name('edit');
			Route::put('/edit', 'UserController@update')->name('update');
			Route::delete('/delete/{id}', 'UserController@destroy')->name('delete');

		});
	});
});

/*::::::::::::::::::::install::::::::::::::::::*/
Route::get('/install', 'Install\InstallController@index')->name('install');
Route::post('/install', 'Install\InstallController@terms');
Route::get('/install/server', 'Install\InstallController@server')->name('install.server');
Route::post('/install/server', 'Install\InstallController@check_server');
Route::get('install/database', 'Install\InstallController@database')->name('install.database');
Route::post('install/database', 'Install\InstallController@process_install');
Route::get('install/user', 'Install\InstallController@create_user')->name('install.user');
Route::post('install/user', 'Install\InstallController@store_user');
Route::get('install/settings', 'Install\InstallController@system_settings')->name('install.settings');
Route::post('install/settings', 'Install\InstallController@final_touch');

Route::get('/home', 'HomeController@index')->name('home');
