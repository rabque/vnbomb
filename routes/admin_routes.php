<?php
/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/
$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_ROOT']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');


	/* ================== Categories ================== */
	Route::resource(config('laraadmin.adminRoute') . '/categories', 'LA\CategoriesController');
	Route::get(config('laraadmin.adminRoute') . '/category_dt_ajax', 'LA\CategoriesController@dtajax');

	/* ================== Articles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/articles', 'LA\ArticlesController');
	Route::get(config('laraadmin.adminRoute') . '/article_dt_ajax', 'LA\ArticlesController@dtajax');



	/* ================== Contacts ================== */
	Route::resource(config('laraadmin.adminRoute') . '/contacts', 'LA\ContactsController');
	Route::get(config('laraadmin.adminRoute') . '/contact_dt_ajax', 'LA\ContactsController@dtajax');

	/* ================== Menu Editor ================== */

	Route::post(config('laraadmin.adminRoute') . '/api/sort', 'LA\ApiController@sort');
	Route::post(config('laraadmin.adminRoute') . '/api/updateFields', 'LA\ApiController@updateFields');



	/* ================== FAMenus ================== */
	Route::resource(config('laraadmin.adminRoute') . '/famenus', 'LA\FAMenusController');
	Route::post(config('laraadmin.adminRoute') . '/famenus/update_hierarchy', 'LA\FAMenusController@update_hierarchy');


	/* ================== Settings ================== */
	Route::resource(config('laraadmin.adminRoute') . '/settings', 'LA\SettingsController');
	Route::get(config('laraadmin.adminRoute') . '/setting_dt_ajax', 'LA\SettingsController@dtajax');

	/* ================== Socials ================== */
	Route::resource(config('laraadmin.adminRoute') . '/socials', 'LA\SocialsController');
	Route::get(config('laraadmin.adminRoute') . '/social_dt_ajax', 'LA\SocialsController@dtajax');

	/* ================== Sliders ================== */
	Route::resource(config('laraadmin.adminRoute') . '/sliders', 'LA\SlidersController');
	Route::get(config('laraadmin.adminRoute') . '/slider_dt_ajax', 'LA\SlidersController@dtajax');

	/* ================== Notes ================== */
	Route::resource(config('laraadmin.adminRoute') . '/notes', 'LA\NotesController');
	Route::get(config('laraadmin.adminRoute') . '/note_dt_ajax', 'LA\NotesController@dtajax');

	/* ================== Socials ================== */
	Route::resource(config('laraadmin.adminRoute') . '/points', 'LA\PointsController');
	Route::get(config('laraadmin.adminRoute') . '/point_dt_ajax', 'LA\PointsController@dtajax');
	/* ================== Setting_Games ================== */
	Route::resource(config('laraadmin.adminRoute') . '/setting_games', 'LA\Setting_GamesController');
	Route::get(config('laraadmin.adminRoute') . '/setting_game_dt_ajax', 'LA\Setting_GamesController@dtajax');

	/* ================== Withdraws ================== */
	Route::resource(config('laraadmin.adminRoute') . '/withdraws', 'LA\WithdrawsController');
	Route::get(config('laraadmin.adminRoute') . '/withdraw_dt_ajax', 'LA\WithdrawsController@dtajax');

	/* ================== Games ================== */
	Route::resource(config('laraadmin.adminRoute') . '/games', 'LA\GamesController');
	Route::get(config('laraadmin.adminRoute') . '/game_dt_ajax', 'LA\GamesController@dtajax');

	/* ================== Match ================== */
	Route::resource(config('laraadmin.adminRoute') . '/match', 'LA\MatchController');
	Route::get(config('laraadmin.adminRoute') . '/match_dt_ajax', 'LA\MatchController@dtajax');

	/* ================== Players ================== */
	Route::resource(config('laraadmin.adminRoute') . '/players', 'LA\PlayersController');
	Route::get(config('laraadmin.adminRoute') . '/player_dt_ajax', 'LA\PlayersController@dtajax');

	/* ================== Affiliates ================== */
	Route::resource(config('laraadmin.adminRoute') . '/affiliates', 'LA\AffiliatesController');
	Route::get(config('laraadmin.adminRoute') . '/affiliate_dt_ajax', 'LA\AffiliatesController@dtajax');
});
