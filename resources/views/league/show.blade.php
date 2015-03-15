@extends('app')

@section('content')
<h1>{{ $league->name }} {!! link_to_route('league_edit', 'Edit', [$league->league_id], ['class' => 'btn btn-info']) !!}</h1>

<ul class="nav nav-tabs">
<li class="active">{!! link_to_route('league_path', 'Overall', [$league->slug]) !!}</li>
@foreach ($league->seasons as $season)
  <li>{!! link_to_route('league_season_path', $season->year, [$league->slug, $season->year]) !!}</li>
@endforeach
</ul>

<table class="table table-striped">
  <caption>
    <h4>Managers</h4>
  </caption>
  <thead>
    <th>Name</th>
    <th>Wins</th>
    <th>Losses</th>
    <th>Ties</th>
    <th>Playoffs</th>
    <th>Championships</th>
  </thead>
  <tbody>
  @foreach ($league->managers as $manager)
    <tr>
      <td>{!! link_to_route('league_manager_path', $manager->name, [$league->slug, $manager->id]) !!}</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  @endforeach
  </tbody>
</table>


<table class="table table-striped">
  <caption>
    <h4>Teams</h4>
  </caption>
  <thead>
    <th>Team</th>
    <th>Manager</th>
    <th>Season</th>
    <th>Wins</th>
    <th>Losses</th>
    <th>Ties</th>
    <th>Points Scored</th>
    <th>Points Against</th>
  </thead>
  <tbody>
  @foreach ($league->teams as $team)
    <tr>
      <td>{!! link_to_route('league_manager_season_path', $team->name, [$league->slug, $team->manager->id, $team->season->year]) !!}</td>
      <td>{!! link_to_route('league_manager_path', $team->manager->name, [$league->slug, $team->manager->id]) !!}</td>
      <td>{{ $team->season->year }}</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  @endforeach
  </tbody>
</table>
<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>

@endsection
