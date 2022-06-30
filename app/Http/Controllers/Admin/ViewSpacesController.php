<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewSpacesController extends Controller
{
    //get method for View Spaces for admin
    public function viewSpaces() {
        $spaces = Space::all()->orderBy('id','desc');
        return view('Client.spaceAminities', compact('spaces'));
    }
}
