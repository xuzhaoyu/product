<nav>
    <ul>
        <li><a href="{{ URL::route('home') }}">Home</a></li>

        @if (Auth::check())
            <li><a href="{{ URL::route('account-logoff') }}">Log off</a></li>
            <li><a href="{{ URL::route('account-change-password') }}">Change Password</a></li>
            <li><a href="{{ URL::route('geo-get-nearby') }}">Find Nearby</a></li>
            <li><a href="{{ URL::route('friend-get-list') }}">Get List</a></li>
            <li><a href="{{ URL::route('profile-get-photo') }}">Profile Photo</a></li>
        @else
            <li><a href="{{ URL::route('account-create') }}">Create an account</a></li>
            <li><a href="{{ URL::route('account-login') }}">Log in</a></li>
        @endif
    </ul>
</nav>
