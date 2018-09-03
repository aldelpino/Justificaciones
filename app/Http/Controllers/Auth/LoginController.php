<?php

// namespace App\Http\Controllers;



namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use DB;
use App\Justification;

// use Auth;
use Log;

class LoginController extends Controller
{
  // public function username()
  // {
  //     return 'correo_alum';
  // }
  public function __construct()
  {
    $this->middleware('guest', ['only' => 'showLoginForm']);
    // $this->middleware('auth:web');
  }

  public function showLoginForm()
  {
    return view('login');
  }

  public function login(Request $request)
  {

    $credentials = $request->only('email', 'password');

    // $credentials = $this->validate(request(),[

    //    'email' => 'email|required|string',
    //    'password' => 'required|string'
    // ]);
    // Auth::attempt(['email'=>$request['email'],'password'=>$request['password']]);
    $checkLogin = DB::table('users')->where($credentials)->get();
    // $checkLogin = DB::table('users')->where(['email'=>$email,'password'=>$password])->get();
    Log::debug($checkLogin);
    $password = Hash::make('holamundo');
    Log::debug($password);
// $result = Model::wherePassword($password)->first();
    // if (Auth::attempt([$credentials->email=>$request['email'],$credentials->password=>$request['password']])) {
      // if (Auth::attempt(DB::table('users')->where($credentials)->get())){
        // if($user->email == $credentials['email'] && Hash::check($credentials['password'], $user->getAuthPassword()))//$user->getAuthPassword() == md5($credentials['password'].\Config::get('constants.SALT')))

        if (Auth::attempt($credentials)) {
          // if (Auth::guard('web')->attempt($credentials)) {
          // if(count($checkLogin)  >0) {
            if (Auth::check()) {
              Log::debug('yes');

              // The user is logged in...
          }
      Log::debug($credentials);
      Log::debug('si  auth');

      // if (auth()->user()->email == "b.torol@alumnos.duoc.cl") {
      if (auth()->user()->rol == 0) {
        return redirect()->intended('alumno/index');
        // return view('alumno\index');
      }elseif (auth()->user()->rol == 2) {
        return redirect()->intended('administrador/index');
        // return view('\administrador\index');
      }elseif (auth()->user()->rol == 1) {
        return redirect()->intended('coordinador/index');
        // return view('\coordinador\index');
      }
    }else {
      Log::debug('no  auth');
      Log::debug(Auth::attempt($credentials));
      Log::debug($credentials);

      return back()
             ->withErrors(['email' => 'Estas credenciales no concuerdan con nuestros registros'])
             ->withInput(request(['email']));
    }
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/');
  }
}
