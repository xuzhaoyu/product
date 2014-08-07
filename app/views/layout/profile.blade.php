@extends('layout.main')

@section('content')
This is {{$username}}'s profile.<br>
Email: {{$email}}<br>
Account Created at: {{$created_at}}<br>
Last Update at: {{$updated_at}}<br>
@stop