@extends('layout.main')


@section('content')

<?php
    echo 'Friend Lists:';

foreach ($users as $item) {

    print_r($item['name']);
    echo ',';
    print_r($item['distance']);
    echo '|';

}
    echo '<br>';
?>

@stop
