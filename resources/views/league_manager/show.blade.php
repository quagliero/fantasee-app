@extends('app')

@section('content')
<h1>{{ $manager->name }} {!! link_to_route('league_manager_edit', 'Edit', [$league->slug, $manager->id], ['class' => 'btn btn-info']) !!}</h1>

<h2>Teams</h2>
<table class="table table-striped">
  <thead>
    <th>Season</th>
    <th>Name</th>
    <th>Position</th>
  </thead>
  <tbody>
@foreach ($manager->teams as $team)
  <tr>
    <td>{!! link_to_route('league_season_path', $team->season->year, [$league->slug, $team->season->year]) !!}</td>
    <td>{!! link_to_route('league_manager_season_path', $team->name, [$league->slug, $manager->id, $team->season->year]) !!}</td>
    <td>{{ ordinal($team->position) }}</td>
  </tr>
@endforeach
</tbody>
</table>
<p>{!! link_to_route('league_path', 'Back to league', [$league->slug]) !!}</p>
@endsection
