var seatDetails = [];
$(document).ready(function () {

  $('.bookNowType').on('click', function (){
    let seatTypeId = $(this).attr('seat-type-id');
    $('#bookSeatModal').find('select[name="seatingType"]').val(seatTypeId);
  });


  $("#book_seating_options").on('change' , function(){
    changeavailabilyButton(this)
  });

  $(".datePickerForSeating").on('change' , function(){
    changeavailabilyButton(this);
  });
  
 $('.changeBtn').on('change' , function(){
   $(this).closest('form').find('.proceedbtn').addClass('d-none');
   $(this).closest('form').find('.checkAvailabilityBtn').removeClass('d-none');
 })
 
 $('[name="start_time"],[name="end_time"]').datetimepicker().on('dp.change', function (event) {
  $(this).closest('form').find('.proceedbtn').addClass('d-none');
  $(this).closest('form').find('.checkAvailabilityBtn').removeClass('d-none');
});


//  $("input[name='meetingDuration']").on('change', function (){
//  let value =  $('input[name=meetingDuration]:checked').val()
//      if(value == "hourly"){

//   }

//      else{
     
//       $(this).closest('form').find('[name="start_time"]').val('');
//       $(this).closest('form').find('[name="end_time"]').val('');

//      }
//  })

  $( "[name='duration_days']").on('change' , function(){
    changeavailabilyButton(this);
  });


    var currentInquiryCount = 1;
    $('[name="noofSeats"]').on('change' , function (){
      changeavailabilyButton(this);
        let seat_count = $(this).val();
        seat_count = parseInt(seat_count);

        let diffrence = seat_count -  currentInquiryCount ;
if(diffrence > 0){
  
    for (let i = 0; i < diffrence; i++) {
        let inquiryInput  = $('.inquiryInputsDefault').clone();
        inquiryInput.find('input').val('');
        inquiryInput.find('input').removeAttr('required');
        inquiryInput.removeClass('inquiryInputsDefault');
        inquiryInput.addClass('inquiryInputs');
      $('.inquiryBookParent').append(inquiryInput);
    }
}
else{
  for(let i = diffrence; i < 0; i++){
    $('.inquiryInputs').last().remove();
  }
}

if(seat_count > 0){
    currentInquiryCount = seat_count;
}else{
    currentInquiryCount = 1;
}
    })

});


function changeavailabilyButton(element){
  let currentModel = $(element).closest('.modal')
  currentModel.find('.proceedbtn').addClass('d-none');
  currentModel.find('.checkAvailabilityBtn').removeClass('d-none');
}

function bookNow(element){
  let BookingDetails = {};
  let inquiryDetails = [];
  let payNowUrl = $('.payNowUrl').val();
  let url = $('.saveSeatDetailsUrl').val();
  let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
 let currentModal = $(element).closest('.modal');

 currentModal.find('.inquiryBookParent').find('.inquiryInputsDefault, .inquiryInputs').each(function (){
  let ob = new Object();
  ob.name = $(this).find('input[name="name"]').val();
  ob.email = $(this).find('input[name="emailAddress"]').val();
  ob.phoneNumber = $(this).find('input[name="phnum"]').val();
  inquiryDetails.push(ob);

}) 
showLoader();
BookingDetails.inquiryDetails = inquiryDetails;
BookingDetails.num_of_seat = currentModal.find('input[name="noofSeats"]').val();
BookingDetails.seating_type_id = currentModal.find("#book_seating_options").children("option:selected").val();
BookingDetails.start_date = currentModal.find('.datePickerForSeating').val();
BookingDetails.duration = currentModal.find('input[name="duration_days"]').val();
BookingDetails.seatDetails = seatDetails;
BookingDetails.space_id = $('.spaceIdforBooking').val();

  

$.ajax({
  url: url,
  type: "post",
  data: {_token: CSRF_TOKEN, bookingDetails: BookingDetails},
  success: function (response) {
 console.log(response);
  if($.trim(response) == "Success"){
    
    window.location = payNowUrl;
  }  
  else{
    hideLoader();
    alert('Something Went Wrong Please Try After some time.')
  }

  },
  error:function (error){
    hideLoader();
  }


})

}


