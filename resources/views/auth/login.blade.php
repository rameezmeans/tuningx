@extends('layouts.front')

@section('content')
<div class="login-grey-box"></div>
<div class="valign-wrapper">
    <div class="container valign">

        <div class="row m-n">
            <div id="login" class="col s12 m8 l6 offset-m2 offset-l3">
                <div class="watermark-back-middle-panel-thumb">
                                            <img src="https://resellers.ecutech.tech/assets/img/ecutech/logo_dark.png" class="responsive-img vehicle-watermark-back-wm">
                                    </div>
                                                                    <div id="login" class="register-panel">
                
                                                                        <div class="form-body">
                    <div class="center">
                        <h1 style="font-family: Roboto, sans-serif;">{{__('Hello')}} !</h1>
                        <span>{{__('Its nice to see you here again')}}</span>
                    </div>
                    <form action="{{ route('login') }}" name="login_form" method="post" class="login-form" role="form" id="form" novalidate="novalidate" data-bitwarden-watching="1">
                         @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="email" id="login_form_Email" name="email" required="required" class="validate valid" placeholder="{{__('Email')}}" data-com.bitwarden.browser.user-edited="yes" aria-invalid="false">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="password" id="login_form_Password" name="password" required="required" class="validate valid" placeholder="{{__('Password')}}" data-com.bitwarden.browser.user-edited="yes" aria-invalid="false">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                                                <div class="row">
                            <div class="input-field col s12 center">
                            <button type="submit" id="login_form_Login" name="login_form[Login]" class="waves-effect waves-light btn btn-red">{{__('Login')}}</button>
                            </div>
                        </div>
                    <input type="hidden" id="login_form__token" name="login_form[_token]" value="967c71b6fbb3be7de695b.FGsc3z5_d4x9ucc4467_ZAOYfnDfj-Ntn-D45H89GXU.JAJprVIPMf4P44VzluOaATPqKDyv24Er2dCJhgt6LCd9P3idfzNFvgrbrA"></form>
                    <div class="row">
                        <div class="col s12 center">
                            <p class="margin medium-small"><a href="/en/reset">{{__('Forgot password')}} ?</a></p>
                        </div>
                    </div>
                </div>
            </div>
                            <div class="row">
                <div class="col s12 center m-t-lg">
                    <a class="btn waves-effect waves-light btn-grey" href="/register">{{__('Sign up now')}} !</a>
                </div>
            </div>
                        </div>
    </div>

        {{-- <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection
