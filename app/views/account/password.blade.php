@extends('layout.main')


@section('content')
<form action=" {{ URL::route('account-change-password-post') }} " method="post">

    <div>
        Old Password: <input type="password" name="password">
        @if ($errors->has())
        {{ $errors->first("password") }}
        @endif
    </div>

    <div>
        New Password: <input type="password" name="new_password">
        @if ($errors->has())
        {{ $errors->first("new_password") }}
        @endif
    </div>

    <div>
        New Password Again: <input type="password" name="new_password_again">
        @if ($errors->has())
        {{ $errors->first("new_password_again") }}
        @endif
    </div>

    <br>

    <input type="submit" value="Reset Password">
    {{ Form::token() }}
</form>
@stop
