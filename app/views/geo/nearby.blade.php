@extends('layout.main')


@section('content')

<br>

Nearby:<?php

        foreach ($users as $item) {

            print_r($item['name']);
            echo ',';
            print_r($item['distance']);
            echo ',';
            print_r($item['degree']);
            echo ',';
            print_r($item['year']);
            echo ',';
            print_r($item['field']);
            echo ',';
            print_r($item['id']);
            echo '|';
//
        }
?><br>


@stop
