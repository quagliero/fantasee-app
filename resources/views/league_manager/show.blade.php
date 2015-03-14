@extends('app')

@section('content')
<h1>{{ $manager->name }} {!! link_to_route('league_manager_edit', 'Edit', [$league->slug, $manager->id], ['class' => 'btn btn-info']) !!}</h1>

<h2>Teams</h2>
@foreach ($manager->teams as $team)
  {!! link_to_route('league_manager_season_path', $team->name, [$league->slug, $manager->id, 2012]) !!}
@endforeach

<p>{!! link_to_route('league_path', 'Back to league', [$league->slug]) !!}</p>
@endsection
