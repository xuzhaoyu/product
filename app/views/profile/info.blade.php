@extends('layout.main')

@section('content')
<?php
    echo 'profile:';
    echo $profile->username;
    echo ',,,,,';
    echo $num_friend;
    echo ',,,,,';
    echo $profile->school;
    echo ',,,,,';
    echo $profile->degree;
    echo ',,,,,';
    echo $profile->current_job;
    echo ',,,,,';
    echo $profile->summary;
    echo ',,,,,';
    echo $profile->experience;
    echo ',,,,,';
    echo $profile->email;
    echo ',,,,,';
    echo $profile->phone;
    echo '|<br>';
?>
@stop