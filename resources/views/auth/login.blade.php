@extends('layouts.app')

@section('content')
<div id= "login-register-container">
    <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div id = "input-container">
            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @if ($errors->has('email'))
                <span class="error">
                {{ $errors->first('email') }}
                </span>
            @endif

            <label for="password" >Password</label>
            <input id="password" type="password" name="password" required>
            @if ($errors->has('password'))
                <span class="error">
                    {{ $errors->first('password') }}
                </span>
            @endif
        </div>
        <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
        </label>
        <div id= "buttons container">
            <button type="submit">
                Login
            </button>
            <a class="button button-outline" href="{{ route('register') }}">Register</a>
        </div>
    </form>
</div>
@endsection
