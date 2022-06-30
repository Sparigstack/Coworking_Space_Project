
$(document).ready(function () {
    

    $(document).on('click', '.occupyMeeting',function(){ 
        let meeting_room_id = $(this).attr('meeting-id');    
        $('.space_meeting_room_id').val(meeting_room_id);
        $('#occupyMeetingRoom').modal('show');
    })

    $('[data-toggle="popover"]').popover({
        trigger: 'hover',
        html: true,
        placement: "top"
    });

   
    // $("input[name='meetingDuration']").on('change', function (){
    //     let value =  $('input[name=meetingDuration]:checked').val()
    //         if(value == "hourly"){
    //      $(this).closest('form').find('[name="start_time"]').attr('required' , 'required');
    //      $(this).closest('form').find('[name="end_time"]').attr('required' , 'required');
    //      $(this).closest('form').find('[name="duration_days"]').removeAttr('required');
    //      }
    //         else{
    //          $(this).closest('form').find('[name="start_time"]').removeAttr('required' );
    //          $(this).closest('form').find('[name="end_time"]').removeAttr('required');
    //          $(this).closest('form').find('[name="duration_days"]').attr('required' , 'required');
    //          $(this).closest('form').find('[name="start_time"]').val('');
    //          $(this).closest('form').find('[name="end_time"]').val('');
       
    //         }
    //     })



    $( "#occupyMeetingRoom" ).on('shown', function(){
        $(this).find('.searchSeatcontactdet').removeClass('d-none');
    });


    $('#occupyMeetingRoom').on('hidden.bs.modal', function () {
    //   $(this).find('input').val('');
    //   $('.searchSeatcontactdet').removeClass('d-none');
      $('.contactDetails').addClass('d-none'); 
    //   $('.meetingpopupTitle').text('Occupy Meeting Room'); 
      $('.newContactPerson').addClass('d-none');
      $('.addNewDetDiv').addClass('d-none');
      $('.userSearchCard').remove();
      $('.alreadyaddedContactPerson').removeClass('d-none');
      $('.backBtnContact').addClass('d-none');
      $("[name='name']").removeAttr('required')
      $("[name='email']").removeAttr('required')
      $("[name='phone_number']").removeAttr('required')
$('.alertMSG').addClass('d-none');
$('.meetingError').text('');
    });


    $('#occupyMeetingroomForm , #editMeetingroomForm').on('submit' , function (e){
e.preventDefault();
e.stopImmediatePropagation();
occupyMeetingRooms(this);
    });

    $(document).on('click', '.editMeatingRoom', function(event) {
        // $('.meetingpopupTitle').text('Edit Occupier Details');
        setModalContent(this);
    });

})





