@extends('app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-6">
      <h1>{{ $league->name }}</h1>
    </div>
    <div class="col-xs-6 text-right">
      <br>
      @if (is_league_admin($league->id))
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

  <table class="table table-striped" data-sortable="1,2,4,5,6">
    <thead>
      <th>Name</th>
      <th>Wins</th>
      <th>Losses</th>
      <th>Ties</th>
      <th>%</th>
      <th>Points For</th>
      <th>Points Against</th>
      <th><i class="fa fa-trophy"></i></th>
    </thead>
    <tbody>
    @foreach ($managers as $manager)
      <tr>
        <td>{!! link_to_route('league_manager_path', $manager->name, [$league->slug, $manager->id]) !!}</td>
        <td>{!! $manager->wins !!}</td>
        <td>{!! $manager->losses !!}</td>
        <td>{!! $manager->ties !!}</td>
        <td>{!! decimal_perc($manager->getWinPercent()) !!}</td>
        <td>{!! $manager->points->for !!}</td>
        <td>{!! $manager->points->against !!}</td>
        <td>{!! $manager->getChampionshipSeasons() !!}</td>
      </tr>
    @endforeach
    </tbody>
  </table>

  <p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
</div>
@endsection

@section('scripts')
  @parent
  {!! HTML::script('js/table-sortable.js') !!}
@stop
