@extends('app')

@section('content')
<section class="splash-mast">
<div class="container">
	<div class="row">
		<div class="col-sm-6 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Login</strong></div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-xs-12">
			<div class="panel panel-default">
			  <div class="panel-heading"><strong>Not registered?</strong></div>
			    <div class="panel-body">
						<p>Once you're logged in you can add your league to Fantasee and get things like total records, cumulative points scored, head-to-heads, and trade partners.</p>
						<p><a href="{{ url('auth/register') }}" class="btn btn-default  btn-block">Join now</a></p>
						<p><em>C'mon, Rich Eisen could run a 40 in the time it takes to create an account.</em></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
