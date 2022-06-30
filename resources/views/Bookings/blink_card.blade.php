
<div class="col-md-12 firstBox d-flex justify-content-between align-items-center">

    {{-- <p style='max-width: 230px;' class="font-weight-bold">Why do we use it? Where can I get some?
    </p> --}}
    <div style='max-width: 230px;' class="font-weight-bold blinkTag d-inline-block" >{{$title ?? '' }}</div>

    @if(Auth::check())
    @primaryButton(['value' => 'Book Now' , 'classList' => 'btn-primary' , 'attr' => array('data-toggle' => "modal" ,
    'data-target' => $modal ?? ''  )])
    @else
    @primaryButton(['value' => ' Book Now' , 'classList' => 'LoginSignUpBox btn-warning' , 'attr' => array("data-tabindex" => 1 ,'data-toggle' => "modal" ,
    'data-target' => "#modal-signup"  )])
    @endif

</div>
