<?php

class GeoController extends BaseController {


    public function getNearby() {

        $me = Auth::getUser();

        $cos = cos(deg2rad($me -> geo_x));

        $users = User::whereBetween('geo_x', array($me -> geo_x - 40.0 / 111.319, $me -> geo_x + 40.0 / 111.319))
            ->whereBetween('geo_y', array($me -> geo_y - $cos * (40.0 / 111.319), $me -> geo_y + $cos * (40.0 / 111.319)))
            ->get();

        $user_distance = array();

        foreach ($users as $user) {

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

        return View::make('geo.nearby') -> with('users', $user_distance);
    }

    public function postLocation($location) {
        $user = Auth::getUser();
        $geo_xy = explode(',', $location, 2);

        $user -> geo_x = $geo_xy[0];
        $user -> geo_y = $geo_xy[1];

        if ($user->save()) {
            return Redirect::route('home')
                -> with('global', 'Your location has been successfully changed.');
        }
    }
}
