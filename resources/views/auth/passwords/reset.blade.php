@extends('layouts.main')

@section('content')
<div class="md-card-content large-padding" id="login_password_reset">
    <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
    <h2 class="heading_a uk-margin-large-bottom">Reset password</h2>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">
        <div class="uk-form-row">
            <label for="login_email_reset">Your email address</label>
            <input class="md-input" type="email" id="email" name="email" value="{{ $email or old('email') }}" required/>
        </div>
        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        <div class="uk-form-row">
            <label for="password">Password</label>
            <input class="md-input" type="password" id="password" name="password" required />
        </div>
        @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
        <div class="uk-form-row">
            <label for="password-confirm">Repeat Password</label>
            <input class="md-input" type="password" id="password-confirm" name="password_confirmation" required />
        </div>
        @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
        <div class="uk-margin-medium-top">
            <button type="submit" class="md-btn md-btn-primary md-btn-block">Reset password</button>
        </div>
    </form>
</div>
@endsection
