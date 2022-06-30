<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
     * { font-family: DejaVu Sans, sans-serif; }
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  text-align: left;
  padding: 8px;
}
th{
 border-bottom: 1px solid #dddddd;
}

tr td:not(:first-child){
  text-align: right !important;
}

</style>
</head>
<body>

    <table>
    <tr>
             
          <td style="float:left; letter-spacing: 1px;"> To,<br>
          {{$invoice->inquiry->name}} <br>
          {{$invoice->inquiry->email}}  <br>
          {{$invoice->inquiry->phone_number}}
        </td>
  <td style="float:right">
 


@if(isset($invoice->logo_file) && !empty($invoice->logo_file))
<img align="right" alt="" src="invoices/{{$invoice->space_id . '/' . $invoice->logo_file}}" width="196" style="max-width:100px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" alt="" srcset="">
@endif
<!-- <img align="right" alt="" src="https://www.gocoworq.com/images-new/logo_lightbg.png" width="196" style="max-width:100px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" alt="" srcset=""> -->



</td>

</tr>  
     <tr>
     <td>  <span>Invoice Number: </span>{{$invoice->invoice_number}}  <br> 
     @if(isset($recurring) && !empty(recurring) && $recurring == 1)
     <span>Issue Date: {{date('d-m-Y')}}</span>
     @else
     <span>Issue Date: {{date('d-m-Y', strtotime($invoice->created_at))}}</span>
     @endif
     
    </td>
     </tr>  
</table>


<table  style="table-layout:fixed;">
  <tr>
    <th style='width: 60%;'>Description</th>
    <th style='width: 10%; text-align: center;'>Amount</th>
    <th style='width: 10%; text-align: center;' align="center"> Qty</th>
    <th style='width: 10%; text-align: center;'>GST</th>
    <th style='width: 10%; text-align: center;'>Total</th>  
  </tr>
  @foreach($invoice->invoiceitems as $item)
					   <tr>
                            <td >{{$item->item_text}}</td>
                            <td align="right" style='text-align: right;' >&#8377;{{$item->item_price}}</td>
                            <td align="right" style='text-align: right;' >1</td>
							<td align="right" style='text-align: right;'>{{ (int) $item->gst_percentage}}% </td>
                            <td align="right" style='text-align: right; '>&#8377;{{$item->item_price + ($item->item_price * (int) $item->gst_percentage / 100)}}</td>
            </tr>
					   @endforeach

                       <tr>

    <td style="">
    Total Amount
</td>
<td align="right" style='text-align: right;'></td>
<td align="right" style='text-align: right;'></td>
<td align="right" style='text-align: right;'></td>
  <td align="right" style='text-align: right;'>
  &#8377;{{$invoice->total}}
</td>
  
  </tr>
</table>

<table tyle='margin-top: 50px;'> 
<tr>
        <td >Message: <br>
        {{$invoice->message}}
</td>
</tr>
</table>


<table style="width:100%; padding:0px; m:0px; " >
<tbody>
  <tr>
    <td style='vertical-align: bottom; padding:0px;'>
    <img src="images-new/footer_invoice.jpg" style='position: fixed;
        bottom: 0;
        width: 100%; '/>
    </td>
  </tr>
</tbody>
</table>



</body>
</html>