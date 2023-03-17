@props([])
<div>
    {!! Form::open(['method' => 'POST', 'role' => 'form', 'class' => 'php-email-form', 'route' => 'page.send-mail']) !!}
    <div class="form-row">
        <div class="col-md-6 form-group">
            {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Your Name', 'data-rule' => 'minlen:4', 'data-msg' => 'Please enter at least 4 chars', 'required']) !!}
            <div class="validate"></div>
        </div>
        <div class="col-md-6 form-group">
            {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Your Email', 'data-rule' => 'email', 'data-msg' => 'Please enter a valid email', 'required']) !!}
            <div class="validate"></div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::text('subject', '', ['class' => 'form-control', 'id' => 'subject', 'placeholder' => 'Subject', 'data-rule' => 'minlen:4', 'data-msg' => 'Please enter at least 8 chars of subject', 'required']) !!}
        <div class="validate"></div>
    </div>
    <div class="form-group">
        {!! Form::textarea('message', '', ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Message', 'data-rule' => 'required', 'data-msg' => 'Please write something for us', 'required']) !!}
        <div class="validate"></div>
    </div>
    <div class="mb-3">
        <div class="loading">Loading</div>
        <div class="error-message"></div>
        <div class="sent-message">Your message has been sent. Thank you!</div>
    </div>
    <div class="text-center">
        {!! Form::submit('Send Message', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
