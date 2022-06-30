$(document).ready(function () {

   $('[name="duration_days"] ,[name="duration_charges"]').on('change' , function (){
let dayOrMonth = $(this).closest('form').find('[name="duration_days"]').val();
let price = $(this).closest('form').find('[name="duration_charges"]').val();
if(dayOrMonth && price){
    dayOrMonth = parseInt(dayOrMonth);
    price = parseInt(price);
    
    let totalCharges = dayOrMonth * price;
    $(this).closest('form').find('.totalChargesInput').val(totalCharges);
    $(this).closest('form').find('.totalCharges').text(totalCharges);
}



   });


    $('.closeModal').on('click' , function () {
        $(this).closest('.modal').modal('hide');
    });

    $('#EditUserDetailsPopup').on('hidden.bs.modal', function () {
        clearInvoiceDetails();
    });

    $( "#vacantSeatmodel" ).on('shown', function(){
        $('.modaldeskText')
    });

    $('#OccupySeatForm').on('submit' , function (e){
        e.preventDefault();
          occupySeatForm(this);
        
            })


 $('#sendInventoryForm').on('submit', function (e) {
        e.preventDefault();
        addInventorytouser(this);
    });
    

    
     $(document).on('click', '.cancelInventoryListItem', function () {
        $(this).closest('.InventorylineItem').remove();
        
    });
      
      var j = 1;
    $('.addinventoryitemrow').on('click', function () {
        ++j;
        let InventorylineItem = $('.inventorylineitem').first().clone();      
        InventorylineItem.removeClass('defaultinventorylineitem');
        InventorylineItem.addClass('clonedInventoryItemClass');
        InventorylineItem.find('.inventoryCategories').val('');
         InventorylineItem.find('.getQuantity').val('');
         InventorylineItem.find('.SellPriceInput').val('');
         InventorylineItem.find('.PurchasePriceInput').val('');
         InventorylineItem.find('.totalStock').html('');
         InventorylineItem.find('.cancelInventoryListItem').removeClass('d-none');
        
        
        $('.parent_Inventory_items').append(InventorylineItem);
      
    });
    
    

    var typingTimer; //timer identifier
    var doneTypingInterval = 1000; //time in ms, 1 second for example
    var $input = $('.getQuantity');

//    //on keyup, start the countdown
//    $input.on('keyup', function() {
//        clearTimeout(typingTimer);
//        var element = $(this);
//         
//        typingTimer = setTimeout(function() {
//             checkQuantitystock(element);
////            $('.fa.fa-spin').addClass('d-none');
////            $('.cancelsearch').removeClass('d-none');
//        }, doneTypingInterval);
//    });
//
//    //on keydown, clear the countdown 
//    $input.on('keydown', function() {
//        clearTimeout(typingTimer);
//        $('.alertforQuantity').addClass('d-none');
////        $('.fa.fa-spin').removeClass('d-none');
////        $('.cancelsearch').addClass('d-none');
//    });
//    
//    





})

function checkQuantitystock(element){
         var parent = findParent(element);
        var getQuantityval=$(element).val();
        var dataQuantity =  $('#categories').find(':selected').attr('data-quantity');
        if(getQuantityval>dataQuantity){
            $(parent).find('.alertforQuantity').removeClass('d-none');
//            $('.alertforQuantity').removeClass('d-none');
            $(element).val("");
        }else{
             $(parent).find('.alertforQuantity').addClass('d-none');
        }
//   $('.getQuantity').val(dataQuantity);
//        var getQuantityval=$('.getQuantity').val();
        
    }
    
     $('.SendInventorybtn').submit(function(e) {
    //e.preventDefault();
    // Coding
    $('#EditUserDetailsPopup').modal('toggle');
    //$('#nav-inventory').modal('toggle'); //or  $('#IDModal').modal('hide');
    return false;
});

 



function occupySeatForm(element){
    $('.occupySeatDateError').text('');
    let url = $(element).attr('action');
    let form = $(element)[0];
    showLoader();
    $.ajax({
        url:url,
        data:new FormData(form),
        type:'post',
        contentType:false,
        processData:false,
        success:function(response){
           
    if(response == 'noSeat'){
        hideLoader();
$('.occupySeatDateError').text('There is no seats availble in this seating area for selected time slot.');
return;
    }
    else if (response == 'Success'){
location.reload();
    }
        },
        error:function(error){
            hideLoader();
            console.log(error);
        }
    
    })
    }







