<div class="row d-flex justify-content-center justify-content-md-start align-items-start">
    <div class="rounded-circle ml-4 mr-4 deskSeatIcon">
        <img src="{{$iconUrl}}" alt="" class="p-3" srcset="">
    </div>
    <div class="text-center text-md-left">
        <h6 class="mt-2 mt-md-0">{{$title}}</h6>
        @foreach($data as $spaceTypes)
        <p>{{$spaceTypes->capacity}}  {{$title}} available at
            <b>
                @if($spaceTypes->price_hour > 0)
                <i class="{{$currency}}"></i> {{ $spaceTypes->price_hour }} per hour
                @endif
                @if($spaceTypes->price_day > 0)
                {{ ($spaceTypes->price_hour) ? ', ' : ''}} <i class="{{$currency}}"></i>{{$spaceTypes->price_day }} per day
                @endif
            </b>
        </p>
        <div>
            <span>Projector : <i class='{{ $spaceTypes->is_projector ? "fa icon fa-check-circle" : "fa icon fa-times-circle" }}'></i></span>
            <span>Whiteboard : <i class='{{$spaceTypes->is_whiteboard  ? "fa icon fa-check-circle" : "fa icon fa-times-circle" }}'></i></span>
        </div>

        <hr class="mt-1 mb-1" style='background-color: #9f95959e;'>
        @endforeach
    </div>
    <div class="ml-md-auto mr-md-3 ">
        @php
        $modal="#modal-signup";
        if(Auth::check()){
            $modal = "#bookMeetingModal";
        }
        @endphp

         @if(isset($checkOnline) && $checkOnline > 0)
         @primaryButton(['value' => 'Book Online' , 'classList' => 'btn-sm btn-primary' , 'attr' => array('data-toggle' => "modal" ,
         'data-target' => $modal ?? ''  )])
         @endif
        <button type="button" onclick="seatingpopup(this);" data-id="{{6}}" style='z-index: 0;' data-toggle="modal" data-target="#inquireModalCenter" id="booktourBtn2" class="btn btn-warning waves-effect waves-light btn-sm mr-2">Contact Space</button>

    </div>
</div>