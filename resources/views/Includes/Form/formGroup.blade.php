<div class="form-group {{$groupClass ?? ''}}">
    <label for="{{$name ?? ''}}">{{$label}} @if(isset($label_small_txt)) <span class="smalltxt">{{$label_small_txt}}</span> @endif </label>
    @if(isset($group_prepend))
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">{!!  $group_prepend !!}</span>
        </div> 
        <input value="{{$inputVal ?? ''}}"   type="{{$type ?? 'text'}}"
        class="form-control" name="{{$name ?? ''}}"  placeholder="{{$placeholder ?? ''}}"
        {{$required ?? ''}} 
        @if(isset($attr))        
        @foreach($attr as $key => $val)
        {{$key}} = "{{$val}}"
        @endforeach
        @endif >

    </div>

    @else

    <input value="{{$inputVal ?? ''}}"   type="{{$type ?? 'text'}}"
        class="form-control" name="{{$name ?? ''}}"  placeholder="{{$placeholder ?? ''}}"
        {{$required ?? ''}} 
        @if(isset($attr))        
        @foreach($attr as $key => $val)
        {{$key}} = "{{$val}}"
        @endforeach
        @endif >
        
    @endif

</div>