@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h1>{{ $league->name }}</h1>
    </div>
    <div class="col-sm-6 text-right">
      <br>
      @if (is_league_admin($league->id))
    {!! link_to_route('league_edit', 'Edit', [$league->slug], ['class' => 'btn btn-info']) !!}
      @endif
    </div>
  </div>
  <ul class="nav nav-tabs">
  <li class="active">{!! link_to_route('league_path', 'Overall', [$league->slug]) !!}</li>
  @foreach ($league->seasons as $season)
    <li>{!! link_to_route('league_season_path', $season->year, [$league->slug, $season->year]) !!}</li>
  @endforeach
  </ul>
  <br>
  <ul class="nav nav-pills">
    <li>{!! link_to_route('league_path', 'Managers', [$league->slug]) !!}</li>
    <li>{!! link_to_route('league_teams_path', 'Teams', [$league->slug]) !!}</li>
    <li>{!! link_to_route('league_drafts_path', 'Drafts', [$league->slug]) !!}</li>
    <li class="active">{!! link_to_route('league_trades_path', 'Trades', [$league->slug]) !!}</li>
  </ul>
  <br>
  <table class="table table-striped">
    <thead>
      <th>Week</th>
      <th>Player(s) exchanged</th>
    </thead>
    <tbody>

    </tbody>
  </table>

  <p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
</div>
@stop
