@extends('app')

@section('content')

<h1>{{ $team->name }}</h1>
<h4>Manager: {{ $manager->name }}</h4>
<h4>Season: {{ $season->year }}</h4>


<p>{!! link_to_route('league_manager_path', 'Back to ' . $manager->name, [$league->slug, $manager->id]) !!}</p>
@endsection
