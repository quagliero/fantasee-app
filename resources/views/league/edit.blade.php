@extends('app')

@section('content')

<div class="row">
  <div class="col-sm-12">
    <h1>{{ $league->name }}</h1>
  </div>
  <div class="col-sm-6">
    <h2>Edit Details</h2>
    {!! Form::model($league, ['url' => route('league_update', [$league->slug]), 'method' => 'PUT']) !!}
    {!! Form::hidden('id', $league->id) !!}
    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
      {!! Form::label('name', 'League Name') !!}
      {!! Form::text('name', $league->name, ['class' => 'form-control', 'placeholder' => 'Your league name']) !!}
      {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group {{ $errors->has('league_id') ? 'has-error' : '' }}">
      {!! Form::label('league_id', 'League ID') !!}
      {!! Form::text('league_id', $league->league_id, ['class' => 'form-control', 'placeholder' => 'Your league id', 'aria-describedby="league_id-help"']) !!}
      <span id="league_id-help" class="help-block">The unique ID of the league on NFL.com: <a href="http://fantasy.nfl.com/league/{!! $league->league_id !!}">http://fantasy.nfl.com/league/<i><b>{{ $league->league_id }}</b></i></a></span>
      {!! $errors->first('league_id', '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
      {!! Form::label('slug', 'Fantasee URL') !!}
      <div class="input-group">
        <div class="input-group-addon">http://fantasee.app/</div>
      {!! Form::text('slug', $league->slug, ['class' => 'form-control', 'placeholder' => '']) !!}
      </div>
      {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group">
      {!! Form::submit('Save', ['class' => 'btn btn-primary'])!!}
    </div>
    {!! Form::close() !!}

    <div class="form-group">
    {!! delete_form(['league_destroy', $league->league_id]) !!}
    </div>
  </div>
  <div class="col-sm-6">
    <h2>Data Scraper</h2>

  </div>
</div>

<p>{!! link_to_route('league_path', 'Back to league', [$league->slug]) !!}</p>
@endsection
