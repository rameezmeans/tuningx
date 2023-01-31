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
                            <h1 style="font-family: Roboto, sans-serif;">{{__('Thank You.')}} !</h1>
                            <span>{{__('Your Precious Feedback is Recorded.')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
