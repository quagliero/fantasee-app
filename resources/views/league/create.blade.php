@extends('app')

@section('content')

<h1>Add league to Fantasee</h1>

{!! Form::open(['route' => 'league_store']) !!}
{!! Form::hidden('user_id', Auth::user()->id) !!}
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
  {!! Form::label('name', 'League Name') !!}
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Your league name']) !!}
  {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('league_id') ? 'has-error' : '' }}">
  {!! Form::label('league_id', 'League ID') !!}
  {!! Form::text('league_id', null, ['class' => 'form-control', 'placeholder' => 'Your league id', 'aria-describedby="league_id-help"']) !!}
  <span id="league_id-help" class="help-block">The unique ID of the league on NFL.com: <a href="http://fantasy.nfl.com/league/">http://fantasy.nfl.com/league/<i><b></b></i></a></span>
  {!! $errors->first('league_id', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
  {!! Form::label('slug', 'Fantasee URL') !!}
  <div class="input-group">
    <div class="input-group-addon">http://fantasee.app/</div>
  {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => '']) !!}
  </div>
  {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
</div>
<div class="form-group">
  {!! Form::submit('Add league', ['class' => 'btn btn-primary'])!!}
</div>
{!! Form::close() !!}
<p>{!! link_to_route('leagues_path', 'Back to leagues') !!}</p>
@endsection
