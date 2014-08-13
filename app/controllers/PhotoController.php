<?php

class PhotoController extends BaseController {

    public function getPhoto() {
//        echo public_path() . '/profile_image/12/profile_photo.png';
//        return Response::download(public_path() . '/profile_image/12/profile_photo.png');

//        echo $url = asset(public_path() . '/profile_image/12/profile_photo.png');
        return View::make('profile.photo');

    }

    public function postLocation($location) {

    }
}
