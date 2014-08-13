@extends('layout.main')


@section('content')

    @if (Auth::check())
        <p> Hello {{ Auth::user()->username }} </p>
        <?php
            echo 'Your_id:';
            echo Auth::user()->id;
            echo '|<br>';
        ?>
    @else
        <p> You are not signed in yet. </p>
    @endif

@stop
