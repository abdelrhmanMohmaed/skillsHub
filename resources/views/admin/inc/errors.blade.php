@if ($errors->any())
    <div class="contact-form  ">
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p style="padding: 7px">{{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif
