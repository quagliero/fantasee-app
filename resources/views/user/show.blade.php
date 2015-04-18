@extends('app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Details</strong></div>
          <div class="panel-body">
            {!! Form::model($user, ['url' => route('user_update', [$user->id]), 'method' => 'PUT']) !!}
            {!! Form::hidden('id', $user->id) !!}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
              {!! Form::label('name', 'Name') !!}
              {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Bob Loblaw']) !!}
              {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
              {!! Form::label('email', 'Email address') !!}
              {!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'bob@fantasy.com']) !!}
              {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
            </div>
            <div class="alert alert-warning">
              <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                {!! Form::label('password', 'New password') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
              </div>
              <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                {!! Form::label('password_confirmation', 'Repeat password') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::submit('Save', ['class' => 'btn btn-primary'])!!}
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Leagues</strong></div>
          <table class="table">
            <tbody>
            @foreach ($user->leagues as $league)
              <tr>
                <td>{!! link_to_route('league_path', $league->name, [$league->slug]) !!}</td>
                <td>{!! link_to_route('league_edit', 'Edit', [$league->slug], ['class' => 'btn btn-xs btn-warning ']) !!}
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop
