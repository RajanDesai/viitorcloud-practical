@extends('tenants.layouts.master')

@section('main-content')
<div class="row">
    @if(!auth()->check())
    @include('tenants.auth.signup')
    @endif
</div>
@endsection

@section('page-js')
<script>
$(function () {
    var baseUrl = "{{ url('/') }}";
    jQuery.validator.addMethod("strong_password", function(value, element) {
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/.test(value)
    }, 'Password should contain at least one lower case letter, one upper case letter, one number and one special character.')
    jQuery.validator.addMethod("validate_email", function(value, element) {
        return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)
    }, 'Please enter valid email.')
    jQuery.validator.addMethod("validate_url", function(value, element) {
        return /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/.test(value)
    }, 'Please enter valid website URL.')

    $('#signup_form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 100,
            },
            email: {
                required: true,
                maxlength: 100,
                validate_email: true,
            },
            password: {
                required: true,
                maxlength: 16,
                minlength: 8,
                strong_password: true
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
            website: {
                required: true,
                validate_url: true
            },
            license_no: {
                required: true,
                maxlength: 50
            },
            address: {
                required: true,
                maxlength: 500
            },
            country: {
                maxlength: 100
            },
            state: {
                maxlength: 100
            },
            city: {
                maxlength: 100
            },
        },
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
    });
});
</script>
@endsection