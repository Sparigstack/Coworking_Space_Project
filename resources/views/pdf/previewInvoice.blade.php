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
          {{$spaceOccupation->inquiries->name}} <br>
          {{$spaceOccupation->inquiries->email}}  <br>
          {{$spaceOccupation->inquiries->phone_number}}
        </td>
  <td style="float:right">
  @if(Session::has('logo'))
  <img align="right" alt="" src="logo/{{session()->get('space_id') . '/' . session()->get('logo')}}" width="196" style="max-width:100px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" alt="" srcset="">
  @endif

 
</td>

</tr>  
     <tr>
     <td> <span>Invoice Number: </span>{{session()->get('invoice_number')}}  <br> 
     <span>Issue Date: {{date('d-m-Y')}}</span>
    </td>
     </tr>  
</table>


<table  style="table-layout:fixed;">
  <tr>
    <th style='width: 60%;'>Description</th>
    <th style='width: 10%; text-align: right;'>Amount</th>
    <th style='width: 10%; text-align: right;' align="center"> Qty</th>
    <th style='width: 10%; text-align: right;'>GST</th>
    <th style='width: 10%; text-align: right;'>Total</th>    
  </tr>
 
  @if(session()->has('listItems'))
  @foreach(session()->get('listItems') as $item)
  @if(isset($item->name) && !empty($item->name))
					   <tr>
                            <td >{{$item->name}}</td>
                            <td align="right" style='text-align: right;' >&#8377;{{ (int) $item->price}}</td>
                            <td align="right" style='text-align: right;' >1</td>
							<td align="right" style='text-align: right;'>{{ (int) $item->gst}}% </td>
                            <td align="right" style='text-align: right;'>&#8377;{{$item->price + ($item->price * (int) $item->gst / 100)}}</td>
                       </tr>
                       @endif
					   @endforeach
@endif
                       <tr>

    <td style="">
    Total Amount
</td>
<td align="right" style='text-align: right;'></td>
<td align="right" style='text-align: right;'></td>
<td align="right" style='text-align: right;'></td>
  <td  align="right" style='text-align: right;'>
  &#8377;{{session()->get('total')}}
</td>
  
  </tr>
</table>

<table style='margin-top: 50px;'>
<tr>
        <td >Message: <br>
        {{session()->get('extraMessage')}}
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