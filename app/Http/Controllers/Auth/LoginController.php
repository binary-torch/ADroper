<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/';
    
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        session(['url.intended' => url()->previous()]);
        $this->redirectTo = session()->get('url.intended');
    
        $this->middleware('guest')->except('logout');
    }
    
    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login.index');
    }
    
    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'string|email',
            'password' => 'required|string',
        ]);
    }
    
    /**
     * Validate the rfid to be used in login process.
     *
     * @param Request $request
     * @return null
     */
    public function validateMatricUUID(Request $request){
        if(config('app.server') != 'local'){ return response()->json(['data' => null], 401); }
        
        $this->validate($request, [
            'matric_uuid' => 'required|exists:users,matric_uuid',
        ]);
        
        $email = User::where('matric_uuid', $request->matric_uuid)->first()->email;
        
        return response()->json(['data' => $email], 200);
    }
}
