@extends('app')

@section('content')
<div class="container">
  <div id="content"></div>
</div>
@stop


@section('scripts')
  @parent
  {!! Html::script('js/app.js') !!}
@stop
