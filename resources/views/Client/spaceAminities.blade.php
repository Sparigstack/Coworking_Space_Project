@extends('Masters.ClientSpace')
@section('spacedetail')
<div class="content-wrapper">
    <div class="container">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">   </div>

        
        <form method="post" action="spaceAmenities">
            {{ csrf_field() }}
            <div class="row">
                <div class="card col-md-12" style="">
                    <div class="card-header">
                        <h5>Space Amenities</h5>
                        <p>Tick all the amenities that your coworking space provides.</p>
                    </div>
                </div>
                @foreach($categories as $category)
                <div class="card col-md-12" style="">
                    <div class="card-header">{{$category->name}}</div>
                    <div class="card-body">


                        <input type="hidden" value="test">

                        <div class="row">
                            @foreach($amenities as $amenity)
                            <?php $checked = ""; ?>
                            @foreach($space_amenities as $space_aminity)
                            @if($amenity->id==$space_aminity->amenity_id)
                            <?php
                            $checked = "checked";
                            ?>
                            @endif
                            @endforeach
                            <?php $cId = $category->id; ?>

                            @if($amenity->category_id==$cId)
                            <div class="col-md-3">
                                <div class="icheck-material-info">
                                    <input   type="checkbox" {{$checked}}  id="info_{{$amenity->id}}" name="amenities[]"  value="{{ $amenity->id  }}"/>
                                    <label  for="info_{{$amenity->id}}">{{ $amenity->name }}</label>
                                </div>
                            </div>
                            @endif




                            @endforeach
                        </div>







                    </div>
                </div>

                @endforeach
            </div>
            <hr>
            <ul class="list-inline pull-right">
                <li>
                    <input type="submit" class="btn btn-primary next-step btn btn-info waves-effect waves-light m-1"  value="Save and continue">
                    <a class="pull-left m-1 mt-2" style="text-decoration: underline;" href="{{ url('client/spaceWorkingHours')}}"> Go To Next Step</a>
                </li>
            </ul>
        </form>




    </div>
    <!-- End container-fluid-->

</div><!--End content-wrapper-->

@endsection