function vacantMetingRoom(element){
    if (!confirm("Are you sure you want to vacant this Meeting Room?")) {
return;
    }
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
let allocationId = $(element).closest('form').find('.allocation_id').val();
let meeting_id = $(element).closest('form').find('.space_meeting_room_id').val();

showLoader();
let currentMeetingRoom = $(".container").find(`[meeting-id='${meeting_id}']`);
let imgSrc = $(currentMeetingRoom).attr('src');
let classList = $(currentMeetingRoom).attr('class');
currentMeetingRoom.closest('.card').find('.occupiedMeeting').remove();
let url = $('.vacantMeetingRoomurl').val();

    $.ajax({
        url: url,
        type: "post",
        data: {_token: CSRF_TOKEN, id: allocationId},
        success: function (response) {
            hideLoader();
           
         
           while(currentMeetingRoom[0].attributes.length > 0)
           currentMeetingRoom[0].removeAttribute(currentMeetingRoom[0].attributes[0].name);
           $(currentMeetingRoom).attr('class' , classList);
           $(currentMeetingRoom).attr('src' , imgSrc);
           $(currentMeetingRoom).removeClass('editMeatingRoom');
           $(currentMeetingRoom).addClass('occupyMeeting');
           $(currentMeetingRoom).attr('meeting-id' , meeting_id);
           $(currentMeetingRoom).popover('dispose');
           $('#EditUserDetailsPopup').modal('hide');
        },
        error:function(){
            hideLoader();
        }
    });


}
function setModalContent(element){
  let name =  $(element).attr('name');
  let email =$(element).attr('email')
  let phone_number =$(element).attr('phone_number');
  let seat_charges =$(element).attr('seat_charges');
  let  start_time=$(element).attr('start_time');
  let  end_time=$(element).attr('end_time');
  let lead_source =$(element).attr('lead_source');
  let allocation_id =$(element).attr('allocation_id');
  let meeting_id =$(element).attr('meeting-id');
  let date = $(element).attr('date');
 let end_date = $(element).attr('end-date');
  let inquiry_id = $(element).attr('inquiry-id')
  let duration_type = $(element).attr('duration_type');

  var given = moment(date, "YYYY-MM-DD");
  var current = moment(end_date, "YYYY-MM-DD");

//Difference in number of days
let duration_days = 1;
if(current){
     duration_days = moment.duration(given.diff(current)).asDays();
     duration_days = duration_days + 1;
}
 
  let modal = $('#EditUserDetailsPopup');

  var now = new Date(date);
  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);
  var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
  
  $('#datePicker').val(today);
if(duration_type == "hourly"){
    $(modal).find('input[name=meetingDuration][value=hourly]').prop('checked',true);
    $(modal).find("[name='start_time']").closest('.form-group').removeClass('d-none');
    $(modal).find("[name='end_time']").closest('.form-group').removeClass('d-none');
    $(modal).find("[name='duration_days']").closest('.form-group').addClass('d-none');
    
}
else{
    $(modal).find('input[name=meetingDuration][value=daily]').prop('checked',true);
    $(modal).find("[name='duration_days']").closest('.form-group').removeClass('d-none');
    $(modal).find("[name='start_time']").closest('.form-group').addClass('d-none');
    $(modal).find("[name='end_time']").closest('.form-group').addClass('d-none');
    $(modal).find("[name='duration_days']").val(duration_days);
}


  $(modal).find("[name='seat_charges']").val(seat_charges);
  $(modal).find("[name='start_time']").val(start_time);
  $(modal).find("[name='end_time']").val(end_time);
  $(modal).find("[name='lead_source']").val(lead_source);
  $(modal).find("[name='end_time']").val(end_time);
  $(modal).find("[name='date']").val(date);
  $(modal).find(".allocation_id").val(allocation_id);
  $(modal).find(".space_meeting_room_id").val(meeting_id);
  $(modal).find(".added_inquire_id").val(inquiry_id);

  $(modal).find('.invoiceTo').text(name);
  $(modal).find('.inquiry_id').val(inquiry_id);
  $(modal).find('.invoice_occupation_id').val(allocation_id);

  $('.contactDetails').removeClass('d-none');
  $('.contactDetails').find('.contact_name').text(name);
  $('.contactDetails').find('.contact_phone').text(phone_number);
  $('.contactDetails').find('.contact_email').text(email);
  $(modal).find('.searchSeatcontactdet').addClass('d-none');

  $(modal).modal('show');
  
}




