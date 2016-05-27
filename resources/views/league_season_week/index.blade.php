@extends('app')

@section('content')
<div class="container">
  <h1>{{ $league->name }} &mdash; {{ $season->year }} &mdash; Schedule</h1>
  @include ('partials.league_years_header')
  <br>
  @include ('partials.league_section_seasonal_header', [ 'active' => 'schedule' ])
  <br>
  <div class="media">
    <ul class="nav nav-pills nav-stacked media-left">
    @foreach ($weeks as $key => $w)
    <li class="{{ $key == 0 ? 'active' : '' }}">{!! link_to_route('league_season_week_path', $w->name, [$league->slug, $season->year, $w->id]) !!}</li>
    @endforeach
    </ul>
    <div class="media-body">
      <h3 class="media-heading">{{ $weeks->name }}</h3>
    @foreach ($matches as $match)
    <div>
      {{ $match->team1->name }} {{ $match->team1_score }} - {{ $match->team2_score }} {{ $match->team2->name }}
      <br>Winner: {{ get_match_winner($match->id)->name }}
    </div>
    @endforeach
  </div>

</div>
@stop
