$(document).ready(function () { 

   // $('#modal-custom-alert').modal();
    $('.multiselect.dropdown-toggle').addClass('shadow-none');
    $('.multiselect.dropdown-toggle').removeClass('text-center');
    $('.multiselect.dropdown-toggle').addClass('text-left');

    $('input[type=radio][name=audiance]').change(function() {      
        if (this.value == '4') {
           $('.multiselectParentDiv').removeClass('d-none');
        }
       else{
        $('.multiselectParentDiv').addClass('d-none');
       }
    });   

    $('#customConfirmOk').on('click', function(){
      var content = $('#summernote').summernote('code');
      $('.emailHtmlContent').val(content);
     
       let emailForm = $('#sendEmailForm');
     sendEmail(emailForm);
    });

    $('#sendEmailForm').on('submit' , function (e){
      e.preventDefault();
e.stopImmediatePropagation();
openConfirmation();
    })

  
    
});

function sendEmail(element) {
   let pastInvoiceUrl = $('.pastInvoiceUrl').val();
   showLoader();
   $.ajax({
       url:  $(element).prop('action'),
       type: "post",
       dataType: 'json',
       data: new FormData(element[0]),
       processData: false,
       contentType: false,
       success: function (response,textStatus,xhr) {
         //  console.log(response)
      
           if(xhr.status === 201){
          window.location.href = pastInvoiceUrl;
           }
           
       },
       error:function(error){
           console.log(error);
           alert('Somthing Went Wrong Please Try Again.');
           hideLoader();
       }
   });

}

function openConfirmation(){
   
   let leadtype = $('input[name="audiance"]:checked').val();
   let gocoworq_lead_count = $('.gocoworq_lead_count').val();
   let manual_lead_count = $('.manual_lead_count').val();
   let count = 0 ;
   if(leadtype == '1'){
       count = gocoworq_lead_count;
   }
   else if (leadtype == '2'){
      count = manual_lead_count
   }
   else if (leadtype == '3'){
      count = parseInt(gocoworq_lead_count) + parseInt(manual_lead_count);
   }
   else{
      count = $('#custom-email-multiselect').val()
      count = count.length;
   }

   $('.customConfirmTitle').text('This will send email to ' + count + ' recipients Are you sure you want to send?')
   $('#modal-custom-alert').modal();
   
  
}

function setMailContent() {

   return true;  
}

function copyText(element) {
    let copyText  = $('.mail_merge_input').select();
    // copyText[0].setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.val());
}

function openDatePicker(element){
   if($(element).is(':checked')){
$('.scheduleDateDiv').removeClass('d-none');
   }
   else{
      $('.scheduleDateDiv').addClass('d-none');
   }
}

