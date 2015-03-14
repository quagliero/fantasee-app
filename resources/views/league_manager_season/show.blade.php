@extends('app')

@section('content')
<h1>{{ $manager->name }} {!! link_to_route('league_manager_edit', 'Edit', [$league->slug, $manager->id], ['class' => 'btn btn-info']) !!}</h1>

<p>{!! link_to_route('league_path', 'Back to league', [$league->slug]) !!}</p>
@endsection
