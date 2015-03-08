@extends('app')

@section('content')

<h1>Add league to Fantasee</h1>
{!! Form::open(['route' => 'league_store']) !!}
<div class="form-group">
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Your league name']) !!}
</div>
<div class="form-group">
  {!! Form::text('league_id', null, ['class' => 'form-control', 'placeholder' => 'Your league id']) !!}
</div>
<div class="form-group">
  {!! Form::submit('Add league', ['class' => 'btn btn-primary'])!!}
</div>
{!! Form::close() !!}
<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
@endsection
