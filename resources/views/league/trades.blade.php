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
  @include ('partials.league_section_header', [ 'active' => 'trades' ])
  <br>
  @foreach ($trades as $trade)
  <table class="table table-striped">
    <thead>
      <th>Season</th>
      <th>Week</th>
      <th>Gaining Team</th>
      <th>Player</th>
      <th>Giving Team</th>
    </thead>
    <tbody>
      @foreach ($trade->exchanges as $swap)
        <tr>
          <td>{{ $swap->gainingTeam->season->year }}</td>
          <td>{{ $trade->week->name }}</td>
          <td>{{ $swap->gainingTeam->name }}</td>
          <td>{{ $swap->asset->name }}</td>
          <td>{{ $swap->losingTeam->name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  @endforeach
</div>

@endsection

@section('scripts')
  @parent
  {!! Html::script('js/table-sortable.js') !!}
@stop
