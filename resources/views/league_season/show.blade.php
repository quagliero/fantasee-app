@extends('app')

@section('content')

<h1>{{ $league->name }} &mdash; {{ $season->year }}  {!! link_to_route('league_edit', 'Edit', [$league->slug], ['class' => 'btn btn-info']) !!}</h1>
<ul class="nav nav-tabs">
<li>{!! link_to_route('league_path', 'Overall', [$league->slug]) !!}</li>
@foreach ($league->seasons as $s)
  <li class="{{ $s->year == $season->year ? 'active' : '' }}">{!! link_to_route('league_season_path', $s->year, [$league->slug, $s->year]) !!}</li>
@endforeach
</ul>

<table class="table table-striped">
  <caption>Standings</caption>
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
      <td></td>
      <td></td>
      <td></td>
    </tr>
  @endforeach
  </tbody>
</table>

<ul class="nav navbar-left nav-pills nav-stacked">
@foreach ($weeks as $key => $w)
<li class="{{ $key == 0 ? 'active' : '' }}">{!! link_to_route('league_season_week_path', $w->name, [$league->slug, $season->year, $w->id]) !!}</li>
@endforeach
</ul>

@foreach ($matches as $match)
<div>
  {!! get_team_name_from_id($match->team1_id) !!} {{ $match->team1_score }} - {{ $match->team2_score }} {!! get_team_name_from_id($match->team2_id) !!}
  <br>Winner: {{ get_match_winner($match->id)->name }}
</div>
@endforeach

<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
@stop
