

<div class="card-body col12css invoice-form ">
<form  class="" id='sendInvoiceForm'  action="{{ url('saveInvoice') }}"  >
    <input type="hidden" name="occupation_id" class="invoice_occupation_id" value="">
    <input type="hidden" name="occupieduserEmail" class="occupieduserEmail" value="">
    <input type="hidden" name="seatname" class="seatname" value="">
    <input type="hidden" name="username" class="username" value="">
    <input type="hidden" name="invoiceType"  value="{{$invoiceType}}">
    <input type="hidden" name="previewInvoice" class='previewInvoice' value='0'>
    <input type="hidden" name="previewInvoiceUrl" class='previewInvoiceUrl' value='{{route("previewInvoice")}}'>
    <input type="hidden" name="inquiry_id" class='inquiry_id' value=''>

    @csrf
    <input type="hidden" name="space_id" value="{{$spaceid}}">
    <div class="row seatmodalspace">
        <div class="form-group col-12 parent">
            <label for="Addedname" class="invoicetabhead"> send invoice to &nbsp;  <span class='invoiceTo'></span> </label>
        
            <div class="row mt-3">
                <div class="logoDiv col-md-4 col-6" style="">
                    <label for="companyLogo">upload logo*</label>
                     <input type="file" id="companyLogo" name="companyLogo" class='companyLogo' onchange="readURL(this);" accept="image/*">
                    <label for ="validate-img" class='mb-1 mt-2'>JPG,PNG Max.file size:1MB.</label>
                    </div>
                    <div class="companyLogopreview col-md-4 mb-3 d-none">
                <img  class="spacecompanyLogo"   onclick="" src="" style="">
            </div>
                <div class="invoicenumDiv col-md-4 col-6" style="">
                <label for="invoice_number">Invoice Number:</label>
                    <input type="text" required=""  maxlength="8" name="invoice_number" class="form-control invoice_number">
                </div>
                </div>
                <div class="row mt-2 align-items-center">
                <div class="checkrecDiv  col-md-8 col-12 " >
                <div class="icheck-material-info">
                        <input type="checkbox" id="setInvoiceDuration" name="setInvoiceDuration" class="setInvoiceDuration" value="0">
                        <label for="setInvoiceDuration">Do you want to automate this invoice every month?</label>
                    </div> 
                </div>
                <div class="recDatediv  col-md-4 col-12  d-none" style="">
                <label for="date_of_invoice">Date of invoice:</label>
                
                <div class="d-flex"><select name="dateforInvoice" class="form-control" style="width:fit-content;">
                        @for($i=1;$i<=30;$i++)
                        <option>{{$i}}</option>
                        @endfor
                    </select>
                    <p class="mt-2 ml-2">Every month
                    </div>
                 </div>
                </div>
            


           
<div class="parent_line_items mt-3">
<div class="row">
<div class="col-12">
<label >lINE ITEMS <i class="fa fa-plus-circle ml-1 additemrow c-pointer" aria-hidden="true" style="font-size: 15px;"></i></label>
</div>
</div>
   <div class="row lineItem defaultLineItem d-flex align-items-center">
   <div class="col-md-12 col-12">
    <div class="form-group">
    <input type="text" placeholder='Line Item' class="form-control listNameInput"  >
  </div>

    </div>
    <div class="col-md-3 col-6">
    <div class="form-group">
   
    <input type="number" placeholder='Price' class="form-control listPriceInput"  >
  </div>

    </div>
    <div class="col-md-2 col-6 ">
                      <div class="form-group icheck-material-info mb-3">
                      <input type="checkbox" id='gst_1' class='apply_gst_chbx'  value="0">
                        <label for="gst_1" class='gstLable'>apply gst?</label>
                      </div>
    </div>

    <div class="col-md-2 gstInputDiv col-6 d-none">
    <div class="form-group">
    <input type="number" placeholder='%' class="form-control listPricegstInput" min="0"  min="100" id="line_items_gst" >
  </div>
    </div>
    <div class="col-md-1 cancelListItem d-none">
    <i aria-hidden="true" class="fa fa-times-circle c-pointer" title=""></i>
    </div>
    <li class="dropdown-divider mb-4 mt-2 ml-3" style="width:97%"></li>
   </div>
  
</div>

<div class="row"> 
     <div class="col-md-12 d-flex align-items-center">
    <label for="toalBillingAmount">Total Amount <span class='smalltxt'>(*including Gst)</span></label>
  <input type="number" readonly="readonly" id="toalBillingAmount"  value='0' name='total' class="form-control w-25 ml-auto" >
  </div>
</div>  
        
            
            <div class="row " style="align-items: self-end;">
                <div class="form-group col-md-12 mt-2">
                    <label>additional message on invoice :</label>
                    <textarea class="form-control extraMessage" maxlength="500" name="extraMessage"></textarea>
                </div>
            </div>
            
            <div class="row invoiceErrorDiv d-none">
                <div class="col-md-12">
                    <p class='text-danger'></p>
                </div>
            </div>
            
           
        </div>
    </div>

    <div class="form-group d-flex justify-content-center align-items-center mt-3">
    <a class="text-underline d-block  mr-3" onclick='invoicePreview()' href="javascript:void(0)" >
                 PREVIEW INVOICE
            </a>
        <button type="submit" class="btn btn-warning waves-effect waves-light m-1 col-3 ">Send Invoice</button>
    </div>
</form>
</div>