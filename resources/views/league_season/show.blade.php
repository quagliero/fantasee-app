@if(!Request::ajax())
@extends('app')
@endif

@section('content')

<h1>{{ $league->name }} &mdash; {{ $season->year }}  {!! link_to_route('league_edit', 'Edit', [$league->slug], ['class' => 'btn btn-info']) !!}</h1>
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
    <th>Team</th>
    <th>Manager</th>
    <th>Wins</th>
    <th>Losses</th>
    <th>Ties</th>
  </thead>
  <tbody>
  @foreach ($teams as $team)
    <tr>
      <td>{!! link_to_route('league_manager_season_path', $team->name, [$league->slug, $team->manager->id, $team->season->year]) !!}</td>
      <td>{!! link_to_route('league_manager_path', $team->manager->name, [$league->slug, $team->manager->id]) !!}</td>
      <td>{!! $team->getWins() !!}</td>
      <td>{!! $team->getLosses() !!}</td>
      <td>{!! $team->getTies() !!}</td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>


@stop
