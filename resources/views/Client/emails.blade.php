@extends('Masters.ClientSpace')
@section('css')

@endsection

@section('spacedetail')
<div class="content-wrapper">
    {{ csrf_field() }}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="modal fade" id="modal-mailBody" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content animated flipInX">
                <div class="modal-header">
                <h5 class="modal-title">Mail Body</h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                    <div class="modal-body">
                    <iframe src="" name="iframe_for_email" id='iframe_for_email' height="500px" width="100%" title="Iframe Example"></iframe>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="modal-mailDetails" style="display: none;" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content animated flipInX" style='max-height: 550px;overflow: auto;'>
                <div class="modal-header">
                <h5 class="modal-title">Recipients List</h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                    <div class="modal-body">
 <div class="defaulrMailListDiv d-none">
     <h6 class='name mb-1'></h6>
     <p class='text-muted email mb-0'></p>
     <hr class='mt-2 mb-2'>
 </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="container">
        <div class="Data-Table">
        <div class="card">
                    <div class="card-header">
                        <i class="fa fa-table pt-3"></i> Past Emails
                        <span class="pt-3 addMyInquiry c-pointer" onclick="window.location.href = '{{url('client/sendEmail')}}'"  style="cursor:pointer;float: right;"></i>Send New Emails</span>
                     
                    </div>
                    <div class="card-body">
                        <div class="table-responsive dt-responsive inqtab" id="default-datatable_wrapper">
                        <div class="parent ">
                      @foreach($emailsdata as $email)
                    <div class='row col-lg-12  col-md-12 w-auto emailDetails'>
                    <div class="col-lg-3 col-md-3 col-6 mb-2">
<div class="leftAlignMobile font-500 text-dark bordernone spaceTypeName"  > {{ \Carbon\Carbon::parse($email->created_at)->rawFormat('jS F Y')}} </div>
                                                                <p class="spaceSeatingHeading">Date</p>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-6 mb-2">
                                                                                <div class="leftAlignMobile font-500 text-dark bordernone spaceTypeName">  {{$email->subject}}</div>
                                                                <p class="spaceSeatingHeading">Subject</p>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2 col-6 mb-2" >
       <div class="leftAlignMobile font-500  ml-4 bordernone spaceTypeName c-pointer" onclick="openEmailPopup(this)"  style='color: #14abef;'>  {{count($email->emailRecipients)}}</div>
                                                                <p class="spaceSeatingHeading">Recipients</p>
                                                            </div>
                                                            <div class="col-lg-2 col-md-3 col-6 mb-2">
                                                                                <div class="leftAlignMobile font-500 text-dark bordernone spaceTypeName">{{$email->from_name}}</div>
                                                                <p class="spaceSeatingHeading">From name</p>
                                                            </div>
                                                             <div class="col-lg-2 col-md-2 col-6 mb-2">
                                                               <a href="{{url('client/email/' . $email->id )}}"  onclick="openEmailBody(this)" target="iframe_for_email">Mail Body</a>
                                                            </div>
                                                            <div class="listof_emails">
                                                            @foreach($email->emailRecipients as $recipients)
<input type="hidden" name="" class='' data-email='{{$recipients->inquiry->email}}' data-name='{{$recipients->inquiry->name}}'>
                                                                @endforeach
                                                            </div>
                                                            <li class="dropdown-divider mb-4 mt-2" style="width:100%"></li>
                    </div>
 
                                                            @endforeach
                    </div>
    
                        </div>
                    </div>
                </div>
            </div>
    </div>
  <div class='pull-right mr-4'>
  <?php echo $emailsdata->links(); ?>
  </div>
   
</div>
            

    <!-- End container-fluid-->


@endsection


