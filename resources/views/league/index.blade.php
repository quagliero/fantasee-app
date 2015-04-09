@extends('app')

@section('content')
<h1>Leagues using Fantasee</h1>
@if (Auth::check())
  <p>{!! link_to_route('league_create', 'Add new league', null, ['class="btn btn-primary"'])!!}</p>
@else
  <p class="alert alert-info"><i class="glyphicon glyphicon-info-sign"></i>
    <strong><a href="{{ url('/auth/login') }}">Login</a></strong> or <strong><a href="{{ url('/auth/register') }}">Register</a></strong> to add your nfl.com fantasy league.</p>
@endif

<div class="row">
  @foreach ($leagues as $league)
  <div class="col-md-3 col-sm-4 col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">{{ $league->name }}</h3>
      </div>
        <ul class="list-group">
          <li class="list-group-item">
            <i class="glyphicon glyphicon-calendar"></i> <strong>Seasons</strong>
            <span class="badge">{{ $league->seasons->count() }}</span>
          </li>
          <li class="list-group-item">
            <i class="glyphicon glyphicon-user"></i> <strong>Managers</strong>
            <span class="badge">{{ $league->managers->count() }}</span>
          </li>
          <li class="list-group-item">
            <i class="glyphicon glyphicon-king"></i> <strong>Champions</strong>
            <span class="badge">3</span>
          </li>
          <li class="list-group-item">
            {!! link_to_route('league_path', 'Explore league', [$league->slug], ['class' => 'btn btn-primary btn-block']) !!}
          </li>
        </ul>
      </div>
  </div>
  @endforeach
</div>
@stop
