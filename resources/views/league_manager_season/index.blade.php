@extends('app')

@section('content')
<h1>{{ $league->name}} &mdash; Managers</h1>
<p>{!! link_to_route('league_create', 'Add new league', null, ['class="btn btn-primary"'])!!}</p>

<ul class="nav">
@foreach ($manager->teams as $team)
  {{ $team->name }}
@endforeach
</ul>

<p>{!! link_to_route('league_path', 'Back to league', [$league->slug]) !!}</p>
@endsection
