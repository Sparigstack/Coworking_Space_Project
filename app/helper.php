<?php

if(!function_exists('dateFormate')) {

    function dateFormate($date) {
        $date = \Carbon\Carbon::parse($date)->rawFormat('jS F Y');
        return $date;
    }
}

if(!function_exists('dateDmy')) {

    function dateDmy($date) {
        $date = \Carbon\Carbon::parse($date)->format('d/m/Y');
        return $date; ;
    }
}

?>