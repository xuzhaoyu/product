<?php

class ProfileController extends BaseController {

    public function user($username) {
        $user = User::where('username', '=', $username);
        echo $user->first();
        if ($user->count())
            return View::make('layout.profile', $user->first());

        return App::abort(404);
    }

}