<?php

class AccountController extends BaseController {

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



    public function getCreate() {
        return View::make('account.create');
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), array(
            'email'           =>  'required|max:50|email|unique:users',
            'username'        =>  'required|max:20|unique:users',
            'password'        =>  'required|max:60|min:6',
            'password_again'  =>  'required|max:60|same:password'
        ));

        if ($validator->fails()) {
            return Redirect::route('account-create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $email = Input::get('email');
            $username = Input::get('username');
            $password = Hash::make(Input::get('password'));
            //$code = str_random(60);

            $user = User::create(array(
                'email'         => $email,
                'username'      => $username,
                'password'      => $password,
                'active'        => '1'
                //'code'          => $code,
                //'active'        => '0'
            ));

            if ($user) {

                //Mail::send('emails.auth.activation',  array('username' => $username, 'link' => URL::route('account-activate', $code)), function($message) use($user)
                //{
                //    $message->to($user->email, $user->username)->subject('Activate your account');
                //});

                return Redirect::route('home')
                    -> with('global', 'Your account has already been created. Check your email to activate your account! ');
            }
        }

    }

    public function getActivate($code) {

        $user = User::where('code','=',$code)->where('active','=',0);
        //echo '<pre>', print_r($user->first()), '</pre>';

        //echo '<pre>', print_r($user->count()), '</pre>';

        if ($user->count()) {

            $user = $user->first();

            $user->code = '';
            $user->active = 1;

            if ($user->save()) {
                return Redirect::route('home') ->
                    with('global', 'Your account has been activated.');
            }

        }

        return Redirect::route('home') ->
            with('global', 'Opps! Error.');

    }

    protected function getLogoff(){
        Auth::logout();
        return Redirect::route('home');
    }

    protected function getLogin(){
        return View::make('account.login');
    }

    protected function postLogin() {

        $validator = Validator::make(Input::all(), array(
            'email'           =>  'required|max:50|email',
            'password'        =>  'required|max:60|min:6',
        ));

        if ($validator->fails()) {
            return Redirect::route('account-login')
                ->withErrors($validator)
                ->withInput();
        } else {

//            $email = Input::get('email');
//            $password = Input::get('password');

//            echo '<pre>', $email, '</pre>';
//            echo '<pre>', $password, '</pre>';


            $remember = Input::has('remember') ? true : false;

            $auth = Auth::attempt(array(
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'active' => 1,
            ), $remember);

            if ($auth) {

//                echo 'asdfkjhskdjfh';

                return Redirect::route('home');
            } else {
                return Redirect::route('account-login')
                    -> with('global', 'Username or password wrong...');
            };

        }

        return Redirect::route('account-login')
            -> with('global', 'We got a problem to log you in...');

    }

    protected function getChangePassword() {
        return View::make('account.password');
    }

    protected function postChangePassword() {

/*        echo Input::get('password');
        echo '<br>';
        echo Input::get('new_password_again');
        echo '<br>';
        echo Input::get('new_password');
*/

        $validator = Validator::make(Input::all(), array(
            'password'        =>  'required|max:60|min:6',
            'new_password'        =>  'required|max:60|min:6',
            'new_password_again'  =>  'required|max:60|min:6|same:new_password'
        ));

        if ($validator->fails()) {
            return Redirect::route('account-change-password')
                -> withErrors($validator);
        } else {
            $user = Auth::getUser();
//            echo $user->password;
//            echo Input::get('password');

            if (Hash::check(Input::get('password'), $user->password)) {
                //$temp = User::find($user->id);
//                echo $temp->password;
//                echo '<br>';
                $user->password = Hash::make(Input::get('new_password'));
//                echo $temp->password;
                if ($user->save()) {
                    return Redirect::route('home')
                        -> with('global', 'Your password has been successfully changed.');
                }

            } else {
                return Redirect::route('account-change-password')
                    -> with('global', 'The old password is incorrect.');
            }
        }


    }


}