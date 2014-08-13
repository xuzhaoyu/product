<?php

class FriendController extends BaseController {


    public function getFriend() {

        $me = Auth::getUser();

        $temp = $me -> id;

//        $user = DB::table('users') -> join('friend', 'users.id', '=', 'friend.small_id')
//                -> select('small_id', 'big_id')
//                -> where('users.id', '=', $temp)
//
//            -> union(
//
//                DB::table('users') -> join('friend', 'users.id', '=', 'friend.big_id')
//                    -> select('small_id', 'big_id')
//                    -> where('users.id', '=', $temp)
//
//            ) -> get();

        $friends = DB::table('users') -> join('friend', 'users.id', '=', 'friend.small_id')
                -> select('users.username', 'geo_x', 'geo_y', 'users.degree', 'users.graduate_year', 'users.field', 'users.id')
                -> where('friend.big_id', '=', $temp)

            -> union(

                DB::table('users') -> join('friend', 'users.id', '=', 'friend.big_id')
                -> select('users.username', 'geo_x', 'geo_y', 'users.degree', 'users.graduate_year', 'users.field', 'users.id')
                -> where('friend.small_id', '=', $temp)

            ) -> get();

        $user_distance = array();

        foreach ($friends as $user) {

            $R = 6378.16;
//            (where R is the radius of the Earth)

            $lon2 = deg2rad($me -> geo_y);
            $lat2 = deg2rad($me -> geo_x);

            $lon1 = deg2rad($user ->geo_y);
            $lat1 = deg2rad($user ->geo_x);

            $dlon = $lon2 - $lon1;
            $dlat = $lat2 - $lat1;

            $a = pow(sin($dlat/2),2) + cos($lat1) * cos($lat2) * pow(sin($dlon/2), 2);
            $c = 2 * atan2( sqrt($a), sqrt(1-$a) );

            $dist = $R * $c;
            $user_distance[] = array('name' => $user->username, 'distance' => $dist,
                'degree' => $user->degree, 'year' => $user->graduate_year,
                'field' => $user->field, 'id' => $user->id);
        }

        return View::make('friend.friendList') -> with('users', $user_distance);

    }

    public function getProfileInfo($id) {

        $num = DB::table('users') -> join('friend', 'users.id', '=', 'friend.small_id')
                -> where('friend.big_id', '=', $id) ->count() +
            DB::table('users') -> join('friend', 'users.id', '=', 'friend.big_id')
                -> where('friend.small_id', '=', $id) -> count();

        $profile = DB::table('users') -> where('id', '=', $id) ->first();
        return View::make('profile.info') -> with('profile', $profile)
                                          -> with('num_friend', $num);
    }

}
