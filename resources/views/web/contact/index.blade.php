@extends('web.layout')

@section('title')
Contact Us
@endsection

@section('main')
<!-- Hero-area -->
<div class="hero-area section">

    <!-- Backgound Image -->
    <div class="bg-image bg-parallax overlay" style="background-image:url({{ asset('web/img/page-background.jpg') }})"></div>
    <!-- /Backgound Image -->

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <ul class="hero-area-tree">
                    <li><a href="{{ url('/') }}">@lang('web.home')</a></li>
                    <li>@lang('web.contact')</li>
                </ul>
                <h1 class="white-text">@lang('web.getInTouch')</h1>

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

            <!-- contact form -->
            <div class="col-md-6">
                <div class="contact-form">
                    <h4>@lang('web.sendMsg')</h4>
                    {{-- @include('web.inc.messages-ajax') --}}
                    @include('web.inc.messages')
                    <form method="POST" action="{{ url('/contact/message/send') }}">
                        @csrf
                        <input class="input" type="text" name="name" placeholder="@lang('web.name')">
                        <input class="input" type="email" name="email" placeholder="@lang('web.email')">
                        <input class="input" type="text" name="subject" placeholder="@lang('web.submit')">
                        <textarea class="input" name="body" placeholder="@lang('web.msg')"></textarea>
                        <button id="contact-form-btn" type="submit" class="main-button icon-button pull-right">@lang('web.send')</button>
                    </form>
                </div>
            </div>
            <!-- /contact form -->

            <!-- contact information -->
            <div class="col-md-5 col-md-offset-1">
                <h4>@lang('web.contactInFo')</h4>
                <ul class="contact-details">
                    <li><i class="fa fa-envelope"></i>{{ $sett->email }}</li>
                    <li><i class="fa fa-phone"></i>{{ $sett->phone }}</li>
                </ul>

            </div>
            <!-- contact information -->

        </div>
        <!-- /row -->

    </div>
    <!-- /container -->

</div>
<!-- /Contact -->

@endsection
@section('scripts')
{{-- <script>
    $('#success-div').hide();
    $('#errors-div').hide();
    $('#contact-form-btn').click(function(e) {

        $('#success-div').hide();
        $('#errors-div').hide();
        $('#success-div').empty();
        $('#errors-div').empty();

        e.preventDefault();
        let formData = new FormData($('#contact-form')[0]);

        $.ajax({
            type: "POST"
            , url: "{{ url('contant/message/send') }}"
, data: formData
, contentType: false
, processData: false,

success: function(data) {
$('#success-div').show();
$('#success-div').text(data.success);
console.log(data.success)
resetForm()

}
, error: function(xhr, status, error) {

$('#errors-div').show();

$.each(xhr.responseJSON.errors, function(key, item) {
$('#errors-div').append("<p>" + item + "</p>");
});
}
});

})
//reset form
function resetForm() {
for (var i = 0; i < $('.input').length; i++) { $('.input')[i].value="" ; } } </script> --}}

    @endsection
