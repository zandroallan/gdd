<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\Auth\LoginRequest;
use Auth;
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
        //print_r('test2'); exit();
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'nickname';
    }    

    /*public function authenticated(Request $request)
    {
        print_r('test'); exit();
        $this->validate($request,['nickname'=>'required', 'password'=>'required']);
        $credentials= $request->only('email', 'password');

        if (Auth::attempt($credentials+['activo' => 1])) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        return redirect('login')
                ->withInput($request->only('nickname'))
                ->withErrors(['error'=>'Los datos proporcionados son incorrectos!']);        
    }   */

    public function login(LoginRequest $request)
    {
        $this->validate($request,['nickname'=>'required', 'password'=>'required']);
        $credentials= $request->only('nickname', 'password');

        if (Auth::attempt($credentials+['activo' => 1])) {
            // if(Auth::User()->hasRole(['Oficialia'])) {
            //     return redirect()->route('oop.borradores.index');
            // }
            // if(Auth::User()->hasRole(['Coordinacion'])) {
            //     return redirect()->route('coo.principal.index');
            // }
            if(Auth::User()->hasRole(['Titular'])) {
                return redirect()->route('ttl.recibidos.index');
            }
            if(Auth::User()->hasRole(['admin'])) {
                return redirect()->route('admin-home');
            }
            return redirect()->route('home');
        }
        return redirect('login')
                ->withInput($request->only('nickname'))
                ->withErrors(['error'=>'Los datos proporcionados son incorrectos!']);
    }
}
