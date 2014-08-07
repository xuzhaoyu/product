<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


	public function home() {

//          $user = User::find(2);
//          echo '<pre>', print_r($user->password), '</pre>';

//            Mail::send('emails.auth.test', array('name' => 'Alex'), function($message) {
//                $message->to('gubo8@qq.com', 'asdfasdf')->subject('test');
//            });

            return View::make('home');
	}
}
