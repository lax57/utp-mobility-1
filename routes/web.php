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
Route::middleware(['web'])->group(function () {
    
    Route::get('/', [
        'uses'=> 'Auth\LoginController@showLoginForm',
        'as' => 'login',
    ]);
    
    Route::get('/register', [
        'uses'=> 'Auth\RegisterController@showRegisterForm',
        'as' => 'register',
    ]);
    
    Route::post('/user_login', [
        'uses'=> 'Auth\LoginController@login',
        'as' => 'user_login',
    ]);
    
    Route::post('/user_register', [
        'uses'=> 'Auth\RegisterController@register',
        'as' => 'user_register',
    ]);
    
    
});

Route::middleware(['web', 'auth'])->group(function () {
    
    //Admin
    Route::get('/dashboard/accounts/register_account', [
        'uses'=> 'AdminController@showRegisterAccountForm',
        'as' => 'register_account_view',
    ])->middleware('hasPermission:manage_website');
    
    //Admin
    Route::get('/dashboard', [
        'uses'=> 'AdminController@showDashboard',
        'as' => 'dashboard',
    ])->middleware('hasPermission:manage_website');
    
    //Admin
    Route::get('/dashboard/accounts', [
        'uses'=> 'AdminController@showAccounts',
        'as' => 'show_accounts',
    ])->middleware('hasPermission:manage_website');
    
    //Admin
    Route::post('/dashboard/accounts/register_account/register', [
        'uses'=> 'AdminController@registerAccount',
        'as' => 'register_new_account',
    ])->middleware('hasPermission:manage_website');
    
    
    //Admin
    Route::post('/dashboard/accounts/delete_account/{user_id}', [
        'uses'=> 'AdminController@deleteAccount',
        'as' => 'delete_account',
    ])->middleware('hasPermission:manage_website');
    
    //Admin
    Route::get('/statistics/types', [
        'uses'=> 'StatisticsController@getTypesStatistics',
        'as' => 'statistics_types',
    ])->middleware('hasPermission:manage_website');
    
    Route::get('/statistics/countries', [
        'uses'=> 'StatisticsController@getCountriesStatistics',
        'as' => 'statistics_countries',
    ])->middleware('hasPermission:manage_website');
    
    Route::get('/statistics/money', [
        'uses'=> 'StatisticsController@getMoneyInvestedStatistics',
        'as' => 'statistics_money',
    ])->middleware('hasPermission:manage_website');
    
    //Admin
    Route::get('/statistics/units', [
        'uses'=> 'StatisticsController@getUnitsStatistics',
        'as' => 'statistics_units',
    ])->middleware('hasPermission:manage_website');
    
    //Jefe, Comission, Rectoria
    Route::get('/evaluate_list', [
        'uses'=> 'ApplicationController@getApplicationsForEvaluation',
        'as' => 'evaluate_list',
    ])->middleware('hasPermission:evaluate_application');
    
    //Jefe
    Route::post('/evaluate_list/application/jefe/', [
        'uses'=> 'ApplicationController@evaluateApplicationJefe',
        'as' => 'evaluateJefe',
    ])->middleware('hasPermission:evaluate_application');
    
    Route::post('/evaluate_list/application/comission/', [
        'uses'=> 'ApplicationController@evaluateApplicationComission',
        'as' => 'evaluate_comission',
    ])->middleware('hasPermission:evaluate_application');
    
    Route::post('/evaluate_list/application/rectoria/', [
        'uses'=> 'ApplicationController@evaluateApplicationRectoria',
        'as' => 'evaluate_rectoria',
    ])->middleware('hasPermission:evaluate_application');
    
    //Jefe, Comission, Rectoria
    Route::get('/evaluate_list/application/{application_id}', [
        'uses'=> 'ApplicationController@showApplication',
        'as' => 'show_application_evaluation',
    ])->middleware('hasPermission:evaluate_application');
    
    Route::get('/newmobility', [
        'uses'=> 'ApplicationController@getApplicationFormTypes',
        'as' => 'new_mobility',
    ])->middleware('hasPermission:create_application');

    Route::get('/myapplications', [
        'uses'=> 'ApplicationController@getUserApplications',
        'as' => 'my_applications',
    ]);
    
    Route::get('/notifications', [
        'uses'=> 'NotificationController@showAllUserNotifications',
        'as' => 'notifications',
    ]);
    
    Route::post('/notifications/markAsRead', [
        'uses'=> 'NotificationController@markAsRead',
        'as' => 'notifications_mark_as_read',
    ]);

    Route::get('/newmobility/application/new/{application_type}', [
        'uses'=> 'ApplicationController@getApplicationCreateView',
        'as' => 'application_form',
    ])->middleware('hasPermission:create_application');
    
    
    Route::post('/myapplications/uploadInform', [
        'uses'=> 'InformController@uploadInform',
        'as' => 'inform_upload',
    ])->middleware('hasPermission:create_application');
    
    Route::get('/myapplications/downloadInform/{application_id}',[
        'uses'=> 'InformController@downloadInform',
        'as' => 'inform_download',
    ]);

    Route::get('/myapplications/application/{application_id}', [
        'uses'=> 'ApplicationController@showApplication',
        'as' => 'display_application',
    ]);
    
    Route::get('/history/{user_id}', [
        'uses'=> 'ApplicationController@showApplicantsHistory',
        'as' => 'show_applicants_history',
    ]);

    Route::post('/newmobility/application/store', [
        'uses'=> 'ApplicationController@store',
        'as' => 'application_store',
    ])->middleware('hasPermission:create_application');
    

    Route::get('/logout', [
        'uses'=> 'Auth\LoginController@logout',
        'as' => 'logout',
    ]);

});