function vacantSeat(element){
    if (!confirm("Are you Sure you want to Vancant this seat ?")) {
        return;
      } 

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
    let url = $('.vacantSeatUrl').val();
    let id = $(element).attr('data-id');
    let seat_id = $(element).attr('seat-id');

    showLoader();
    $.ajax({
        url:url,
        type:'post',
        data: { _token: CSRF_TOKEN, id: id},
        success:function(response){
            $('.checkboxclass').prop('checked', false);
            $('.checkboxclass').val("0");
            $('.Gopassclass').hide();
            $('.checkboxbtns').hide();
            $('.Go_pass_num_alertmsg').text('');
            console.log(response);
            // for private cabin 
            if(seat_id == "4"){
                $('.privateCabinArea[occupation-id="' + id + '"]').attr('data-toggle' , 'modal');
                $('.privateCabinArea[occupation-id="' + id + '"]').attr('data-target' , '#vacantSeatmodel');
                $('.privateCabinArea[occupation-id="' + id + '"]').popover('dispose');
                $('.privateCabinArea[occupation-id="' + id + '"]').removeAttr('onclick occupation-id data-content name phone_number');
                $('.percentOffRibbon').addClass('d-none');

            }
            else{
                $('.SeatIconswithname[occupation-id="' + id + '"]').empty(); 
                $('.SeatIconswithname[occupation-id="' + id + '"]').addClass('SeatIcons') ;
                $('.SeatIconswithname[occupation-id="' + id + '"]').append('<img src="../images-new/hotSeatIcon.svg" class="c-pointer seatImg" data-toggle="modal" data-target="#vacantSeatmodel">');
                $('.SeatIconswithname[occupation-id="' + id + '"]').removeClass('SeatIconswithname');  
            }
         
            $('#EditUserDetailsPopup').modal('hide');        
            hideLoader();
        },
        error:function(error){
            hideLoader();
  console.log(error)
        }
    });
}

function deleteOccupation(element){
    if (!confirm("Are you sure you want to remove record and vacant seat for this particular date duration?")) {
        return;
      } 

    var id = $(element).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
   showLoader();
    $.ajax(
    {
        url: "deleteOccupation/"+id,
        type: 'DELETE',
        data: {
            "id": id,
            "_token": token,
        },
        success: function (){
 
            hideLoader();
            $(element).closest('.futureSeatList').remove();
        },
        error:function (error){
     
            hideLoader();
        }
    });
}




