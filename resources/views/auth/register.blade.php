@extends('web.layout')

@section('title')
    Sign Up
@endsection
@section('main')

    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay"
            style="background-image:url({{ asset('web/img/page-background.jpg') }})"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="{{ url('/') }}">@lang('web.home')</a></li>
                        <li>@lang('web.signup')</li>
                    </ul>
                    <h1 class="white-text">@lang('web.registerTitle')</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- login form -->
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <h4>@lang('web.signup')</h4>
                        @include('web.inc.messages')
                        <form method="POST" action="{{ url('/register') }}">
                            @csrf
                            <input class="input" type="text" name="name" placeholder="@lang('web.name')">
                            <input class="input" type="email" name="email" placeholder="@lang('web.email')">
                            <input class="input" type="password" name="password" placeholder="@lang('web.password')">
                            <input class="input" type="password" name="password_confirmation"
                                placeholder="@lang('web.passwordConf')">
                            <button type="submit" class="main-button icon-button pull-right">@lang('web.signup')</button>
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