function checkBookingAvailability(element){
  let modal = $(element).closest('.modal');
  modal.find('.small-loader').removeClass('d-none');
  event.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
  var spaceId = modal.find(".spaceIdforBooking").val();
  var selectedSeatingTypeId = modal.find("#book_seating_options").children("option:selected").val();
  var selectedDate = modal.find("[name='datetime']").val();
  var durationDays = modal.find("[name='duration_days']").val();
  var noofSeats = modal.find("[name='noofSeats']").val();
  var url = $(".checkBookingAvailability").val();
 
  $.ajax({
      url: url,
      type: "post",
      data: {_token: CSRF_TOKEN, spaceId: spaceId, selectedSeatingTypeId: selectedSeatingTypeId, selectedDate: selectedDate, durationDays: durationDays, noofSeats: noofSeats},
      success: function (response) {
        
          
          modal.find('.small-loader').addClass('d-none');
          if($.trim(response) == "0"){
           modal.find('.occupySeatAvailable').html('');
           modal.find('.proceedbtn').addClass('d-none');
           modal.find('.checkAvailabilityBtn').removeClass('d-none');
           modal.find('.occupySeatDateError').text('There is no seats availble in this seating area for selected time slot and num of person.');
          }
          else{
              let personCount = 0;
              let seatPriceHtml = ''; 
              noofSeats = parseInt(noofSeats);
              seatDetails = [];
              response.forEach(element => {
                let num_of_person = element.num_of_person ;
                num_of_person = parseInt(num_of_person);
                if(num_of_person == 0){
                  return true;
                }
                let ob = new Object();
                  personCount += num_of_person;
                  if( personCount <= noofSeats){
                    
                      seatPriceHtml +=   num_of_person + ' seat  is available at ₹' + element.price_daily + " per day per person, ";
                      ob.num_of_person = num_of_person;
                      
                  }
                  else{
let diffrence = noofSeats - ( personCount - num_of_person);
seatPriceHtml += diffrence + ' seat  is available at ₹' + element.price_daily + " per day per person, ";
ob.num_of_person = diffrence;
                  }                  
                      ob.seating_type_id = element.id;
                      ob.price = element.price_daily;
                      seatDetails.push(ob);
              });
              modal.find('.occupySeatDateError').text('');
              modal.find('.occupySeatAvailable').html( seatPriceHtml + ' according to your selection. Click on Proceed to Book button below to continue.');
              modal.find('.proceedbtn').removeClass('d-none');
              modal.find('.checkAvailabilityBtn').addClass('d-none');
            
          }
      },
      error: function(response){
        modal.find('.small-loader').addClass('d-none');
          
      }
  });
}


function bookMeetingNow(){
  let BookingDetails = {};
  let inquiryDetails = [];
  let payNowUrl = $('.payNowUrl').val();
  let url = $('.saveSeatDetailsUrl').val();
  let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  let form = $('#meetingRoomBookingForm');


  let ob = new Object();
  ob.name = form.find('input[name="name"]').val();
  ob.email = form.find('input[name="emailAddress"]').val();
  ob.phoneNumber = form.find('input[name="phnum"]').val();
  inquiryDetails.push(ob);

  

BookingDetails.inquiryDetails = inquiryDetails;
BookingDetails.duration_type = $('input[name=meetingDuration]:checked', '#meetingRoomBookingForm').val()
BookingDetails.seating_type_id = "6";
BookingDetails.start_date = form.find('input[name="datetime"]').val();
BookingDetails.duration = form.find('input[name="duration_days"]').val();
BookingDetails.space_id = $('.spaceIdforBooking').val();
BookingDetails.num_of_person = form.find('[name="capacity"]').find('option:selected').attr('data-person');
BookingDetails.space_meeting_room_id = form.find('[name="capacity"]').val();
BookingDetails.price_per_day = form.find('[name="capacity"]').find('option:selected').attr('price-day');
BookingDetails.price_per_hour = form.find('[name="capacity"]').find('option:selected').attr('price-hour');
BookingDetails.start_time = form.find('[name="start_time"]').val();
BookingDetails.end_time = form.find('[name="end_time"]').val();

  
console.log(BookingDetails);
showLoader();
$.ajax({
  url: url,
  type: "post",
  data: {_token: CSRF_TOKEN, bookingDetails: BookingDetails},
  success: function (response) {
 console.log(response);
  if($.trim(response) == "Success"){
    window.location = payNowUrl;
  }  
  else{
    hideLoader();
    alert('Something Went Wrong Please Try After some time.')
  }

  },

  error:function (error){
    hideLoader();
  }


})



}

// meeting room Booking code 

function checkMeetingAvailability(element){
  $(element).find('.occupySeatDateError').text('');
  $(element).find('.occupySeatAvailable').html('');
  event.preventDefault();
  $(element).find('.small-loader').removeClass('d-none');
 
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content'); 
var space_id = $(".spaceIdforBooking").val();
 let duration = $(element).find('[name="duration_days"]').val();
 let start_date = $(element).find('[name="datetime"]').val();
 let start_time = $(element).find('[name="start_time"]').val();
 let end_time = $(element).find('[name="end_time"]').val();
 let duration_type= $(element).find('input[name=meetingDuration]:checked', '#meetingRoomBookingForm').val()
 let meeting_room_id = $(element).find('[name="capacity"]').val()
 
  let url = $(element).attr('action');

  $.ajax({
      url: url,
      type: "post",
      data: {_token: CSRF_TOKEN, space_id: space_id , start_date:start_date , duration_type:duration_type , duration: duration , start_time: start_time, end_time: end_time , meeting_room_id:meeting_room_id},
      success: function (response) {
          console.log(response);
          $(element).find('.small-loader').addClass('d-none');
         if(response.message == true ){
           let duration_text = duration_type  == "hourly" ? 'hour' : 'day'; 
         
          $(element).find('.occupySeatAvailable').html(`Meeeting room is available you can book meeting room at ${response.price} per ${duration_text}. Click on Proceed to Book button below to continue.`);
   $(element).find('.proceedbtn').removeClass('d-none');
   $(element).find('.checkAvailabilityBtn').addClass('d-none');


         }
         else{
          $(element).find('.occupySeatDateError').text('There is no meeting room availble in this space for  selected time slot and capacity.')
         }

      },
      error: function(response){
        $(element).find('.small-loader').addClass('d-none');
          console.log(response);
      }
  });
}