function editSeatDetails(element){
    showLoader();
    const name = $(element).attr('name');
    const phone_number = $(element).attr('phone_number');
    const email = $(element).attr('email');
    let  start_date= $(element).attr('start_date');
    const duration = $(element).attr('duration');
    const duration_period = $(element).attr('duration_period');
    const seat_charges = $(element).attr('seat_charges');
    const inquire_id = $(element).attr('inquire_id');
    const lead_source = $(element).attr('lead_source');
    const occupation_id = $(element).attr('occupation-id');
    const seat_id = $(element).attr('seat-id');
    const  go_pass_num =$(element).attr('go_pass_num');
    //var Go_passport_id =$(element).attr('Go_passport_id');
    const duration_charges = $(element).attr('duration_charges');

let popup = $('#EditUserDetailsPopup');


// $('.setseatcharge').val(seat_charges);

popup.find('.SellPriceInput').val("");
popup.find('.PurchasePriceInput').val("");
popup.find('.inventoryCategories ').val("");
popup.find('.getQuantity').val("");
popup.find('.totalStock').html('');
popup.find('.clonedInventoryItemClass').remove();
popup.find('.contact_name').text(name);
popup.find('.contact_phone').text(phone_number);
popup.find('.contact_email').text(email);

popup.find('.added_inquire_id').val(inquire_id);
popup.find('.old_inquire_id').val(inquire_id);
var seatname=popup.find(element).attr('seat-name');
// popup.find('#datetime').datepicker("setDate", new Date(start_date) );
// start_date = new Date(start_date)
start_date = start_date.split('/').reverse().join("-");

popup.find('#datetime').val(start_date);
popup.find('#duration_days').val(duration);

if(duration_period ==  "2"){
    popup.find('.chargesBasis').text('Charges per Month');
}else{
    popup.find('.chargesBasis').text('Charges per Day');
}


popup.find('#seat_duration').val(duration_period);
popup.find('#duration_charges').val(duration_charges);
popup.find('.totalCharges').text(seat_charges);
popup.find('.totalChargesInput').val(seat_charges);
popup.find('#lead_source').val(lead_source);
popup.find('.vacantSeatLink').attr('data-id',occupation_id );
popup.find('.vacantSeatLink').attr('seat-id', seat_id);
popup.find('.occupation_id').val(occupation_id);
popup.find('.invoice_occupation_id').val(occupation_id);
popup.find('.seatname').val(seatname);
popup.find('.vacantSeatLink').removeClass('d-none');
popup.find('.addEditText').text('Edit');
popup.find('.searchSeatcontactdet').addClass('d-none');
popup.find('#vacantSeatmodel').modal();
popup.find('.contactDetails').removeClass('d-none');
popup.find('#Addedname').prop('required',false);
popup.find('.invoiceTo').text(name);
popup.find('.inquiry_id').val(inquire_id);


 
    popup.find('.addinquiry_id').val(inquire_id);



if(go_pass_num == ''){
    
    popup.find('#Gopass').prop('checked', false);
    popup.find('.checkboxclass').val("0");
    popup.find('.Gopassclass').css('display','none');
    popup.find('.checkboxbtns').css('display','none');
    popup.find('.Gopassclass').val("");
   popup.find('.Go_pass_num_alert').addClass("d-none");
    
    // console.log(popup.find('.checkboxclass'));
    // console.log( popup.find('.Gopassclass'));

      
   
  }else{
      
    popup.find('.checkboxclass').val("1");
    popup.find('.checkboxclass').prop('checked', true);
    popup.find('.Gopassclass').css('display','block');
    popup.find('.Gopassclass').val(go_pass_num);
    popup.find('.checkboxbtns').css('display','block');
    popup.find('.checkboxclass').val("1");
    popup.find('.Go_pass_num_alert').addClass("d-none");
    // console.log(popup.find('.checkboxclass'));
    // console.log( popup.find('.Gopassclass'));

      }
      
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
    var url = $('.allocatedItemListUrl').val();
    // $.ajax({
    //     method: "post",
    //     url: url,
    //     data: { _token: CSRF_TOKEN,occupation_id:occupation_id},
    //     success: function (response) {
    //         $(".allocatedItemList").empty();
    //         //console.log(response);
    //         if(response != ''){
    //             $(".allocateItemsDiv").removeClass("d-none");
    //             $(".allocatedItemList").append(response);
    //         } else {
    //             $(".allocateItemsDiv").addClass("d-none");
    //         }
    //         hideLoader();
    //         $('#EditUserDetailsPopup').modal('show');

    //     }, error: function (error) {
    //         console.log(error);
    //         hideLoader();

    //     }
    // });
    hideLoader();

$('#EditUserDetailsPopup').modal('show');



      

}
function showQuantityValue(element){
   var parent = findParent(element);
   var dataQuantity =  $(element).find(':selected').attr('data-quantity');
   var InventoryitemId =   $(element).find(':selected').attr('value');
   var price =  $(element).find(':selected').attr('price');
   $(parent).find('.getQuantity').attr("max", dataQuantity);
   $(parent).find('.PurchasePriceInput').val(price);
   $(parent).find('.PurchasePriceHiddenInput').val(price);
//   $(parent).find('.totalStock').html(dataQuantity + " In Stock");
   if(dataQuantity == undefined){
   $(parent).find('.totalStock').html("");
   }
   //$(parent).find('.getQuantity').val(dataQuantity);
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
    var url = $('.getStockUrl').val();
    $.ajax({
        method: "post",
        url: url,
        data: { _token: CSRF_TOKEN,InventoryitemId:InventoryitemId},
        success: function (response) {
          $(parent).find('.totalStock').html(response );
        }, error: function (error) {
            console.log(error);
            hideLoader();

        }
    });
 

}

function addInventorytouser(element){
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
//     let url = $('.addInventoryUrl').val();


    let url = $(element).attr('action');
     let inventorylistData = [];
     let formData = new FormData(element);

      $('.inventorylineitem').each(function () {
      var selectedInventory =  $(this).find('.inventoryCategories').find(':selected').val();
      var quantityValue =  $(this).find('.getQuantity').val();
      var addinquiry_id=$('.addinquiry_id').val();
      var purchasePrice =$(this).find('.PurchasePriceHiddenInput').val();
      var sellPrice =$(this).find('.SellPriceInput').val();
      var occupationId = $('.invoice_occupation_id').val();
      var dbQuantityValue = $(this).find('.inventoryCategories').find(':selected').attr('data-quantity'); 
      var finalQuantityValue = dbQuantityValue - quantityValue;
        let inventoryOb = new Object();

            inventoryOb.selectedInventory = selectedInventory;
            inventoryOb.quantityValue = quantityValue;
            inventoryOb.addinquiry_id = addinquiry_id;
            inventoryOb.finalQuantityValue = finalQuantityValue;
            inventoryOb.occupationId = occupationId;
            inventoryOb.sellPrice = sellPrice;
            inventoryOb.purchasePrice = purchasePrice;


            inventorylistData.push(inventoryOb);

      formData.append('inventorylistData', JSON.stringify(inventorylistData));
    })
       showLoader();
        $.ajax({
              method: "post",
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        dataType: 'JSON',
        processData: false,
           // data: { _token: CSRF_TOKEN,selectedInventory:selectedInventory,quantityValue:quantityValue,addinquiry_id:addinquiry_id},
            success: function(response) {
                console.log(response);
                hideLoader();
                $('#EditUserDetailsPopup').modal('toggle');

            },error: function(error) {
                console.log(error);
                            hideLoader();
                            $('#EditUserDetailsPopup').modal('toggle');

         }
        });
}
