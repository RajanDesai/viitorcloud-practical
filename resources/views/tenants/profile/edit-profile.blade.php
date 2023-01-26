@extends('tenants.layouts.master')

@section('main-content')
<div class="row mt-5">
    <div class="col-md-6 offset-3">
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <h3 class="">Edit your profile</h3>
          </div>
          <div class="card-body">
      
            <form action="{{ route('tenants.postprofile', $tenant->slug) }}" method="post" id="edit_profile_form">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Comapny name" value="{{ $tenant->name }}">
                    @error('name')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $tenant->email }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="website" placeholder="Website" value="{{ $tenant->website }}">
                    @error('website')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="license_no" placeholder="License Number" value="{{ $tenant->license_no }}">
                    @error('license_no')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <textarea class="form-control" name="address" placeholder="Address" rows="3">{{ $tenant->address }}</textarea>
                    @error('address')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="city" placeholder="City" value="{{ $tenant->city }}">
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="state" placeholder="State" value="{{ $tenant->state }}">
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="country" placeholder="Country" value="{{ $tenant->country }}">
                </div>
              <div class="row">
                <div class="col-4">
                </div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
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

    $('#edit_profile_form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 100,
                /* remote: {
                    url: baseUrl + "check-company-name",
                    type: "get",
                    data: {
                        name: function() {
                            return $( "#name" ).val();
                        }
                    }
                } */
            },
            email: {
                required: true,
                maxlength: 100,
                validate_email: true,
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