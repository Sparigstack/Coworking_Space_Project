
<div class="card-body col12css pt-0">
    @if(Request::path() == 'client/allocateSeats' && $planid >= 6)
     <!--allocated itmes list-->
    <div class="row col-12 allocateItemsDiv d-none">
        <div class="parent">   
            <div class="mt-3">
                <label>Allocated Items List</label>
            </div>
            <div class="row pl-3 allocatedItemList"></div>
        </div>
    </div>
    <!--allocated itmes list end-->
    
    <form class="" id='sendInventoryForm' action="{{ url('addInventory') }}"  >
        <input type="hidden" name="occupation_id" class="invoice_occupation_id" value="">
        <input type="hidden" name="username" class="username" value="">
        <input type="hidden" name="addinquiry_id" class='addinquiry_id' value=''>
        <input type="hidden" class="addInventoryUrl" value="{{url('addInventory')}}">
        <input type="hidden" class="allocatedItemListUrl" value="{{url('allocatedItemList')}}">
         <input type="hidden" class="getStockUrl" value="{{url('getInventoryStock')}}">

        @csrf
        <input type="hidden" name="space_id" value="{{$spaceid}}">
        <div class="parent_Inventory_items mt-3">
            <div class="row ">
                <div class=" col-12 parent">   
                    <div class=" mt-3">
                        <label >Add ITEMS <i class="fa fa-plus-circle ml-1 addinventoryitemrow clickable" aria-hidden="true" style="font-size: 15px;"></i></label>

                        <div class="row inventorylineitem defaultinventorylineitem d-flex align-items-center mb-3 parent">
                            <div class="col-md-4 col-12 ">
                                <label>Select Category</label>
                                <select required="" name="categories" id="categories"  class="inventoryCategories categories-box form-control listNameInput"  onchange="showQuantityValue(this)">
                                    <option value=""> Select Item</option>
                                    @foreach($spaceInventoryItems as $spaceInventoryItem)
                                    <option  data-quantity="{{$spaceInventoryItem->quantity}}" price="{{$spaceInventoryItem->price_per_quantity}}" value="{{$spaceInventoryItem->id}}">{{ $spaceInventoryItem->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                                       
<!--                             <div class="col-md-2 col-12">
                                 <label>Purchase Price</label>
                                  
                                 <input  type="text"  disabled class="form-control PurchasePriceInput"  value="" name="purchasePriceInput"> 
                                  <input  type="hidden"   class="form-control PurchasePriceHiddenInput"  value="" name="PurchasePriceHiddenInput"> 
                            </div>-->
<div class="col-md-2 col-12"><label> Purchase Price</label>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="iconColor fas fa-rupee-sign" aria-hidden="true"></i></span>
        </div> 
        <input value="" type="text" disabled="" class="form-control PurchasePriceInput"  name="purchasePriceInput" id="purchasePriceInput"  min="0" pattern="[0-9]" step="1" >
        <input  type="hidden"   class="form-control PurchasePriceHiddenInput"  value="" name="PurchasePriceHiddenInput"> 
    </div>


</div>
<!--                             <div class="col-md-2 col-12">
                                 <label>Sell Price</label>
                                 <input  type="text"   class="form-control  SellPriceInput"  value="" name="sellPriceInput"  >
                                
                            </div>-->
<div class="col-md-2 col-12"><label>Sell Price</label>

    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="iconColor fas fa-rupee-sign" aria-hidden="true"></i></span>
        </div> 
        <input value="" type="number"  class="form-control SellPriceInput" name="sellPriceInput" id="sellPriceInput" placeholder="Ex: 100" min="0" pattern="[0-9]" step="1" >
        
    </div>


</div>
                                        
                            <div class="col-md-2 col-12">
                                <label>Quantity</label>
                                <input min="1" max="" type="number"   class="form-control getQuantity quantityNameInput " required value="" name="quantityInput"  placeholder="Ex: 1">
                             </div>
                            <div class="col-md-2 col-12 " style="">
                                <label >In Stock</label>
                                <p class="totalStock  mb-0"></p>

                             </div>
                            <div class="col-md-1 cancelInventoryListItem d-none ">
                                <i aria-hidden="true" class="fa fa-times-circle c-pointer mt-4 pt-3" title=""></i>
                            </div>
                             </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" d-flex justify-content-center align-items-center mt-3">
            <button type="submit" class="btn btn-warning waves-effect waves-light m-1 col-3 SendInventorybtn" >Allocate Item(s)</button>
        </div>
    </form> 
     @else
     <p class="pt-3 ml-5">This feature is available in Premium Plan. Please <a href="{{route('upgradeSpacePlan')}}" target="_blank">  click here </a> to upgrade your plan to use this feature.</p>
     @endif
</div>

