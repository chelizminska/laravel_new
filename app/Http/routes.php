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
//Public//////////////////
//baseC
Route::get('/', ['as' => 'home', 'uses' => 'Base\BaseController@indexAction']);
Route::get('/fishes', 'Base\BaseController@showFishesAction');
Route::get('/fishes/{id}', 'Base\BaseController@showFishInfoAction');
Route::get('/news', 'Base\BaseController@showNewsAction');
Route::get('/view_news', 'Base\BaseController@viewNewsAction');
Route::get('/about', 'Base\BaseController@showAboutAction');
Route::get('/forum', ['middleware' => 'breadcrumbs', 'uses' => 'Base\BaseController@showForumAction']);
Route::get('/forum/newtopic', 'Base\BaseController@getAddForumTopicAction');
Route::post('/forum/newtopic', 'Base\BaseController@postAddForumTopicAction');
Route::post('/forum/add', 'Base\BaseController@addForumMessageAction');
Route::get('/personal_info', 'Base\BaseController@showPersonalInfoAction');
Route::get('/personal_messages', 'Base\BaseController@showPersonalMessagesAction');
Route::get('/personal_message', 'Base\BaseController@viewPersonalMessageAction');
Route::get('/user', 'Base\BaseController@showUserInfoAction');
Route::get('/personal_info_change', 'Base\BaseController@getChangePersonalInfoAction');
Route::post('/personal_info_username_save', 'Base\BaseController@postChangePersonalInfoUsernameAction');
Route::post('/personal_info_password_save', 'Base\BaseController@postChangePersonalInfoPasswordAction');
Route::get('/send_message_to_user', 'Base\BaseController@getSendUserMessageAction');
Route::post('/send_message_to_user', 'Base\BaseController@postSendUserMessageAction');

//authC
Route::get('/register', ['as' => 'user-registration', 'uses' => 'Base\AuthController@getRegisterAction']);
Route::post('/register', ['uses' => 'Base\AuthController@postRegisterAction']);
Route::get('/login', ['as' => 'user-login', 'uses' => 'Base\AuthController@getLoginAction']);
Route::post('/login', ['uses' => 'Base\AuthController@postLoginAction']);
Route::get('/logout', 'Base\AuthController@logoutAction');




//Admin////////////////////
//baseC
Route::get('/admin', ['as' => 'admin', 'uses' => 'Admin\BaseController@indexAction']);
Route::get('/admin/contents', 'Admin\BaseController@showContentManagementAction');
Route::get('/admin/users', 'Admin\BaseController@showUsersManagementAction');
Route::get('/admin/users/{id}', 'Admin\BaseController@showUserInfoAction');
Route::post('/admin/users/{id}/give_warning', 'Admin\BaseController@giveWarningAction');
Route::post('/admin/users/{id}/give_admin_rights', 'Admin\BaseController@giveAdminRightsAction');
Route::get('/admin/statistics', 'Admin\BaseController@showSiteStatisticsAction');

Route::get('/admin/contents/home', 'Admin\BaseController@getEditHomeAction');
Route::post('/admin/contents/home', 'Admin\BaseController@postEditHomeAction');

Route::get('/admin/contents/forum/{id?}', 'Admin\BaseController@showForumAction');
Route::get('/admin/contents/forum/{id}/new_topic', 'Admin\BaseController@getAddForumNewTopicAction');
Route::post('/admin/contents/forum/{id}/new_topic', 'Admin\BaseController@postAddForumNewTopicAction');
Route::get('/admin/contents/forum/{id?}/add', 'Admin\BaseController@getAddForumAction');
Route::post('/admin/contents/forum/{id?}/add', 'Admin\BaseController@postAddForumAction');
Route::get('/admin/contents/forum/{id}/edit', 'Admin\BaseController@getEditForumAction');
Route::post('/admin/contents/forum/{id}/edit', 'Admin\BaseController@postEditForumAction');
Route::get('/admin/contents/forum/{page_id}/delete', 'Admin\BaseController@deleteForumTopicAction');
Route::post('/admin/contents/forum/{page_id}/{message_id}/delete', 'Admin\BaseController@deleteForumTopicMessageAction');

Route::get('/admin/contents/fishes', 'Admin\BaseController@showFishesAction');
Route::get('/admin/contents/fishes/edit', 'Admin\BaseController@getEditFishAction');
Route::post('/admin/contents/fishes/edit', 'Admin\BaseController@postEditFishAction');
Route::get('/admin/contents/fishes/delete', 'Admin\BaseController@deleteFishAction');
Route::get('/admin/contents/fishes/add', 'Admin\BaseController@getAddFishAction');
Route::post('/admin/contents/fishes/add', 'Admin\BaseController@postAddFishAction');

Route::get('/admin/contents/news', 'Admin\BaseController@showNewsAction');
Route::get('/admin/contents/news/edit', 'Admin\BaseController@getEditNewsAction');
Route::post('/admin/contents/news/edit', 'Admin\BaseController@postEditNewsAction');
Route::get('/admin/contents/news/delete', 'Admin\BaseController@deleteNewsAction');
Route::get('/admin/contents/news/add', 'Admin\BaseController@getAddNewsAction');
Route::post('/admin/contents/news/add', 'Admin\BaseController@postAddNewsAction');
Route::get('/admin/contents/news/update', 'Admin\BaseController@updateNewsAction');

Route::get('/admin/contents/about', 'Admin\BaseController@getEditAboutAction');
Route::post('/admin/contents/about', 'Admin\BaseController@postEditAboutAction');

Route::get('/admin/contents/contacts', 'Admin\BaseController@getEditContactsAction');
Route::post('/admin/contents/contacts', 'Admin\BaseController@postEditContactsAction');

//authC
Route::get('/admin/register', 'Admin\AuthController@getRegisterAction');
Route::post('/admin/register', 'Admin\AuthController@postRegisterAction');
Route::get('/admin/login', 'Admin\AuthController@getLoginAction');
Route::post('/admin/login', 'Admin\AuthController@postLoginAction');
Route::get('/admin/logout', 'Admin\AuthController@logoutAction');