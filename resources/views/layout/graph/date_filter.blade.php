 <div class="row col-12 mt-4">   
        <?php
            if (isset($_GET['startdate']) && isset($_GET['enddate'])) {
                $startDate = $_GET['startdate'];
                $endDate = $_GET['enddate'];
            } else {
                $startDate = date('Y-m-01');
                $endDate = date('Y-m-30');
            }
            ?>
        <div class='input-group date align-items-center datetimepickerforseating col-5' id=''>
                <input type='date' class="form-control startdate" id="datetime" name="startdate"  value="{{$startDate}}"  placeholder="DD/MM/YY" required="" autocomplete="off" style="cursor:pointer;border-radius: 0.25rem !important;" />
                <span class="input-group-addon " style="position: absolute;margin-left: 100%;padding-left: 10px;">
                </span>
            </div>
           
            <div class='input-group date align-items-center datetimepickerforseating col-5' id=''>
                <input type='date' class="form-control enddate" id="datetime" name="enddate"  value="{{$endDate}}"  placeholder="DD/MM/YY" required="" autocomplete="off" style="cursor:pointer;border-radius: 0.25rem !important;" />
                <span class="input-group-addon " style="position: absolute;margin-left: 100%;padding-left: 10px;">
                </span>
            </div>
      <input type="button" class="dateFilterbtn learn-more-btn btn btn-md primary-btn wow fadeInLeft"  onclick="filterGraph(this, 'fromFilter')" value="Filter">
 </div>
  