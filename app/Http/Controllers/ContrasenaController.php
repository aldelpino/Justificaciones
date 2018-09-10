<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

use Log;
use DB;
class ContrasenaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     Log::Debug($request->session()->all());
    //     Log::Debug(auth()->user());

    //     return view('alumno/index');
    // }
    public function admin_credential_rules(array $data)
    {
        $messages = [
            'actual.required' => 'Por favor, ingresa tu contraseña actual',
            'nueva.required' => 'Debes ingresar una contraseña',
        ];

        $validator = Validator::make($data, [
            'actual' => 'required',
            'nueva' => 'required|same:nueva',
            'renueva' => 'required|same:nueva',
        ], $messages);

        return $validator;
    }

    public function index()
    {
        return view('contrasena.cambiar');
    }
    public function cambiar(Request $request)
    {
        Log::Debug("##############################################################PASSWD");
        // if(Auth::Check())
        // {
            $request_data = $request->All();
            $validator = $this->admin_credential_rules($request_data);
            if($validator->fails())
            {
            return response()->json(array('error' => $validator->getMessageBag()->toArray()), 400);
            }
            else
            {
            $current_password = Auth::User()->password;
            Log::Debug($current_password);
            if(Hash::check($request_data['actual'], $current_password))
            {
                $user_id = Auth::User()->id;
                $obj_user = User::find($user_id);
                $obj_user->password = Hash::make($request_data['nueva']);;
                $obj_user->activacion = 1;
                $obj_user->save();
                return redirect()->intended('alumno/index')->with('success', 'CONTRASEÑA MODIFICADA CORRECTAMENTE !!!                      Presiona x para cerrar');;
            }
            else
            {
                $error = array('current-password' => 'Please enter correct current password');
                return response()->json(array('error' => $error), 400);
            }
            }
        // }
        // else
        // {
        //     return redirect()->to('/');
        // }
    }
}
