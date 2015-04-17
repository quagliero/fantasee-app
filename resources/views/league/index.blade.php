@extends('app')

@section('content')
<section class="splash-mast">
  <div class="container">
    @if (Auth::check())
    <h1>Leagues using Fantasee
      <a href="{{ route('league_create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Add your league</a>
    </h1>
    @else
      <h1>Leagues using Fantasee</h1>
      <p class="alert alert-info"><i class="fa fa-info"></i>
        <strong><a href="{{ url('/auth/login') }}">Login</a></strong> or <strong><a href="{{ url('/auth/register') }}">Register</a></strong> to add your nfl.com fantasy league.</p>
    @endif
    <br>
    <div class="row">
      @foreach ($leagues as $league)
      <div class="col-md-3 col-sm-4 col-xs-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{{ $league->name }}</h3>
          </div>
            <ul class="list-group">
              <li class="list-group-item">
                <i class="fa fa-calendar"></i> <strong>Seasons</strong>
                <span class="badge">{{ $league->seasons->count() }}</span>
              </li>
              <li class="list-group-item">
                <i class="fa fa-user"></i> <strong>Managers</strong>
                <span class="badge">{{ $league->managers->count() }}</span>
              </li>
              <li class="list-group-item">
                <i class="fa fa-trophy"></i> <strong>Champions</strong>
                <span class="badge">{{ $league->getChampions() }}</span>
              </li>
              <li class="list-group-item">
                {!! link_to_route('league_path', 'Explore league', [$league->slug], ['class' => 'btn btn-success btn-block']) !!}
              </li>
            </ul>
          </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@stop
