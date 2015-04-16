<form role="form" method="POST" action="{{ url('/auth/register') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <!-- <div class="form-group">
    <label class="col-md-4 control-label">Name</label>
    <div class="col-md-6">
      <input type="text" class="form-control" name="name" value="{{ old('name') }}">
    </div>
  </div> -->

  <div class="form-group">
    <label class="control-label">E-Mail Address</label>
      <input type="email" class="form-control" name="email" value="{{ old('email') }}">
  </div>

  <div class="form-group">
    <label class="control-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>

  <div class="form-group">
    <label class="control-label">Confirm Password</label>
    <input type="password" class="form-control" name="password_confirmation">
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-primary">Register</button>
  </div>
  <div class="form-group">
    <small class="help-block">We&rsquo;ll never trade your email. Ever. Not even {!! get_random_register_analogy() !!}.</small>
  </div>
</form>
