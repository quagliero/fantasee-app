@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <h1>{{ $league->name }}</h1>
    </div>
    <div class="col-sm-6 text-right">
      <br>
      @if (is_league_admin($league->id))
    {!! link_to_route('league_edit', 'Edit', [$league->slug], ['class' => 'btn btn-info']) !!}
      @endif
    </div>
  </div>
  @include ('partials.league_years_header')
  <br>
  @include ('partials.league_section_header', [ 'active' => 'teams' ])
  <br>
  <table class="table table-striped" data-sortable="3,4,6,7,8">
    <thead>
      <th>Name</th>
      <th>Manager</th>
      <th>Season</th>
      <th>Wins</th>
      <th>Losses</th>
      <th>Ties</th>
      <th>%</th>
      <th>For</th>
      <th>Against</th>
    </thead>
    <tbody>
    @foreach ($teams as $team)
      <tr>
        <td>{!! link_to_route('league_manager_season_path', $team->name, [$league->slug, $team->manager->id, $team->season->year]) !!} {!! show_trophy($team) !!}</td>
        <td>{!! link_to_route('league_manager_path', $team->manager->name, [$league->slug, $team->manager->id]) !!}</td>
        <td>{!! link_to_route('league_season_path', $team->season->year, [$league->slug, $team->season->year]) !!}</td>
        <td>{!! $team->wins !!}</td>
        <td>{!! $team->losses !!}</td>
        <td>{!! $team->ties !!}</td>
        <td>{!! decimal_perc($team->getWinPercent()) !!}</td>
        <td>{!! $team->points->for !!}</td>
        <td>{!! $team->points->against !!}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>

@endsection

@section('scripts')
  @parent
  {!! Html::script('js/table-sortable.js') !!}
@stop
