<section class="coworking-cities citywisespaces content-wrapper container" style="">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center title-border border-center fadeInDown wow">Find Coworking Spaces by City</h2>
            </div>
        </div>
        <div class="row">
            @foreach ($cities as $city)

            <div class="col-md-3 pl-4 SpacesCity">
                <a title="Coworking spaces in {{$city->name}}" href="{{url('/coworking-spaces/'.str_replace(' ','-', strtolower($city->name)))}}">Coworking spaces in {{$city->name}}</a>
            </div>

            @endforeach	
        </div>
    </div> 
</section>