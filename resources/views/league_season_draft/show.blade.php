@extends('app')

@section('content')

<h1>{{ $league->name }} &mdash; {{ $season->year }} &mdash; Draft
  {!! link_to_route('league_edit', 'Edit', [$league->slug], ['class' => 'btn btn-info']) !!}</h1>

  

<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
@stop
