@extends('app')

@section('content')
<h1>Leagues using Fantasee</h1>
<p>{!! link_to_route('league_create', 'Add new league', null, ['class="btn btn-primary"'])!!}</p>
<ul>
@foreach ($leagues as $league)
<li>{!! link_to_route('league_path', $league->name, [$league->league_id]) !!}</li>
@endforeach
</ul>
@endsection
