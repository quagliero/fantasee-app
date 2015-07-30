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
  <ul class="nav nav-tabs">
    <li class="active">{!! link_to_route('league_path', 'Overall', [$league->slug]) !!}</li>
    @foreach ($seasons as $season)
      <li>{!! link_to_route('league_trades_detail_path', $season->year, [$league->slug, $season->year]) !!}</li>
    @endforeach
  </ul>
  <br>
  @include ('partials.league_section_header', [ 'active' => 'trades' ])
  <br>
</div>

@endsection

@section('scripts')
  @parent
  {!! HTML::script('js/table-sortable.js') !!}
@stop
