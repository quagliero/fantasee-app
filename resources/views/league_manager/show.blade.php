@extends('app')

@section('content')
<div class="container">
  <h1>{{ $manager->name }}</h1>
  <h2>{!! $manager->wins !!} - {!! $manager->losses !!}
    <small>({!! decimal_perc($manager->getWinPercent()) !!})</small></h2>
  <h3>Teams</h3>
  <table class="table table-striped">
    <thead>
      <th>Season</th>
      <th>Team</th>
      <th>Wins</th>
      <th>Losses</th>
      <th>Ties</th>
      <th>For</th>
      <th>Against</th>
      <th>Position</th>
    </thead>
    <tbody>
  @foreach ($manager->teams as $team)
    <tr>
      <td>{!! link_to_route('league_season_path', $team->season->year, [$league->slug, $team->season->year]) !!}</td>
      <td>{!! link_to_route('league_manager_season_path', $team->name, [$league->slug, $manager->id, $team->season->year]) !!}</td>
      <td>{{ $team->getWinsAttribute() }}</td>
      <td>{{ $team->getLossesAttribute() }}</td>
      <td>{{ $team->getTiesAttribute() }}</td>
      <td>{{ $team->getPointsFor() }}</td>
      <td>{{ $team->getPointsAgainst() }}</td>
      <td>{{ ordinal($team->position) }}</td>
    </tr>
  @endforeach
  </tbody>
  <tfoot>
    <tr class="text-muted">
      <th colspan="2">Average</th>
      <td><strong>{{ $manager->getAverageWins() }}</strong></td>
      <td><strong>{{ $manager->getAverageLosses() }}</strong></td>
      <td><strong>{{ $manager->getAverageTies() }}</strong></td>
      <td><strong>{{ $manager->getAveragePointsFor() }}</strong></td>
      <td><strong>{{ $manager->getAveragePointsAgainst() }}</strong></td>
      <td><strong>{{ ordinal($manager->getAverageFinish()) }}</strong></td>
    </tr>
    <tr class="text-primary">
      <th colspan="2">Total</th>
      <td><strong>{{ $manager->getWinsAttribute() }}</strong></td>
      <td><strong>{{ $manager->getLossesAttribute() }}</strong></td>
      <td><strong>{{ $manager->getTiesAttribute() }}</strong></td>
      <td><strong>{{ $manager->getPointsFor() }}</strong></td>
      <td><strong>{{ $manager->getPointsAgainst() }}</strong></td>
      <td></td>
    </tr>
  </tfoot>
  </table>
{{--
  <h3>Trades</h3>
  <table class="table table-striped">
    <thead>
      <th>Season</th>
      <th>Name</th>
      <th>Position</th>
    </thead>
    <tbody>

  </tbody>
  </table> --}}
  <p>{!! link_to_route('league_path', 'Back to league', [$league->slug]) !!}</p>
</div>
@endsection
