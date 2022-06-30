@extends('Masters.ClientSpace')
@section('spacedetail')

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row pt-2 pb-2">   </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body passportSection">
                        <div class="card-title">Guidance</div>

                        <hr>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Passport Program Participation</label>
                                <p>Our passport program is best tool for you to get maximum number of users for your coworking space.</p>
                                <p>To participate in our passport program, you just need to specify amount you are going to charge for each/any type of seat you have. System will automatically convert your 
                                    charges to equivalent credits of the program and save your details. Passport program will give users flexibility to use your coworking space on the go and it will be great benefit for you to generate more revenue.</p>
                            </div>
                        </div>
                        <form method="post" action="{{url('client/passportConfig')}}">    
                            {{ csrf_field() }}
                            <div class="row">
                                <input type="hidden" value="{{$spaceid}}" id="spaceId" name="space_id">

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Select Seating Types</label>
                                        <?php $SeatingTypes = $SeatingTypes->where('is_inquiry_only', '0'); ?>
                                        <select required class="form-control single-select select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" name="seatingtypes">
                                            <option value="">Choose Seating Types</option>
                                            @foreach($SeatingTypes as $types)

                                            <option value="{{ $types->id }}"> {{ $types->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="inFName">Price Per Day</label>
                                        <input style="" required="" type="number"  value="" class="form-control" onkeyup="calculateCredit(this);" name="per_day" id="per_day" placeholder="i.e. 500" maxlength="100">
                                        <label class="perDayCredits credits centerElement"></label>

                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="inFName">Price Per Week</label>
                                        <input required="" type="number"  value="" class="form-control" name="per_week" onkeyup="calculateCredit(this);" id="per_week" placeholder="i.e. 1000" maxlength="100">
                                        <label class="perWeekCredits credits centerElement"></label>

                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="inFName">Price Per Month</label>
                                        <input required="" type="number"  value="" class="form-control" name="per_month" onkeyup="calculateCredit(this);" id="per_month" placeholder="i.e. 10000" maxlength="100">
                                        <label class="perMonthCredits credits centerElement"></label>

                                    </div>
                                </div>
                            </div>

                            <div class="row">                                
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <p class="errorMsg">{{$errorMsg}}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-info waves-effect waves-light m-1 pull-right" name="submit"  value="Save"/>
                                        <button type="button" class="btn btn-danger waves-effect waves-light m-1 pull-right" data-toggle="modal" data-target="#modal-animation-1">Leave Passport Program</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title">Passport Details For this Space</div>
                        <div class="table-responsive">
                            <table id="default-datatable" class="table table-bordered">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <thead>
                                    <tr>
                                        <th class="tablehaeder">Passport Program </th>
                                        <th class="tablehaeder">Seating Type</th>
                                        <th class="tablehaeder">Per Day</th>
                                        <th class="tablehaeder">Per Week</th>
                                        <th class="tablehaeder">Per Month</th>
                                        <th class="tablehaeder"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($passportConfigs as $passport)
                                    <tr>
                                        <td>{{$passport->seatingType_name}}</td>
                                        <td>{{$passport->credit_per_day}}</td>
                                        <td>{{$passport->credit_per_week}}</td>
                                        <td>{{$passport->credit_per_month}}</td>
                                        <td>

                                            <a passportSPaceId="{{$passport->id}}"  seatingtypeid="{{$passport->seatingType_id}}" onclick="return deletePassportSpacesBySeatingTypeId(this);">
                                                <i aria-hidden="true" class="fa fa-times-circle" title="Delete record from space seating types."></i> 
                                                <span class="sr-only">Example of</span></a>
                                        </td>
                                <meta name="csrf-token" content="{{ csrf_token() }}">

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="tablefooter">Passport Program </th>
                                        <th class="tablefooter">Seating Type</th>
                                        <th class="tablefooter">Per Day</th>
                                        <th class="tablefooter">Per Week</th>
                                        <th class="tablefooter">Per Month</th>
                                        <th class="tablefooter"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modal-animation-1" style="display: none;" aria-hidden="true">
    <!--    <form method="post" action="{{url('client/passportdeleteBySpaceID')}}/{{$spaceid}}"> -->
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <div class="modal-dialog">
        <div class="modal-content animated flipInX">
            <div class="modal-header">
                <h5 class="modal-title">Leave Passport Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to quit from Passport Program? This program has better chances for you to get more customers, please click ok to continue.</p>

            </div>
            <div class="modal-footer">
                <!--<input type="submit"  name="submit" class="btn btn-success" value="OK"><i class="fa fa-check-square-o"></i>-->
                <button type="button" class="btn btn-success" onclick="return deletePassportSpacesBySpaceId(this);"><i class="fa fa-check-square-o"></i> OK</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>

            </div>
        </div>
    </div>
</form>
</div>
@endsection
@section('script')
<script src="{{asset('/js/passport.js')}}"></script>
@endsection

