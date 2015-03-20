@extends('app')

@section('content')

<h1>{{ $league->name }} &mdash; {{ $season->year }} &mdash; {{ $week->name }}</h1>

@foreach($matches as $match)
<div>
  {!! get_team_name_from_id($match->team1_id) !!} {{ $match->team1_score }} - {{ $match->team2_score }} {!! get_team_name_from_id($match->team2_id) !!}
  <br>Winner: {{ get_match_winner($match->id)->name }}
</div>
@endforeach

<p>{!! link_to_route('league_season_path', 'Back to ' . $league->name . ' ' . $season->year, [$league->slug, $season->year]) !!}</p>

@stop
