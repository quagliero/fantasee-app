@extends('app')

@section('content')
<div class="container">
  <h1>{{ $league->name }}</h1>
  @include ('partials.league_years_header')
  <br>
  @include ('partials.league_section_header', [ 'active' => 'drafts' ])
  <br>
  <table class="table table-striped">
    <thead>
      <th>Year</th>
      <th>First Pick</th>
      <th>Mr Irrelevant</th>
      <th>Breakdown</th>
    </thead>
    <tbody>
    @foreach ($drafts as $draft)
      <tr>
        <td>{!! link_to_route('league_season_draft_path', $draft->season->year, [$league->slug, $draft->season->year]) !!}</td>
        @if (sizeof($draft->picks) > 0)
        <td>{{ $draft->selections->first->player->name }}</td>
        <td>{{ $draft->selections->last->player->name }}</td>
        @else
        <td>Unknown</td>
        <td>Unknown</td>
        @endif
        <td>
          <p>QBs: {!! sizeof($draft->selections->positions->qb) !!},
          RBs: {!! sizeof($draft->selections->positions->rb) !!},
          WRs: {!! sizeof($draft->selections->positions->wr) !!},
          TEs: {!! sizeof($draft->selections->positions->te) !!},
          Ks: {!! sizeof($draft->selections->positions->k) !!},
          DSTs: {!! sizeof($draft->selections->positions->dst) !!}</p>
          @include('partials.percentage_bar', ['breakdown' => $draft->getAllPicksWithBreakdown()->breakdown])
          <br>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  <p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
</div>
@stop
