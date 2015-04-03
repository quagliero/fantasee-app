@extends('app')

@section('content')
<h1>Leagues using Fantasee</h1>
@if (Auth::check())
  <p>{!! link_to_route('league_create', 'Add new league', null, ['class="btn btn-primary"'])!!}</p>
@else
  <p><a href="{{ url('/auth/login') }}">Login</a> or <a href="{{ url('/auth/register') }}">Register</a> to add your league.</p>
@endif
<ul>
@foreach ($leagues as $league)
<li>{!! link_to_route('league_path', $league->name, [$league->slug]) !!}</li>
@endforeach
</ul>
@endsection
