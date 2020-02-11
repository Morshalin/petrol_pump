<?php

Route::group(['middleware' => ['install']], function () {
	Route::get('/', function () {
		//return view('welcome');
		return redirect()->route('login');
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
		/*::::::::::::::::::language:::::::::::::::::::::*/
		Route::get('change/password','UserController@password')->name('user.password');
		Route::post('change/password/{id}','UserController@changepassword')->name('change.password');

/*::::::::::::::::::Our Custom Route Start:::::::::::::::::::::*/

		
		/*::::::::::::::::::Customer:::::::::::::::::::::*/
		Route::get('saleView/{id}','CustomerController@saleView')->name('customer.saleView');
		Route::resource('customer','CustomerController');
		Route::get('salescustomers/invoice/{id}', 'SalesCustomerController@invoice')->name('salescustomers.invoice');
		Route::get('ourcustomer', 'SalesCustomerController@ourcustomer')->name('ourcustomer');
		Route::get('customertype', 'SalesCustomerController@customertype')->name('customertype');
		Route::get('product/sale/report', 'SalesCustomerController@salereport')->name('product.sale.report');
		Route::resource('invoice','InvoiceController');

		/*::::::::::::::::::Sales Management:::::::::::::::::::::*/
		Route::group(['prefix'=>'sales'],function(){
			
			Route::get('sale/append','SaleController@append');
			Route::get('sale/saleinvoice/{id}','SaleController@invoice')->name('sale.saleinvoice');
			Route::get('sale/item','SaleController@item')->name('sale.item');
			Route::get('sale/due/{id}','SaleController@saleDue')->name('sale.due');
			Route::post('sale/due/{id}','SaleController@saleDuePay')->name('sale.duePay');
			Route::group(['prefix'=>'saleall'],function(){
				Route::resource('sale', 'SaleController');
			});
			
			Route::resource('salescustomers', 'SalesCustomerController');
			Route::resource('salescustomers', 'SalesCustomerController');
		});


		/*::::::::::::::::::Report Management:::::::::::::::::::::*/
		Route::group(['prefix'=>'report'],function(){
			Route::get('stockreport','ReportController@stockreport')->name('stockreport');
			Route::get('stockreportresult','ReportController@stockreportresult')->name('stockreportresult');
			Route::get('reports', 'SalesCustomerController@salesreport')->name('reports');
			
		});
		
		/*::::::::::::::::::Employess:::::::::::::::::::::*/
		Route::group(['prefix'=>'emp-all'],function(){

			Route::group(['prefix'=>'emp_info'],function(){
				Route::get('employer/purchase/{id}', 'EmployeesController@purchaseView')->name('employer.purchase.show');
				Route::resource('employees', 'EmployeesController');
				Route::get('emplye/adsence/{id}', 'EmployeesController@addAdsence')->name('addAdsence');
				Route::get('adsence/list', 'EmployeesController@list')->name('adsence.list');

				Route::post('adsence/insertAdsence', 'EmployeesController@insertAdsence')->name('adsence.insertAdsence');
				Route::get('adsence/view/{id}', 'EmployeesController@absenceview')->name('absence.show');
				Route::get('adsence/edit/{id}', 'EmployeesController@absenceedit')->name('absence.edit');
				Route::post('adsence/update/{id}', 'EmployeesController@absenceupdate')->name('absence.update');
				Route::delete('absence/delete/{id}/{slug}', 'EmployeesController@delete')->name('absence.delete');
			});
			Route::get('attendes/', 'EmployeesController@allattendes')->name('employees.attendes');
			Route::post('employe/', 'EmployeesController@present')->name('employe.present');
			Route::post('take/attendees/', 'EmployeesController@attendees')->name('take.attendees');
			Route::post('attendens/list/', 'EmployeesController@atendenslist')->name('attendens.list');
			Route::resource('post','PostController');
			Route::get('employerList/{id}','ShifttimeController@employerList')->name('shift.employe.list');
			Route::resource('shift','ShifttimeController');
		});


		/*::::::::::::::::::Purchase Product:::::::::::::::::::::*/
		Route::group(['prefix'=>'pro-manage'],function(){
			Route::resource('product','ProductController');
			Route::resource('items','ProductItemController');
			Route::resource('companyinfo','CompanyInfoController');
			Route::get('checkStock','ProductController@checkStock')->name('checkStock');
			Route::get('purchase/item','PurchesController@item')->name('purchase.item');
			Route::get('purchase/append','PurchesController@append');
			Route::get('purchase/purchaseinvoice/{id}','PurchesController@invoice')->name('purchase.purchaseinvoice');
			Route::resource('purchase','PurchesController');
			Route::get('purchase/due/{id}','PurchesController@purchaseDue')->name('purchase.due');
			Route::post('purchase/due/{id}','PurchesController@purchaseDuePay')->name('purchase.duePay');
		});
		

		/*::::::::::::::::::Employer Salay:::::::::::::::::::::*/
		Route::group(['prefix'=>'salary'],function(){
			Route::resource('salarysetup','SalarySetupController');
			Route::resource('salarypayment','SalarypaymentController');
			Route::resource('salaryreport','SalaryReportController');
			Route::get('setup','SalarySetupController@setup')->name('setup');
			Route::get('salarysetups','SalarypaymentController@salarysetups')->name('salarysetups');
			Route::get('repostlist','SalaryReportController@repostlist')->name('repostlist');
			Route::post('salarypayments','SalarypaymentController@insert')->name('salarypayments.insert');
		});
		
		/*::::::::::::::::::Account Section:::::::::::::::::::::*/
		Route::group(['prefix'=>'receipt'],function(){
			Route::resource('calculation','CalculationController');
			Route::resource('investment','InvestmentController');
			Route::resource('investowner','InvestownnerController');
		});

		Route::resource('paymethod','PayMethodController');
		


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
