@extends('layout.main')


@section('content')

<br>

Nearby:<?php

        foreach ($users as $item) {

            print_r($item['name']);
            echo ',';
            print_r($item['distance']);
            echo '|';
//
        }
?><br>


@stop
