@extends('app')

@section('content')
<div class="row">
  <div class="col-sm-6">
    <h1>{{ $league->name }}</h1>
  </div>
  <div class="col-sm-6 text-right">
    <br>
    @if (Auth::check() && Auth::user()->id == $league->user_id)
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
