$(document).ready(function () {
$('#updateSpaceDiscountForm').on('submit' , function (e){
    e.preventDefault();
  updateSpaceDiscount(this);
  

});

})

function updateSpaceDiscount(element) {
    var formData =  new FormData(element);
    let discount = formData.get('discount')
    console.log(formData);
    showLoader();
    $.ajax({
        url:  $(element).prop('action'),
        type: "post",
        dataType: 'json',
        data: formData,
        processData: false,
       contentType: false,
        success: function (response,textStatus,xhr) {
            console.log(response);    
            console.log(textStatus); 
            hideLoader();
            if(xhr.status === 201){
                $('#spaceDiscountModal').modal('hide');
                $('#discount').val(discount);
openInterstedInV2();
            }
            else{
                alert('Somthing Went Wrong Please Try Again.');
            }
           
        },
        error:function(error){
            console.log(error);
            hideLoader();
        }
    });

}
 
  function GoPassCheck() {
 
 var gopassCheck =$('.checkboxclass').is(':checked');
  if (gopassCheck == true)
  {
      $('.Gopassclass').show();
      $('.checkboxbtns').show();
      $('.Gopassclass').prop('required', true);
//      $('.Go_pass_num_alert').removeClass('d-none');
      $('.checkboxclass').val('1');
      $('.show_discount').removeClass('d-none');
  }
  else{
      $('.Gopassclass').hide();
      $('.checkboxbtns').hide();
      $('.Gopassclass').prop('required', false);
//      $('.Go_pass_num_alert').addClass('d-none');
      $('.checkboxclass').val('0');
      $('.show_discount').addClass('d-none');
  }
  }


//function SaveBtnform(){
//    
//   var gopassCheck=$('.checkboxclass').is(':checked');
//    if(gopassCheck==true){
//    //   $(".Gopassclass").prop("required", true);  
//   }
//    showLoader();
//}



