<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Space;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $clients = Client::all();
        $spaces = Space::all();
        return view('clients.index', compact('clients', 'spaces'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $client = new Client;
        $client->firstName = $request->firstName;
        $client->lastName = $request->lastName;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->username = $request->username;
        $client->password = $request->password;
        $client->save();
        return redirect('/clients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request) {
     
        
        $user = Auth::user();
        $isClaim = Session::get('isClaim');
        $password = Hash::make($request->password);
        if (is_null($user->password) || isset($isClaim)) {
            $saveClientPassword = User::find($user->id)->update(['password' => $password, 'username' => $user->email]);
            if(!isset($isClaim)){
                return redirect('client/space/' . $user->spaces[0]->id);
            }
            else{
                $user->is_authorized_email = 2;
                $user->save();
                if(count($user->spaces) == 1){
                    return redirect('client/space/' . $user->spaces[0]->id);
                }
                else{
                    return redirect('client/mySpaces/' . $user->id);
                }
            }

        } else {
            $error="You can not change password now.";
            $spaceid = Session::get('spaceid');
        $user = Auth::user();
        $space = Space::find($spaceid);
        return view('Client.myAccount', compact('error','user', 'space'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function myAccountPage() {
        $spaceid = Session::get('spaceid');
        $user = Auth::user();
        $space = Space::find($spaceid);
        $error='';
        return view('Client.myAccount', compact('error','user', 'space'));
    }

}
