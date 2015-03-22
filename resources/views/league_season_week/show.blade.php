@extends('app')

@section('content')

<h1>{{ $league->name }} &mdash; {{ $season->year }} &mdash; Schedule
  {!! link_to_route('league_edit', 'Edit', [$league->slug], ['class' => 'btn btn-info']) !!}</h1>
<ul class="nav nav-tabs">
<li>{!! link_to_route('league_path', 'Overall', [$league->slug]) !!}</li>
@foreach ($league->seasons as $s)
  <li class="{{ $s->year == $season->year ? 'active' : '' }}">{!! link_to_route('league_season_path', $s->year, [$league->slug, $s->year]) !!}</li>
@endforeach
</ul>
<br>
<ul class="nav nav-pills">
  <li>{!! link_to_route('league_season_path', 'Standings', [$league->slug, $season->year]) !!}</li>
  <li class="active">{!! link_to_route('league_season_weeks_path', 'Schedule', [$league->slug, $season->year]) !!}</li>
</ul>
<br>
<div class="nav-left">
  <ul class="nav nav-pills nav-stacked">
  @foreach ($weeks as $w)
  <li class="{{ $w->id == $week->id ? 'active' : '' }}">{!! link_to_route('league_season_week_path', $w->name, [$league->slug, $season->year, $w->id]) !!}</li>
  @endforeach
  </ul>
  <div class="nav-content">
    <h3 class="media-heading">{{ $week->name }}</h3>
  @foreach ($matches as $match)
  <div class="match">
    <span class="match__team">
    {!! get_team_name_from_id($match->team1_id) !!}
    </span>
    <span class="match__score">
      {{ $match->team1_score }} - {{ $match->team2_score }}
    </span>
    <span class="match__team">
      {!! get_team_name_from_id($match->team2_id) !!}
    </span>
  </div>
  @endforeach
  </div>
</div>
<div class="clearfix"></div>
<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
@stop
