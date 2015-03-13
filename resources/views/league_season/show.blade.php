@extends('app')

@section('content')

<h1>{{ $league->name }} &mdash; {{ $season->year }}  {!! link_to_route('league_edit', 'Edit', [$league->league_id], ['class' => 'btn btn-info']) !!}</h1>
<ul class="nav nav-tabs">
<li>{!! link_to_route('league_path', 'Overall', [$league->league_id]) !!}</li>
@foreach ($league->seasons as $s)
  <li class="{{ $s->year == $season->year ? 'active' : '' }}">{!! link_to_route('league_season_path', $s->year, [$league->league_id, $s->year]) !!}</li>
@endforeach
</ul>
<table class="table table-striped">
  <thead>
    <th>Team</th>
    <th>Manager</th>
    <th>Wins</th>
    <th>Losses</th>
    <th>Ties</th>
    <th>Playoffs</th>
    <th>Championships</th>
  </thead>
  <tbody>
  @foreach ($league->teams as $team)
    <tr>
      <td>{{ $team->name }}</td>
      <td>{{ $team->manager->name }}</td>
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
