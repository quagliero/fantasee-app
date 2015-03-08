@extends('app')

@section('content')

<h1>Edit {{ $league->name }}</h1>
{!! Form::model($league, ['url' => route('league_update', [$league->league_id]), 'method' => 'PUT']) !!}
<div class="form-group">
  {!! Form::text('name', $league->name, ['class' => 'form-control', 'placeholder' => 'Your league name']) !!}
</div>
<div class="form-group">
  {!! Form::text('league_id', $league->league_id, ['class' => 'form-control', 'placeholder' => 'Your league id']) !!}
</div>
<div class="form-group">
  {!! Form::submit('Save', ['class' => 'btn btn-primary'])!!}
</div>
{!! Form::close() !!}
<p>{!! link_to_route('league_path', 'Back to league', [$league->league_id]) !!}</p>
@endsection
