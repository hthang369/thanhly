@props([])
<div>
    {!! Form::open(['method' => 'POST', 'role' => 'form', 'class' => 'php-email-form needs-validation', 'route' => 'page.send-mail']) !!}
    <div class="row g-3">
        <div class="col-6">
            {!! Form::text('fullname', '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Họ tên', 'data-rule' => 'minlen:4', 'data-msg' => 'Vui lòng nhập ít nhất 4 ký tự', 'required']) !!}
            <div class="validate invalid-feedback"></div>
        </div>
        <div class="col-6">
            {!! Form::email('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'data-rule' => 'email', 'data-msg' => 'Vui lòng nhập địa chỉ email chính xác', 'required']) !!}
            <div class="validate valid-feedback"></div>
        </div>
        <div class="col-6">
            {!! Form::text('phone', '', ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Điện thoại', 'data-rule' => 'digits', 'data-msg' => 'Vui lòng nhập số', 'required']) !!}
            <div class="validate valid-feedback"></div>
        </div>
        <div class="col-6">
            {!! Form::text('address', '', ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Địa chỉ', 'data-rule' => 'required', 'data-msg' => 'Vui lòng nhập địa chỉ', 'required']) !!}
            <div class="validate valid-feedback"></div>
        </div>
        <div class="col-12">
            {!! Form::text('subject', '', ['class' => 'form-control', 'id' => 'subject', 'placeholder' => 'Tiêu đề', 'data-rule' => 'minlen:4', 'data-msg' => 'Vui lòng nhập tiêu đề ít nhất 4 ký tự', 'required']) !!}
            <div class="validate valid-feedback"></div>
        </div>
        <div class="col-12">
            {!! Form::textarea('content', '', ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Nội dung', 'data-rule' => 'required', 'data-msg' => 'Vui lòng nhập nội dung', 'required']) !!}
            <div class="validate valid-feedback"></div>
        </div>
        <div class="col-12">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
        </div>
        <div class="col-12 text-center">
            {!! Form::submit('Send Message', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
