@extends('web.layout')

@section('title')
Verify Email
@endsection

@section('main')


<!-- container -->
<div class="container">
    <div class="row"> 
        <div class="col-md-6 col-md-offset-3">
            <div class="contact-form h-75">
                <div class="alert alert-success">
                    A Verification Email sent successfully, please check your Inbox
                </div>
                <form method="POST" action="{{ url('email/verification-notification') }}">
                    @csrf
                    <button type="submit" class="main-button icon-button pull-right">Resend Email</button>
                </form>
            </div>
        </div>
    </div>
    @endsection
