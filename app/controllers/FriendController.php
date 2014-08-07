<?php

class FriendController extends BaseController {


    public function getFriend() {

        $me = Auth::getUser();

        $user = DB::table('users')
            -> join('friend', 'users.id', '=', 'friend.small_id')
            -> select('small_id', 'big_id')
            -> where('small_id ');
        //return View::make('friend.friendList', $user);
        return Redirect::route('home')
            -> with('global', $user -> id);

    }

}
