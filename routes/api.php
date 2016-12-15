<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');




Route::group([], function () {
    // account
    Route::post('/account/register', 'AccountController@register');
    Route::post('/account/login', 'AccountController@login');
    Route::post('/account/logout', 'AccountController@logout');
    Route::get('/account/profile', 'AccountController@getProfile');
    Route::put('/account/profile', 'AccountController@updateProfile');
    Route::put('/account/configs', 'AccountController@configs');
    Route::post('/account/password_reset', 'AccountController@passwordReset');
    Route::post('/account/password_modify', 'AccountController@passwordModify');
    // users
    Route::resource('/users', 'UserController');
    Route::post('/users/{user_id}/relationship', 'UserRelationshipController@store');
    Route::get('/users/{user_id}/followers', 'UserRelationshipController@followers');
    Route::get('/users/{user_id}/following', 'UserRelationshipController@following');
    Route::get('/users/{user_id}/topics', 'UserController@topics');
    Route::get('/users/{user_id}/subscribes', 'UserController@subscribes');
    Route::get('/users/{user_id}/upvotes', 'UserController@upvotes');
    // categories
    Route::resource('/categories', 'CategoryController');
    Route::get('/categories/{category_id}/topics', 'CategoryController@topics');
    Route::get('/categories/{category_id}/articles', 'CategoryController@articles');
    // topics
    Route::get('/topics/latest', 'TopicController@latest');
    Route::get('/topics/popular', 'TopicController@popular');
    Route::resource('/topics', 'TopicController');
    Route::get('/topics/{topic_id}/articles', 'TopicController@articles');
    Route::get('/topics/{topic_id}/subscribers', 'TopicSubscriberController@subscribers');
    Route::post('/topics/{topic_id}/subscribe', 'TopicSubscriberController@subscribe');
    Route::post('/topics/{topic_id}/unsubscribe', 'TopicSubscriberController@unsubscribe');
    // articles
    Route::resource('/articles', 'ArticleController');
    Route::resource('/articles/{article_id}/votes', 'ArticleVoteController');
    Route::resource('/articles/{article_id}/comments', 'ArticleCommentController');
    Route::get('/articles/{article_id}/viewers', 'ArticleViewerController@index');
    // tags
    Route::resource('/tags', 'TagController');
    Route::get('/tags/{name}/articles', 'TagController@articles');
    // notifications
    Route::get('/notifications/counts', 'NotificationController@counts');
    Route::post('/notifications/mark_as_read', 'NotificationController@markAsRead');
    Route::resource('/notifications', 'NotificationController');
    // assets
    Route::resource('/assets', 'AssetController');
    // qiniu
    Route::get('/qiniu/token', 'QiniuController@token');
});
