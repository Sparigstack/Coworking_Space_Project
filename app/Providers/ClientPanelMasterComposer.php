<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Providers;

// app/Http/Composers/MasterComposer.php
use Illuminate\Contracts\View\View;
use App\User;
use App\Space;
use Session;
use Illuminate\Support\Facades\Auth;

//use App\City;
/**
 * Description of ClientPanelMaster
 *
 * @author ronakshah
 */
class ClientPanelMasterComposer {

    //put your code here
    public function compose(View $view) {
        $spaceid = Session::get('spaceid');
        
        $user = Auth::user();
        $space = Space::find($spaceid);
//        $userid = $user->id;
//        $user = User::find($user->id);
        $view->with('space', $space)->with('user', $user);
    }

}
