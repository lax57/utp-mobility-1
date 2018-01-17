<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Permission;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/myapplications';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function redirectTo(){
        $permissions = Auth::user()->permissions();
        if(in_array(Permission::CREATE_APPLICATION, $permissions)) return route('my_applications');
        if(in_array(Permission::MANAGE_WEBSITE,$permissions)) return route('show_accounts');
        if(in_array(Permission::EVALUATE_APPLICATIONS,$permissions)) return route('evaluate_list');
    }
    
   
}
