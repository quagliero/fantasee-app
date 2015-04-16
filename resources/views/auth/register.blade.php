@extends('app')

@section('content')
<section class="splash-mast">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>Register</strong></div>
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
						@include('auth/register_form')
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading"><strong>Already Fantaseeing?</strong></div>
					<div class="panel-body">
						<p>Right this way my friend.</p>
						<p class="text-center"><a href="{{ url('auth/login') }}" class="btn btn btn-default">Login</a></p>
					</div>
			</div>
		</div>
	</div>
</section>
@endsection
