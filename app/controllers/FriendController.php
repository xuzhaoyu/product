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
                -> select('users.username', 'geo_x', 'geo_y')
                -> where('friend.big_id', '=', $temp)

            -> union(

                DB::table('users') -> join('friend', 'users.id', '=', 'friend.big_id')
                -> select('users.username', 'geo_x', 'geo_y')
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
            $user_distance[] = array('name' => $user->username,
                'distance' => $dist);
        }

        return View::make('friend.friendList') -> with('users', $user_distance);

    }

}
