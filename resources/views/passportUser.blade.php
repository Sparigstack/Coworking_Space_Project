@extends('Masters.ClientSpace')
@section('spacedetail')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 pb-2">   </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body passportSection">
                        <div class="card-title">Passport Users List</div>
                        <hr>
                        <div class="row">
                                    <div class="card-body">
                                        <div class="table-responsive">                                                                                     
                                                    @foreach($passportUsersDetail as $details)
                                                    <div  class="parent row col-lg-12  col-md-12 w-100 m-auto">
                                                            <div class="col-lg-3 col-md-3 col-6 mb-2">
                                                                                <div class="leftAlignMobile font-500 text-dark bordernone spaceTypeName">{{$details->name}}</div>
                                                                <p class="spaceSeatingHeading">Passport Name</p>
                                                            </div>
                                                            <div class="col-lg-3 col-md-4 col-6 mb-2">                                                                      
                                                                <div class="leftAlignMobile font-500 text-dark bordernone spaceTypeName">{{$details->first_name}} {{$details->last_name}}</div>
                                                                <p class="spaceSeatingHeading">User Name</p>
                                                            </div>
                                                            <div class="col-lg-4 col-md-4 col-6 mb-2">                                                                       
                                                                
                                                                <a  title="Passport no.:{{$details->passportNumber}}" style="background-color:#FFFFFF;color:#000000;text-decoration:none">
                                                                <div class=" leftAlignMobile font-500 text-dark bordernone spaceTypeName">{{$details->email}}</div></a>
                                                                
                                                                <p class=" spaceSeatingHeading">Email</p>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-6 mb-2">                                                                       
                                                                <div class="leftAlignMobile font-500 text-dark bordernone spaceTypeName">{{$details->credits_used}}</div>
                                                                <p class="spaceSeatingHeading">Credits Used</p>
                                                            </div>
                                                    </div >            
                                                        
                                                   
                                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                                <hr/>
                                                @endforeach
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{asset('/js/passport.js')}}"></script>
@endsection

