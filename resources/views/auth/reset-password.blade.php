@extends('web.layout')
@section('title')
Reset Password
@endsection
@section('main')

<!-- Contact -->
<div id="contact" class="section">

    <!-- container -->
    <div class="container">

        <!-- row -->
        <div class="row">

            <!-- login form -->
            <div class="col-md-6 col-md-offset-3">
                <div class="contact-form">

                    <h4>@lang('web.resetPassword')</h4>

                    @include('web.inc.messages')

                    <form method="POST" action="{{ url('reset-password') }}">
                        @csrf
                        <input class="input" type="email" name="email" placeholder="@lang('web.email')">
                        <input class="input" type="password" name="password" placeholder="@lang('web.password')">
                        <input class="input" type="password" name="password_confirmation" placeholder="@lang('web.passwordConf')">
                        <input class="input" type="hidden" name="token" value="{{ request()->route('token') }}">
                        <br>
                        <button type="submit" class="main-button icon-button pull-right">@lang('web.signin')</button>
                    </form>
                </div>
            </div>
            <!-- /login form -->

        </div>
        <!-- /row -->

    </div>
    <!-- /container -->

</div>
<!-- /Contact -->
@endsection
