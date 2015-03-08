@extends('app')

@section('content')
<h1>{{ $league->name }}</h1>
<p>League id: {{ $league->league_id }}</p>
<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
@endsection
