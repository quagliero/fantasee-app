<header>
  <nav class="navbar navbar-static-top navbar-default site-nav">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="{{ url('/') }}" class="navbar-brand">Fantasee <i class="badge">pre-alpha</i></a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li>{!! link_to_route('leagues_path', 'Leagues') !!}</li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
          <li><a href="{{ url('/auth/login') }}">Login</a></li>
          <li><a href="{{ url('/auth/register') }}">Register</a></li>
          @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name ?: Auth::user()->email }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @if (Auth::check())
              <li>{!! link_to_route('user_path', 'Account', [Auth::user()->id]) !!}</li>
              @endif
              <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
            </ul>
          </li>
        @endif
        </ul>
      </div>
    </div>
  </nav>
</header>
