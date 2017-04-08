@extends('layouts.main')

@section('content')
<div class="md-card-content large-padding" id="login_password_reset">
    <h2 class="heading_a uk-margin-large-bottom">Reset password</h2>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <div class="uk-form-row">
            <label for="login_email_reset">Your email address</label>
            <input class="md-input" type="email" id="email" name="email" value="{{ old('email') }}" required/>
        </div>

        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        <div class="uk-margin-medium-top">
            <button type="submit" class="md-btn md-btn-primary md-btn-block">Reset password</button>
        </div>
    </form>
</div>
@endsection
@section('link')
<a href="{{ route('login') }}">Login</a>
@endsection
