@extends('app')

@section('content')
<div class="container">
  <h1>{{ $league->name}} &mdash; Managers</h1>
  <p>{!! link_to_route('league_create', 'Add new league', null, ['class="btn btn-primary"'])!!}</p>

  <ul class="nav">
  @foreach ($managers as $manager)
    <li>{!! link_to_route('league_manager_path', $manager->name, [$league->slug, $manager->id]) !!}</li>
  @endforeach
  </ul>
  <br>
  <p>{!! link_to_route('league_path', 'Back to league', [$league->slug]) !!}</p>
</div>
@endsection
