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
  <thead>
    <th>Team</th>
    <th>Manager</th>
    <th>Wins</th>
    <th>Losses</th>
    <th>Ties</th>
  </thead>
  <tbody>
  @foreach ($league->seasonTeams($season->id) as $team)
    <tr>
      <td>{{ $team->name }}</td>
      <td>{!! link_to_route('league_manager_path', $team->manager->name, [$league->slug, $team->manager->id]) !!}</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  @endforeach
  </tbody>
</table>

<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
@endsection
