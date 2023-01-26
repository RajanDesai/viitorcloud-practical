<div class="col-md-6 offset-3">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <h3 class="">Register your comapny</h3>
      </div>
      <div class="card-body">
  
        <form action="{{ route('signup') }}" method="post" name="signup_form" id="signup_form">
            @csrf
            <div class="form-group mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Comapny name">
                @error('name')
                    <span class="error">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                @error('email')
                    <span class="error">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="website" placeholder="Website">
                @error('website')
                    <span class="error">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="license_no" placeholder="License Number">
                @error('license_no')
                    <span class="error">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <textarea class="form-control" name="address" placeholder="Address" rows="3"></textarea>
                @error('address')
                    <span class="error">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="city" placeholder="City">
                @error('city')
                    <span class="error">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="state" placeholder="State">
                @error('state')
                    <span class="error">{{ $message }}</span>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" name="country" placeholder="Country">
                @error('country')
                    <span class="error">{{ $message }}</span>
                    @enderror
            </div>
          <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>