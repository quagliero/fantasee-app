@extends('app')

@section('content')
<h1>{{ $league->name }} {!! link_to_route('league_edit', 'Edit', [$league->league_id], ['class' => 'btn btn-info']) !!}</h1>

<ul class="nav nav-tabs">
<li class="active">{!! link_to_route('league_path', 'Overall', [$league->slug]) !!}</li>
@foreach ($league->seasons as $season)
  <li>{!! link_to_route('league_season_path', $season->year, [$league->slug, $season->year]) !!}</li>
@endforeach
</ul>
<br>
<ul class="nav nav-pills">
  <li>{!! link_to_route('league_path', 'Managers', [$league->slug]) !!}</li>
  <li class="active">{!! link_to_route('league_teams_path', 'Teams', [$league->slug]) !!}</li>
</ul>

<table class="table table-striped">
  <thead>
    <th>Name</th>
    <th>Manager</th>
    <th>Season</th>
    <th>Wins</th>
    <th>Losses</th>
    <th>Ties</th>
    <th>Points Scored</th>
    <th>Points Against</th>
  </thead>
  <tbody>
  @foreach ($teams as $team)
    <tr>
      <td>{!! link_to_route('league_manager_season_path', $team->name, [$league->slug, $team->manager->id, $team->season->year]) !!}</td>
      <td>{!! link_to_route('league_manager_path', $team->manager->name, [$league->slug, $team->manager->id]) !!}</td>
      <td>{!! link_to_route('league_season_path', $team->season->year, [$league->slug, $team->season->year]) !!}</td>
      <td>{!! $team->getWins() !!}</td>
      <td>{!! $team->getLosses() !!}</td>
      <td>{!! $team->getTies() !!}</td>
      <td>{!! $team->getPointsFor() !!}</td>
      <td>{!! $team->getPointsAgainst() !!}</td>
    </tr>
  @endforeach
  </tbody>
</table>
<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>

@endsection
