@if (session('msg'))
<div class="contact-form h-75">
    <div class="alert alert-secondary">
        <p style="padding: 4px"> {{ session('msg') }}</p>
    </div>
</div>
@endif
