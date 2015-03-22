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
<div class="media">
  <ul class="nav nav-pills nav-stacked media-left">
  @foreach ($weeks as $key => $w)
  <li class="{{ $key == 0 ? 'active' : '' }}">{!! link_to_route('league_season_week_path', $w->name, [$league->slug, $season->year, $w->id]) !!}</li>
  @endforeach
  </ul>
  <div class="media-body">
    <h3 class="media-heading">{{ $weeks[0]->name }}</h3>
  @foreach ($matches as $match)
  <div>
    {!! get_team_name_from_id($match->team1_id) !!} {{ $match->team1_score }} - {{ $match->team2_score }} {!! get_team_name_from_id($match->team2_id) !!}
    <br>Winner: {{ get_match_winner($match->id)->name }}
  </div>
  @endforeach
</div>

<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
@stop
