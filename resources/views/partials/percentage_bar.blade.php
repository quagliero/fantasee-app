<div class="perc-bar">
<!--
@foreach ($breakdown as $stat => $val)
  --><span class="perc-bar__item perc-bar__item--{{ $stat }}" style="width: {{ $val }}%" data-value="{{ $val }}%">{{ $stat }}</span><!--
@endforeach
--></div>