function occupyMeetingRooms(element){
let url = $(element).attr('action');
let form = $(element)[0];
$('.meetingError').text('');
let name = $(element).find('.occupier_name').val();
let email = $(element).find('.occupier_email').val();
let phone_number = $(element).find('.occupier_phone_number').val();
let inquiry_id = $(element).find('.added_inquire_id').val();
let formData =new FormData(form);
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
formData.append('_token', CSRF_TOKEN);

showLoader();
$.ajax({
    url:url,
    data:formData,
    type:'post',
    contentType:false,
    processData:false,
    success:function(response){
        // future Meeting 
        // present Meeting
        // Past Meeting 
        // conflict error 

      
        if(response.message == 'notAvailable'){
            hideLoader();
            $('.meetingError').text('Meeting room is already occupied for this slot. Please Select different slot.');
            return;
           }
else{
//     let currentMeetingRoom = $(".container").find(`[meeting-id='${response.data.space_meeting_room_id}']`);
//     if(response.message == 'future'){

//         if(response.action == "edit"){
//             location.reload();
//         }
//            let meetinglistDiv = $('.meetingList').first().clone();
//            $(meetinglistDiv).removeClass('d-none');
//            $(meetinglistDiv).find('.removeLink').attr('data-id' , response.data.id);
//            $(meetinglistDiv).find('.date').text(moment(new Date(response.data.date)).format('Do MMMM YYYY'));
//            $(meetinglistDiv).find('.list_start_time').text(response.data.start_time);
//            $(meetinglistDiv).find('.list_end_time').text(response.data.end_time);
//            $(meetinglistDiv).find('.date').attr('data-id' , response.data.date + response.data.start_time);
           
//            $(currentMeetingRoom).closest('.card').find('.parentListMeetingRoom').append(meetinglistDiv);
       
//    }
//    else if (response.message == 'present'){

// let data_content="<b style='text-align:center;'>Occupier Details</b> <br> <b>Name:</b> "+ response.data.inquiry.name +" <br> <b>Email</b>: "+ response.data.inquiry.email +" <br> <b>Phone no:</b> "+ response.data.inquiry.phone_number +"  <br><b> Seat Charges:</b> ₹"+ response.data.seat_charges +"  <br> <b> Start time :</b> "+ response.data.start_time +" <br> <b>End time:</b> "+ response.data.end_time +" ";


// $(currentMeetingRoom).attr('data-content' , data_content)
// $(currentMeetingRoom).removeClass('occupyMeeting');
// $(currentMeetingRoom).addClass('editMeatingRoom');

// $(currentMeetingRoom).attr('data-toggle' , "popover")
// $(currentMeetingRoom).attr('name' , response.data.inquiry.name)
// $(currentMeetingRoom).attr('email' , response.data.inquiry.phone_number)
// $(currentMeetingRoom).attr('phone_number' , response.data.inquiry.email)
// $(currentMeetingRoom).attr('date' , response.data.date)
// $(currentMeetingRoom).attr('start_time' , response.data.start_time)
// $(currentMeetingRoom).attr('end_time' , response.data.end_time);
// $(currentMeetingRoom).attr('seat_charges' , response.data.seat_charges);
// $(currentMeetingRoom).attr('lead_source' , response.data.lead_source);
// $(currentMeetingRoom).attr('allocation_id' , response.data.id);
// $(currentMeetingRoom).attr('inquiry-id' , inquiry_id);

// if(response.action == "add"){
//     $(currentMeetingRoom).before('<div class="occupiedMeeting occupiedTag  d-inline-block" style=""> Occupied</div>')
//        $('[data-toggle="popover"]').popover({
//            trigger: 'hover',
//            html: true,
//            placement: "top"
//        });
// }

       
//    }
//    else if (response.message == 'past'){
//     location.reload();
//    }
//    $('#occupyMeetingRoom').modal('hide');
//    $('#EditUserDetailsPopup').modal('hide');

//    $('#occupyMeetingRoom').find('input').val('');
//    $('#EditUserDetailsPopup').find('input').val('');

   location.reload();
// console.log(response);

}
        
    },
    error:function(error){
        console.log(error);
    }

})
}




function deleteMeetingOccupation(element){
    if (!confirm("Are you Sure you want to Delete  this Meeting Room Booking?")) {
        return;
      } 

    var id = $(element).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   
   showLoader();
    $.ajax(
    {
        url: "allocateMeetingRooms/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (){
 
            hideLoader();
            $(element).closest('.meetingList').remove();
        },
        error:function (error){
     
            hideLoader();
        }
    });
}