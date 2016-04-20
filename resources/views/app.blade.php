<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fantasee | See more of your fantasy league</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <!-- Fonts -->
  <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

  <!-- Html5 shim and Respond.js for IE8 support of Html5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  @if (App::environment('production'))
  @include('common.analytics')
  @endif
  @include('common.header')
  <main>
    @yield('content')
	</main>
	@include('common.footer')

  @section('scripts')
  @if (App::environment('local'))
  {!! Html::script('bower_components/jquery/dist/jquery.min.js') !!}
  {!! Html::script('bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.min.js') !!}
  @else
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
  @endif
  @show
</body>
</html>
