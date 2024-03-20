<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as req;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(req $request){
        $input= $request->all();
        $this->validate($request,[
            'email'=> 'required|email','password'=>'required']);
if(auth()->attempt(['email'=>$input['email'],'password'=>$input['password']]))
{
if(auth()->user()->is_admin == 1){
    // Log::info('User logged in: ', ['is_admin' => auth()->user()->is_admin]);
   return redirect()->route("admin.page");
}else{
return redirect()->route("home");
}
}else {
return redirect()->route('login')->with('eror','there is problem in the email and the password..');
}  
}}
