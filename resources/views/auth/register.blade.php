@extends('layouts.main')

@section('content')
<div class="md-card-content large-padding" id="register_form">
    <h2 class="heading_a uk-margin-medium-bottom">Create an account</h2>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="uk-form-row">
            <label for="name">Name</label>
            <input class="md-input" type="text" id="name" name="name" value="{{ old('name') }}" required />
        </div>
        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
        <div class="uk-form-row">
            <label for="email">E-mail</label>
            <input class="md-input" type="email" id="email" name="email" value="{{ old('email') }}" required />
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
        <div class="uk-margin-medium-top">
            <button type="submit" class="md-btn md-btn-primary md-btn-block md-btn-large">Sign Up</button>
        </div>
    </form>
</div>
@endsection
@section('link')
<a href="{{ route('login') }}">Login</a>
@endsection

