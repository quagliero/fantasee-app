@extends('app')

@section('content')

<h1>Add league to Fantasee</h1>
{!! Form::open(['route' => 'league_store']) !!}
{!! Form::hidden('user_id', Auth::user()->id) !!}
<div class="form-group">
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Your league name']) !!}
</div>
<div class="form-group {{ $errors->has('league_id') ? 'has-error' : '' }}">
  {!! Form::text('league_id', null, ['class' => 'form-control', 'placeholder' => 'Your league id']) !!}
  {!! $errors->first('league_id', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group">
  {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Your league slug']) !!}
</div>
<div class="form-group">
  {!! Form::submit('Add league', ['class' => 'btn btn-primary'])!!}
</div>
{!! Form::close() !!}
<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
@endsection
