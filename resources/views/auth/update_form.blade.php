<form role="form" method="PUT" action="{{ url('/auth/update') }}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label class="control-label">Name</label>
    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
  </div>

  <div class="form-group">
    <label class="control-label">E-Mail Address</label>
      <input type="email" class="form-control" name="email" value="{{ $user->email }}">
  </div>

  <div class="alert alert-warning">
    <div class="form-group">
      <label class="control-label">New Password</label>
      <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
      <label class="control-label">Confirm Password</label>
      <input type="password" class="form-control" name="password_confirmation">
    </div>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
  <div class="form-group">
    <small class="help-block">We&rsquo;ll never trade your email. Ever. Not even {!! get_random_register_analogy() !!}.</small>
  </div>
</form>
