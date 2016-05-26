@if(!Request::ajax())
@extends('app')
@endif

@section('content')
<div class="container">
  <h1>{{ $league->name }} &mdash; {{ $season->year }}</h1>
  <ul class="nav nav-tabs">
    <li>{!! link_to_route('league_path', 'Overall', [$league->slug]) !!}</li>
    @foreach ($league->seasons->sortByDesc('id') as $s)
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

    @foreach ($rounds as $round => $picks)
    <table class="table table-striped">
      <caption>Round {{ $round + 1 }}</caption>
      <thead>
        <tr>
          <th>Pick</th>
          <th>Team</th>
          <th>Player</th>
          <th>Position</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($picks as $p)
        <tr>
          <td>{!! $p->pick !!}</td>
          <td>{!! $p->team->name !!}</td>
          <td>{!! $p->player->name !!}</td>
          <td>{!! $p->player->position !!}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>Breakdown</th>
          <th colspan="3">
            @include('partials.percentage_bar', ['breakdown' => $picks->breakdown])
          </th>
        </tr>
      </tfoot>
    </table>
    @endforeach
  </div>
</div>
@stop

@section('scripts')
  @parent
  {!! Html::script('js/table-sortable.js') !!}
@stop
