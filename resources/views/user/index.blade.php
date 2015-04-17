@extends('app')

@section('content')
<div class="container">
  <h1>Users</h1>

  <table class="table table-striped">
    <thead>
      <th>ID</th>
      <th>Email</th>
      <th>Name</th>
      <th>Leagues</th>
      <th>Joined</th>
    </thead>
    <tbody>
    @foreach ($users as $user)
      <tr>
        <td>{!! $user->id !!}</td>
        <td>{!! link_to_route('user_path', $user->email, [$user->id]) !!}</td>
        <td>{!! $user->name !!}</td>
        <td>
          @foreach ($user->leagues as $league)
          {!! link_to_route('league_path', $league->name, [$league->slug]) !!}<br>
          @endforeach
        </td>
        <td>{!! date('d M Y h:s', strtotime($user->created_at)) !!}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
@stop
