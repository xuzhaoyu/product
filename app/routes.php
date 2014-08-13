<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', array(
		'as' => 'home',
		'uses' => 'HomeController@home'
));

Route::get('users/{username}', array(
        'as' => 'profile',
        'uses' => 'ProfileController@user'
));

Route::group(array('before' => 'guest'), function(){

    Route::group(array('before' => 'csrf'), function(){

        Route::post('/account/create', array(
            'as' => 'account-create-post',
            'uses' => 'AccountController@postCreate'
        ));

        Route::post('/account/login', array(
            'as' => 'account-login-post',
            'uses' => 'AccountController@postLogin'
        ));

    });

    Route::get('/account/create', array(
        'as' => 'account-create',
        'uses' => 'AccountController@getCreate'
    ));

    Route::get('/account/login', array(
        'as' => 'account-login',
        'uses' => 'AccountController@getLogin'
    ));

    Route::get('/account/activate/{code}', array(
        'as' => 'account-activate',
        'uses' => 'AccountController@getActivate'
    ));

});

Route::group(array('before' => 'auth'), function() {

    Route::get('/account/logoff', array(
        'as' => 'account-logoff',
        'uses' => 'AccountController@getLogoff'
    ));

    Route::get('/account/change-password', array(
        'as' => 'account-change-password',
        'uses' => 'AccountController@getChangePassword'
    ));

    Route::get('/geo/get-nearby', array(
        'as' => 'geo-get-nearby',
        'uses' => 'GeoController@getNearby'
    ));

    //Using get!!!
    Route::get('/geo/post-location/{location}', array(
        'as' => 'geo-post-location',
        'uses' => 'GeoController@postLocation'
    ));

    Route::get('/friend/get-list', array(
        'as' => 'friend-get-list',
        'uses' => 'FriendController@getFriend'
    ));

    Route::get('/profile/get-photo', array(
        'as' => 'profile-get-photo',
        'uses' => 'PhotoController@getPhoto'
    ));

    Route::get('/profile/get-info/{id}', array(
        'as' => 'profile-get-info',
        'uses' => 'FriendController@getProfileInfo'
    ));

    Route::group(array('before' => 'csrf'), function(){

        Route::post('/account/change-password', array(
            'as' => 'account-change-password-post',
            'uses' => 'AccountController@postChangePassword'
        ));

    });

});