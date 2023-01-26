@extends('tenants.layouts.master')

@section('main-content')
<div class="row mt-5">
    <div class="col-md-6 offset-3">
        <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1><b>{{ ucwords($tenant->name) }}</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>
    
            <form action="{{ route('tenants.postLogin', $tenant->slug) }}" method="post" id="login_form">
                @csrf
            <div class="form-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email">
                @error('email')
                    <span class="error">{{ $message }}</span>    
                @enderror
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                @error('password')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="row">
                <div class="col-4">
                </div>
                <!-- /.col -->
                <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
            </form>
        </div>
        <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script>
    $(function () {
      $('#login_form').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            maxlength: 16
          }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
</script>
@endsection