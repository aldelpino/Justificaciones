<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;

class LoginController extends Controller
{

  public function __construct()
  {
    $this->middleware('guest', ['only' => 'showLoginForm']);
  }

  public function showLoginForm()
  {
    return view('login');
  }

  public function login()
  {
    $credentials = $this->validate(request(),[

       'email' => 'email|required|string',
       'password' => 'required|string'
    ]);

    if (Auth::attempt($credentials)) {
      if (auth()->user()->rol == "alumno") {
        return view('\alumno\index');
      }elseif (auth()->user()->rol == "admin") {
        return view('\administrador\index');
      }elseif (auth()->user()->rol == "coordinador") {
        return view('\coordinador\index');
      }
    }else {
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
