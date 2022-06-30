<?php
namespace App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppUtility
 *
 * @author admin
 */
class Helpers {

    //put your code here

    public static function getDurationById($id) {
        if ($id == 1)
            return 'Hourly';
        else if ($id == 2)
            return 'Daily';
        else if ($id == 3)
            return 'Weekly';
        else if ($id == 4)
            return 'Monthly';
    }

}
