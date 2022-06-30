  <div class="modal fade" id="{{$id ?? ''}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog {{$size ?? ''}}">
        <div class="modal-content animated flipInX">
       <div class="modal-header">
        <h5 class="modal-title text-center" style="font-size: 20px;" id="">{{$title ?? ''}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div> 
            <div class="modal-body">
                    {{ $slot }}
            </div>
            @if(isset($footer))
            <div class="modal-footer">
                {{ $footer ?? '' }}
            </div>
            @endif
        </div>
    </div>
</div>