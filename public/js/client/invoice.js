$(document).ready(function () {

    $(document).on('click', '.apply_gst_chbx', function () {
        if ($(this).is(':checked')) {
            $(this).closest('.lineItem').find('.gstInputDiv').removeClass('d-none');
        } else {
            $(this).closest('.lineItem').find('.gstInputDiv').addClass('d-none');
        }
    });

    $(document).on('click', '.cancelListItem', function () {
        $(this).closest('.lineItem').remove();
        calculateTotalAmount();
    });

    $(document).on('change', '.listPriceInput, .listPricegstInput', function () {
        calculateTotalAmount();
    });


    $('#sendInvoiceForm').on('submit', function (e) {
        e.preventDefault();
        sendInvoice(this)
    });

    
    var i = 1;
    $('.additemrow').on('click', function () {
        ++i;
        let lineItem = $('.lineItem').first().clone();
        
        lineItem.find('.listNameInput').val('');
        lineItem.removeClass('defaultLineItem');
        lineItem.find('.listPriceInput').val('');
        lineItem.find('.listPricegstInput').val('');
        lineItem.find('.apply_gst_chbx').attr('id', 'gst_' + i)
        lineItem.find('.gstInputDiv').addClass('d-none');
        lineItem.find('.cancelListItem').removeClass('d-none');
        lineItem.find('.apply_gst_chbx').prop('checked', false);
        lineItem.find('.gstLable').attr('for', 'gst_' + i);
        
        $('.parent_line_items').append(lineItem);
      
    });
})



function invoicePreview(element){
    $('.invoiceErrorDiv').addClass('d-none');
    $('.invoiceErrorDiv').find('p').text('');

    $('.previewInvoice').val('1');
    $('#sendInvoiceForm').submit();
}

function sendInvoice(element) {
    $('.invoiceErrorDiv').addClass('d-none');
    $('.invoiceErrorDiv').find('p').text('');
let upgradePlanUrl = $('.upgradePlanUrl').val();

    let formData = new FormData(element);
    let url = $(element).attr('action');
    let listData = [];
    let previewInvoice = $('.previewInvoice').val();
    let previewInvoiceUrl = $('.previewInvoiceUrl').val();
    let _token = $('meta[name="csrf-token"]').attr('content');

    $('.lineItem').each(function () {
        let name = $(this).find('.listNameInput').val();
        let price = $(this).find('.listPriceInput').val();
        let gst = $(this).find('.listPricegstInput').val();
        let ob = new Object();
        if (name.length > 0 && price.length > 0 ) {
            ob.name = name;
            ob.price = price;
            ob.gst = gst;
            listData.push(ob);
        }
      
    })

    if(listData.length  == 0){
        $('.invoiceErrorDiv').removeClass('d-none');
        $('.invoiceErrorDiv').find('p').text('Please add at least one line item.');
return;
    }
    showLoader();
    formData.append('listData', JSON.stringify(listData));
    $.ajax({
        method: "post",
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        dataType: 'JSON',
        processData: false,
        success: function (response, textStatus, xhr) {
            hideLoader();

            if(response.status == "Upgrade Plan"){
                $('.invoiceErrorDiv').removeClass('d-none');
$('.invoiceErrorDiv').find('p').html('You have reached a limit to use this feature according to your current plan. Please <a target="_blank" href="' + upgradePlanUrl +'"> click here </a> to upgrade your plan and enjoy such valuable features without interruption.');
return;
            }
if(previewInvoice == "1" && response.status == 'preview'){
    $('.previewInvoice').val('0');
    window.open(previewInvoiceUrl , "_blank");
}
else{
    if(response.status == 200){
        //  clearInvoiceDetails();
        $('#EditUserDetailsPopup').modal('hide')
        $('#invoiceSentModal').modal('show');

    }
    else{
        alert('something went wrong please send again');
    }
}
           
        },
        error: function (error) {
        
            hideLoader();
        }


    })

}

function calculateTotalAmount() {
    var totalAmount = 0;
    $('.lineItem').each(function () {
        let price = $(this).find('.listPriceInput').val();
        let gst = $(this).find('.listPricegstInput').val();
        gst = gst || 0;
        price = price || 0;
        price = parseFloat(price);
        gst = parseFloat(gst);

        totalAmount += price + ((price * gst) / 100);
    })

    totalAmount = totalAmount.toFixed();
    $('#toalBillingAmount').val(totalAmount);
}

function clearInvoiceDetails(){
    let form = $('#sendInvoiceForm');
     form.find('.companyLogo').val('');
     form.find('.setInvoiceDuration').prop('checked',false);
     form.find('.invoice_number').val('');
     form.find('.extraMessage').val('');
     form.find('#toalBillingAmount').val('');
     form.find('.recDatediv').addClass('d-none');
     form.find('.companyLogopreview').addClass('d-none');
    
     form.find('.lineItem').each(function (){
         if(!$(this).hasClass('defaultLineItem')){
    $(this).remove();
         }
     })
    
     form.find('.listNameInput').val('');
     form.find('.listPriceInput').val('');
     form.find('.gstInputDiv').addClass('d-none');
     form.find('.listPricegstInput').val('');
     form.find('.apply_gst_chbx').prop('checked',false);
    }