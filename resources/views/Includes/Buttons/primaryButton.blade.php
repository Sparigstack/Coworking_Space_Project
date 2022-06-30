<button class="btn    waves-effect waves-light c-pointer {{$classList ?? ''}}" @if(isset($attr))        
@foreach($attr as $key => $val)
{{$key}} = "{{$val}}"
@endforeach
@endif
onclick="{{$onclick ?? ''}}" type='{{$type ?? 'button'}}' >{{$value}} 



</button>