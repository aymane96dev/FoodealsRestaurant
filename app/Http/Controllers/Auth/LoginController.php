<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use App\Restaurant;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;



protected function authenticated(Request $request)
{
   
    Auth::User()->id;
   if($this->check())
   {
        
      

    return redirect('/home' );

   }
   else
   {
   
    return redirect('/verify');
   }

}

public function check()
{
    $verification = Auth::User()->verified_at;
    if($verification!=null)
        return true;
    else    
        return false;        
}


  
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
