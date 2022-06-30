<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\City;
use App\User;
use App\Space;
use App\SpacePassportConfig;
use App\SpaceSeatingType;
use Session;
use View;
use DB;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        view()->composer('Masters.app', function($view) {
            $cities = City::with('country')->get();
            //$Space = Session::get('Space');
            $user = Auth::user();
            $view->with('cities', $cities)
                    ->with('user', $user);                    
        });
        
        view()->composer('Masters.appFront', function($view) {
            $cities = City::with('country')->get();
            $user = Auth::user();

            if (Auth::check()) {
                if(Auth::user()->user_type=='2'){
                $userId = Auth::user();
                $userid = $userId->id;
                $user =User::find($userid);
                $listSpaces = Space::where('user_id',$user->id)->get();
                $view->with('listSpaces', $listSpaces);
                $spaceId="SELECT s.id  from spaces s
            LEFT JOIN  users u ON " . $userid . "=s.user_id             
            WHERE s.user_id=" . $userid ;
            $spaceids = DB::select(DB::raw($spaceId));
            $space=$spaceids[0];
            $view->with('space', $space);
                }
                }
            //$user = User::first();
            $view->with('cities', $cities)
                    ->with('user', $user);
                   
        });

        view()->composer('Masters.ClientSpace', 'App\Providers\ClientPanelMasterComposer');
        view()->composer('Masters.ClientSpace', function($view) {
            
            $userid = Session::get('userid');
            $spaceid=Session::get('spaceid');
            $planId = Space::select("plan_id")->where("id", $spaceid)->first()->plan_id;
            $IsPassportUser = '';
            $spaceVer = '';
            $passportUser = SpacePassportConfig::where('space_id', $spaceid)->get();

            if ($passportUser && !$passportUser->isEmpty()) {
                $IsPassportUser = 1;
            } else {
                $IsPassportUser = 0;
            }
            $spaceName = Space::where('id', $spaceid)->first();
    	
    	// var_dump($inquiryDetails); return;
        
        $spaceVer = User::where('id', $spaceName->user_id)->where('is_authorized_email', '2')->first();
            
            $view->with('planId', $planId)->with('IsPassportUser', $IsPassportUser)->with('spaceVer' , $spaceVer)->with('current_space_plan' , $spaceName->plan_id);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        // $this->app->bind(SpaceSeatingType::class, function () {
        //     return new SpaceSeatingType();
        // });
    }

}
