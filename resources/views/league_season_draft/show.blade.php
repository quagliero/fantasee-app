@if(!Request::ajax())
@extends('app')
@endif

@section('content')
<div class="container">
  <h1>{{ $league->name }} &mdash; {{ $season->year }}</h1>
  <ul class="nav nav-tabs">
    <li>{!! link_to_route('league_path', 'Overall', [$league->slug]) !!}</li>
    @foreach ($league->seasons as $s)
    <li class="{{ $s->year == $season->year ? 'active' : '' }}">{!! link_to_route('league_season_path', $s->year, [$league->slug, $s->year]) !!}</li>
    @endforeach
  </ul>
  <br>
  <ul class="nav nav-pills">
    <li>{!! link_to_route('league_season_path', 'Standings', [$league->slug, $season->year]) !!}</li>
    <li>{!! link_to_route('league_season_week_path', 'Schedule', [$league->slug, $season->year, 1]) !!}</li>
    <li class="active">{!! link_to_route('league_season_draft_path', 'Draft', [$league->slug, $season->year]) !!}</li>
  </ul>
  <br>
  <div id="dynamic">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Pick</th>
          <th>Team</th>
          <th>Player</th>
          <th>Position</th>
          <th>Team</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($picks as $index => $pick)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ get_team_name_from_id($pick->team_id)}}</td>
          <td>{{ get_player_name_from_id($pick->player_id) }}</td>
          <td>{{ get_player_position_from_id($pick->player_id) }}</td>
          <td></td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
@stop

@section('scripts')
  @parent
  {!! HTML::script('js/table-sortable.js') !!}
@stop
