@extends('layouts.main')

@section('content')
<div class="md-card-content large-padding" id="login_form">
    <div class="login_heading">
        <div class="user_avatar"></div>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="uk-form-row">
            <label for="login_username">Email</label>
            <input class="md-input" type="email" id="email" required name="email" value="{{ old('email') }}" />
        </div>
        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        <div class="uk-form-row">
            <label for="login_password">Password</label>
            <input class="md-input" type="password" id="login_password" required name="password" />
        </div>
        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
        <div class="uk-margin-medium-top">
            <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign In</button>
        </div>
        <div class="uk-margin-top">
            <a href="{{ route('password.request') }}" class="uk-float-right">Forgot Password?</a>
            <span class="icheck-inline">
                <input type="checkbox" name="remember" id="login_page_stay_signed" data-md-icheck {{ old('remember') ? 'checked' : '' }} />
                <label for="login_page_stay_signed" class="inline-label">Stay signed in</label>
            </span>
        </div>
    </form>
</div>
@endsection
@section('link')
<a href="{{ route('register') }}">Create an account</a>
@endsection
