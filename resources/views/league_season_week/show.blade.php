@extends('app')

@section('content')
<div class="container">
  <h1>{{ $league->name }} &mdash; {{ $season->year }} &mdash; Schedule</h1>
  @include ('partials.league_years_header')
  <br>
  @include ('partials.league_section_seasonal_header', [ 'active' => 'schedule' ])
  <br>

  <div class="nav schedule-nav">
    <ul class="well nav nav-pills">
    @foreach ($weeks as $w)
    <li class="{{ $w->id == $week->id ? 'active' : '' }}">{!! link_to_route('league_season_week_path', $w->name, [$league->slug, $season->year, $w->id]) !!}</li>
    @endforeach
    </ul>
    <div class="nav-content">
      <h3 class="media-heading">{{ $week->name }}</h3>
      @foreach ($matches as $match)
      <div class="match">
        <span class="match__team">
        {{ $match->team1->name }}
        </span>
        <span class="match__score">
          <span class="score-box">
            <span class="score-box__left">{{ $match->team1_score }}</span>
            <span class="score-box__sep">-</span>
            <span class="score-box__right">{{ $match->team2_score }}</span>
          </span>
        </span>
        <span class="match__team">
          {{ $match->team2->name }}
        </span>
      </div>
      @endforeach
    </div>
  </div>
</div>
@stop
