$(document).ready(function () { 
});

function checkAutoReminder(element) {
    var chkYes = $(element).attr('id');
    if (chkYes == "reminderYes") {
        $(".reminderInputdiv").removeClass("d-none");
    } else {
        $(".reminderInputdiv").addClass("d-none");
    }
}

function updateAutoReminderForItem(element) {
    var setAutoReminder = 0;
    var updateInventoryDataId = $(element).attr('data-id');
    if ($(element).prop("checked") == true) {

        $(element).closest('.inventory-section').find('#setremainderval').attr('value','1');
        $(element).closest('.inventory-section').find('.reminderInput input').removeClass('d-none');
         $(element).closest('.inventory-section').find('.reminderInput label').removeClass('d-none');
        $(element).closest('.inventory-section').find('.reminderInput .quantityReminderInputWidth').prop('required', true);
        $(element).closest('.inventory-section').find('.updateInventoryitems').removeClass('d-none'); 
        $(element).closest('.inventory-section').find('.quantityReminderInputWidth').focus();
    } else {

        $(element).closest('.inventory-section').find('#setremainderval').attr('value','0');
         $(element).attr('value','0');
        $(element).closest('.inventory-section').find('.reminderInput input').addClass('d-none');
        $(element).closest('.inventory-section').find('.reminderInput label').addClass('d-none');
        $(element).closest('.inventory-section').find('.reminderInput .quantityReminderInputWidth').prop('required', false);
    }
   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let url = $('.updateAutoReminderUrl').val();
        showLoader();
        $.ajax({
            url: url,
            type: "POST",
            data: { _token: CSRF_TOKEN,setAutoReminder:setAutoReminder ,updateInventoryDataId:updateInventoryDataId},
            success: function(response) {
                hideLoader();
}
                });
}
$('.toggleInventoryupdate').on('click', function () {
    $(this).closest('.inventory-section').find('.updateInventoryitems').slideToggle();
     $(this).closest('.inventory-section').find('.updateInventoryitems').removeClass('d-none');
});


$(".collapsible-btn").click(function (e) {
    e.preventDefault();
    var content = $(this).next(".collapsible-content");
    $(this).parent(".collapsible-section").toggleClass('active');
    $(content).toggle(250);
});

function searchSpaceInventoryItems(element) {
    let value = $(element).val();
    if (value) {
        $(element).parent().find('.fa-spinner').removeClass('d-none');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let url = $('.searchSpaceInventoryItems').val();
        let inventoryItem = $(element).val();
        $.ajax({
            url: url,
            type: "POST",
            data: {_token: CSRF_TOKEN, inventoryItem: inventoryItem},
            success: function (response) {
                $('.searchInventoryItemResult').empty();
                response.forEach(function (inventoryItem) {
                     var htmlcontent = '<div class="inventoryFilter card c-pointer mb-0 fetchinventory " onclick="filterInventoryItemSelect(this)">'+inventoryItem.name+'</div>';         
        $('.searchInventoryItemResult').append(htmlcontent);
                });
                $('.searchInventoryItemResult').removeClass('d-none');
                $(element).parent().find('.fa-spinner').addClass('d-none');
            },
            error: function (err) {
                console.log(err);
                alert('Something went wrong.');
            }
 });
    } else {
        if (value == "" || value == null || value == "undefined") {
            $('.addNewDetDiv').addClass('d-none');
        }
        return;
    }
    
}

function filterInventoryItemSelect(element){
   var selectitemValue = $(element).text();
   $('.searchItemInput').val(selectitemValue);
   $('.searchInventoryItemResult').addClass('d-none');
   searchInventoryByFilter(this,'fromFilter');
}

function searchInventoryByFilter(element, from) {
    var url = "0";
    var base_url = window.location.origin;
    var inventoryName = $('.searchItemInput').val();
    var selectedCategory =  $('.FilterForm').find('#categories').find(':selected').val();
          
    if ((from = "fromFilter")) {  url = base_url + "/client/inventory?itemName=" + inventoryName + "&category=" + selectedCategory;
        window.location.href = url;
 }
}

$('.addStock').on('click', function () {
    var inventoryId =$(this).attr('inventory-id');
    $('.Stockid').val(inventoryId);
    
    var inventoryPrice =$(this).attr('inventory-price');
     $('.Stockprice').val(inventoryPrice);
     
     var inventoryItem =$(this).attr('inventory-name');
     $('.Stockname').val(inventoryItem);
     
     $('.ItemName').text(inventoryItem);
})

  function filterGraph(element, from) {
    var url = "";
    var base_url =  window.location.protocol +
      "//" +
      window.location.host +
      window.location.pathname;

    var startDate = $(".startdate").val();
    var endDate = $(".enddate").val();
    if ((from = "fromFilter")) {
        url = base_url + "?startdate=" + startDate + "&enddate=" + endDate;
        window.location.replace(url);
    }
    
}
