@if(!Request::ajax())
@extends('app')
@endif

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <h1>{{ $league->name }} &mdash; {{ $season->year }} </h1>
      @if (is_league_admin($league->id))
    {!! link_to_route('league_edit', 'Edit', [$league->slug], ['class' => 'btn btn-info pull-right']) !!}
      @endif
      </div>
  </div>
  <ul class="nav nav-tabs">
    <li>{!! link_to_route('league_path', 'Overall', [$league->slug]) !!}</li>
    @foreach ($league->seasons as $s)
    <li class="{{ $s->year == $season->year ? 'active' : '' }}">{!! link_to_route('league_season_path', $s->year, [$league->slug, $s->year]) !!}</li>
    @endforeach
  </ul>
  <br>
  <ul class="nav nav-pills">
    <li class="active">{!! link_to_route('league_season_path', 'Standings', [$league->slug, $season->year]) !!}</li>
    <li>{!! link_to_route('league_season_week_path', 'Schedule', [$league->slug, $season->year, 1]) !!}</li>
  </ul>
  <br>
  <div id="dynamic">
    <table class="table table-striped">
      <thead>
        <th>#</th>
        <th>Team</th>
        <th>Manager</th>
        <th>Wins</th>
        <th>Losses</th>
        <th>Ties</th>
        <th>For</th>
        <th>Against</th>
        <th></th>
      </thead>
      <tbody>
      @foreach ($teams as $index => $team)
        <tr>
          <td>{!! $index + 1 !!}</td>
          <td>{!! link_to_route('league_manager_season_path', $team->name, [$league->slug, $team->manager->id, $team->season->year]) !!}</td>
          <td>{!! link_to_route('league_manager_path', $team->manager->name, [$league->slug, $team->manager->id]) !!}</td>
          <td>{!! $team->getWins() !!}</td>
          <td>{!! $team->getLosses() !!}</td>
          <td>{!! $team->getTies() !!}</td>
          <td>{!! $team->getPointsFor() !!}</td>
          <td>{!! $team->getPointsAgainst() !!}</td>
          <td>{!! show_trophy($team) !!}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop
