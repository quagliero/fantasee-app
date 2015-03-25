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
  <li class="active">{!! link_to_route('league_path', 'Managers', [$league->slug]) !!}</li>
  <li>{!! link_to_route('league_teams_path', 'Teams', [$league->slug]) !!}</li>
</ul>

<table class="table table-striped">
  <thead>
    <th>Name</th>
    <th>Wins</th>
    <th>Losses</th>
    <th>Ties</th>
    <th>Points For</th>
    <th>Points Against</th>
  </thead>
  <tbody>
  @foreach ($managers as $manager)
    <tr>
      <td>{!! link_to_route('league_manager_path', $manager->name, [$league->slug, $manager->id]) !!}</td>
      <td>{!! $manager->getWins() !!}</td>
      <td>{!! $manager->getLosses() !!}</td>
      <td>{!! $manager->getTies() !!}</td>
      <td>{!! $manager->getPointsFor() !!}</td>
      <td>{!! $manager->getPointsAgainst() !!}</td>
    </tr>
  @endforeach
  </tbody>
</table>

<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>

@endsection
