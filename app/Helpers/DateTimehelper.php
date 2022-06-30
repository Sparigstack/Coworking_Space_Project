<?php
namespace App\Helpers;
use Session;
use Carbon\Carbon;
use App\SpaceOccupation;
use App\SpaceMeetingRoom;
use App\SpaceSeatingType;
use App\MeetingOccupation;


class DateTimehelper{

 public static function getEndDate($start_date, $duration , $dateOrMonth ){
    $end_date = Carbon::parse($start_date);
    if ($duration == 'days' || $duration == 1) {
    // days 
    $end_date  = $end_date->addDays($dateOrMonth);
    }
    else if ($duration == 'months' || $duration == 2){
   // month 
   $end_date  = $end_date->addMonths($dateOrMonth);
    }
    else{
    $end_date = '';
    }
    return $end_date;
    
 }




 public static function isPastOrCurrentDate($start_date , $end_date){
  $start_date = Carbon::parse($start_date);
  $end_date = Carbon::parse($end_date);

  if($start_date->isFuture()){
return false;
  }
 else if($start_date->isToday()){
    return true;
  }
  else if ($end_date->isPast()){
    return false;
  }
else if ($end_date->isFuture() && ($start_date->isToday() || $start_date->isPast()) ){
  return true;
}


 }

 public  static function checkAvailableSeat( $currentId , $startdate , $end_date , $seatingOrMeeting , $editId , $parentId , $startTime , $endTime , $numOfPerson )
 {
   // $startdate = Carbon::parse($startdate);

   
    if($seatingOrMeeting == 'seating'){
     
    $space_seat_type = SpaceSeatingType::where('id' , $parentId)->first();
    $totalSeatCount = $space_seat_type->num_of_person;
    // if seat type is private then seat count is 1 .
    if($space_seat_type->seating_type_id == '4'){
      $totalSeatCount = 1;
    }
   
   
    $count =  SpaceOccupation::where('space_seating_type_id' , $parentId)->where(function ($q) use($startdate,$end_date) {
      $q->where(function($query) use($startdate,$end_date){
         $query->where('start_date', '<', $end_date)
               ->where('end_date', '>', $startdate);
     });
})->count(); 
   
return (int)$totalSeatCount - (int) $count ;


    }
    else if ($seatingOrMeeting == 'meeting'){


      $count = MeetingOccupation::where('space_meeting_room_id' , $parentId)->where('date' , $startdate)->where(function ($q) use ($startTime , $endTime) {
        $q->where([
          ['start_time', '<', $startTime],
          ['end_time', '>', $startTime],
      ])->orWhere([
          ['start_time', '>', $startTime],
          ['start_time', '<', $endTime],
      ]);
      });

      if(isset($currentId) && !empty($currentId) ){
        $count =$count->whereNotIn('id' , [$currentId])->count();
      }
      else{
        $count =$count->count();
      }

      return (int) $count;

    }
    else if ($seatingOrMeeting == 'onlinebookingseat') {
        $totalSeatCount = 0;
        $count = 0;
        $space_seat_type = SpaceSeatingType::where('seating_type_id', $parentId)->where('space_id', $currentId)->where('check_online_booking', 1)->orderBy('price_daily', 'asc')->first();

        if(isset($space_seat_type)){
            $totalSeatCount = $space_seat_type->num_of_person;

        $count = SpaceOccupation::where('seating_type_id', $parentId)->where(function ($q) use($startdate, $end_date) {
                    $q->where(function($query) use($startdate, $end_date) {
                        $query->where('start_date', '<', $end_date)
                        ->where('end_date', '>', $startdate);
                    });
        })->count();
        }
        
        
        return (int) $totalSeatCount - (int) $count - (int) $numOfPerson;
    }
    }
}

	   
	 
