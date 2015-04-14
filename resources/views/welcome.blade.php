@extends('app')

@section('content')
  <div class="splash-green">
    <div class="container">
      <div class="jumbotron">
        <h1>Fantasee</h1>
        <p>See more of your fantasy league</p>
        <p><a class="btn btn-default btn-lg" href="{{ route('leagues_path') }}" role="button">Take a look</a></p>
      </div>
    </div>
  </div>
  <div class="container">
    <br><br>
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
@stop
