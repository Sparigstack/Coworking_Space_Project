<?php

namespace App\Services;

use Carbon\Carbon;
use App\MeetingOccupation;

class MeetingService
{

    public function checkAvailability()
    {
    }

    public function occupyMeetingRoom()
    {
        # code...
    }

    public function OccupyOrNot($duration_type, $start_date , $end_date , $start_time , $end_time)
    {
        // start date , end_date , start_time , end_time , duration _type 
        $start_date = Carbon::parse($start_date);
        $end_date = Carbon::parse($end_date);
        $start_time = date("G:i", strtotime($start_time));
        $end_time =  date("G:i", strtotime($end_time));

        $occupied = 0;
        if($duration_type == "hourly"){
           if($start_date->isToday()){
  $now = date("H:i");
  if($start_time <= $now && $end_time > $now){
    $occupied = 1;
  }
           }
         
        }
        // daily duration type 
        else{
            if($start_date->isToday()){
                $occupied = 1;
            }

        }

        return $occupied;
        
    }
    public function allocateMeetingRoom($data)
    {
        $data->is_occupied_now = $this->OccupyOrNot($data->duration_type,$data->start_date,$data->end_date,$data->start_time,$data->end_time);
        return MeetingOccupation::create([
            'space_meeting_room_id' => $data->space_meeting_room_id,
            'start_time' => $data->start_time ?? null,
            'end_time' => $data->end_time ?? null,
            'seat_charges' => $data->pricing->totalWithGst,
            'inquire_id' => $data->inquire_id,
            'duration_type' => $data->duration_type,
            'date' => $data->start_date,
            'end_date' => $data->end_date,
            'is_occupied_now' => $data->is_occupied_now ?? 0,
            'booking_id' => $data->booking_id ?? null,
        ]);
    }

    public function checkHourlyMeetingRoom($meeting_room_id, $start_date, $start_time, $end_time,$ediOccupationtId)
    {
        // check if that meeting room booked on that day hourly based 
        $hourlyCount =  MeetingOccupation::where('space_meeting_room_id', $meeting_room_id)->where('duration_type' , 'hourly')->where('date', $start_date)->where(function ($q) use ($start_time, $end_time) {
           

            $q->where([
                ['start_time', '<=', $start_time],
                ['end_time', '>=', $start_time],
            ])->orWhere([
                ['start_time', '>=', $start_time],
                ['start_time', '<=', $end_time],
            ]);


        })->where(function ($q) use($ediOccupationtId){
            if(isset($ediOccupationtId) && !empty($ediOccupationtId)){
            $q->whereNotIn('id' , [$ediOccupationtId]);
            }
                    })->count();

        // check if that meeting room booked in that day on daily basis between start date and end date 
        $dailyCount =   MeetingOccupation::where('space_meeting_room_id', $meeting_room_id)->where('duration_type' , 'daily')->where('date', '>=', $start_date)->where('end_date', '<=', $start_date)->where(function ($q) use($ediOccupationtId){
if(isset($ediOccupationtId) && !empty($ediOccupationtId)){
$q->whereNotIn('id' , [$ediOccupationtId]);
}
        })->count();

      
        if ($hourlyCount >= 1 || $dailyCount >= 1) {
            return false;
        } else {
            return true;
        }
    }

    public function checkdailyMeetingRoom($meeting_room_id, $start_date, $end_date,$ediOccupationtId)
    {
        $dailyBookingCount =  MeetingOccupation::where('space_meeting_room_id', $meeting_room_id)->where(function ($q) use ($start_date, $end_date) {
            $q->where('date', '<=', $end_date)
                ->where('end_date', '>=', $start_date);
        })->where(function ($q) use ($start_date){
            $q->orWhere('date', $start_date);
        })->where(function ($q) use($ediOccupationtId){
            if(isset($ediOccupationtId) && !empty($ediOccupationtId)){
            $q->whereNotIn('id' , [$ediOccupationtId]);
            }
                    })->count();

       

        if ($dailyBookingCount >= 1) {
            return false;
        } else {
            return true;
        }
    }

    public function getTotalPrice($data)
    {

        $price_per_hour = $data->price_per_hour;
        $price_per_day = $data->price_per_day;

        $totalPrice = 0;
        if ($data->duration_type == "hourly") {
            $start_time = new Carbon($data->start_time);
            $end_time = new Carbon($data->end_time);

            $diffrenceInHours =  $start_time->diff($end_time)->format('%h.%i');
       
            $diffrenceInHours = (float) $diffrenceInHours;

            if ($diffrenceInHours <= 0.30) {
                $diffrenceInHours = 0.5;
            }
        
            $totalPrice = $diffrenceInHours * $price_per_hour;
           
        } else {
            $totalPrice = $data->duration * $price_per_day;
        }

        return $totalPrice;
    }
}
