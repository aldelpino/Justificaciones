<?php

namespace App\Http\Controllers;

use App\Notifications\InboxMessage;
use App\Admin;


use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use App\Justificacion;
use App\Justification;
use App\Files;
use Carbon\Carbon;

use Illuminate\Support\Facades\Input;
use App\Mail\EnviarCorreitoAlumnito;
use App\Mail\EnviarCorreitoCoordinadorcito;
use App\Mail\EnviarCorreitoAdministradorcito;
use App\Mail\EnviarCorreitoProfesorcito;
use Illuminate\Support\Facades\Mail;

use DB;
use Log;



class JustificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('alumno.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->activacion == '0')
        {
            Log::debug("############################################33CONSOLA");
            return view('contrasena.cambiar', []);

        }
        // dd(Auth::user());
        Log::debug(Auth::user()->email);
        Log::debug("############################################33");
        Log::debug(Auth::user()->activacion);
        // $justificaciones = Justification::all();
    //     foreach ($justificaciones as $justificacion) {
    //         Log::debug($justificacion->NFOLIO);
    //   }
        $asignaturas = array('NOM_ASIG'=>'Asignatura 1');
        $asignatura = array('NOM_ASIG'=>'Asignatura 2');
        array_push($asignaturas, $asignatura);
        // echo $competition_all[0]['name'];
        Log::debug($asignaturas[0]['NOM_ASIG']);
        // Log::debug($asignaturas[1]['NOM_ASIG']);
        $userEmail = Auth::user()->email;
        // $result = DB::table('datos_semestre')->where('correo_alum', $userEmail)->first();
        $result = DB::table('datos_semestre')->where('correo_alum', $userEmail)->get();  // DATOS USUARIO COMPLETOS

        // $result = DB::select('select * from datos_semestre where CORREO_ALUM = $userEmail' );
        Log::debug(json_decode( json_encode($result), true));
        $result = json_decode( json_encode($result), true);
        // $result = array_map(function ($value) {
        //     return (array)$value;
        // }, $result);

        // Log::debug($result[0]);
        Log::debug($result[1]['NOM_ASIG']);
        // Log::debug($result[2]['NOM_ASIG']);
        // Log::debug($result[3]['NOM_ASIG']);
        // Log::debug($result[4]['NOM_ASIG']);
        // Log::debug($result[5]['NOM_ASIG']);


        $datosAlumno = DB::table('datos_semestre')->where('correo_alum', $userEmail)->first();
        // $datosAlumno->listadoCursos = $result;
        $time = Carbon::now();
        $folio = date_format($time,'Y').date_format($time,'m').str_random(8);
        return view('alumno.crearJustificacion', ['datosAlumno' => $datosAlumno, 'infoCursos' => $result, 'folio' => $folio]);

             // if (Auth::attempt(DB::table('users')->where($credentials)->get())){
        // $datoAlumno = DB::table('datos_semestre')->where('name'=>'John')->first();
        // $datosAlumno = DB::select('select * from datos_semestre where correo_alum = "b.torol@alumnos.duoc.cl"', [1]);
        // echo $datosAlumno[0]['correo_alum'];
        // echo $datosAlumno->correo_alum;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(ContactFormRequest $request, Justification $justification, Admin $admin)
    {
        // public function mailToAdmin(ContactFormRequest $message, Admin $admin)
        // {        //send the admin an notification
        //     $admin->notify(new InboxMessage($message));
        //     // redirect the user back
        //     return redirect()->back()->with('message', 'thanks for the message! We will get back to you soon!');
        // }
        // $justificacion = Justificacion::create($request->all());
        Log::debug('CREANDO REGISTRO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!');
        // $validated = $request->validated();
        // Log::debug($validated->errors());

        $resumenAsignaturas = [];

        foreach (json_decode($request->cursosArray, true) as $curso){
            $justification = new Justification();
            $justification->correo_cor = $curso['correoCoordinador'];
            $justification->correo_doc = $curso['correoDocente'];
            $justification->asignatura = $curso['asignatura'];
            $justification->comentario = $request['comentario'];
            $justification->motivo = $request['motivo'];
            $justification->nombre_alum = $request['nombre_alum'].' '.$request['apep_alum'].' '.$request['apem_alum'];
            $justification->correo_alum = $request['correo_alum'];
            $justification->celular_alum = $request['celular_alum'];
            $justification->fec_jus = $request['fechaJustificacion'];
            $justification->nfolio = $request['folio'];
            $justification->estado = 'Pendiente';
            $justification->motivo_rec = 'Pendiente';
            $justification->comentario_rec = 'Pendiente';
            $justification->tipo_inasistencia = $request['tipoInasistencia'] == "evaluacion"?1:0;
            $justification->save();
            // $admin->notify(new InboxMessage($request));
            $adjuntos = DB::table('documento')
             ->select('url')
             ->where('nfolio','=', $request['folio'])
             ->get();
             Log::Debug($adjuntos->toJson());
            array_push($resumenAsignaturas, $justification->asignatura);
        }
        // Mail::to('jcastillo@duoc.cl')->send(new EnviarCorreitoProfesorcito($request, $adjuntos));
        Mail::to('dseron@duoc.cl')->send(new EnviarCorreitoCoordinadorcito($request, $adjuntos, $resumenAsignaturas));
        Mail::to('jcastillo@duoc.cl')->send(new EnviarCorreitoCoordinadorcito($request, $adjuntos, $resumenAsignaturas));
        Mail::to('jcaguirrecl@gmail.com')->send(new EnviarCorreitoAlumnito($request, $adjuntos, $resumenAsignaturas));
        Mail::to('jcastillo@duoc.cl')->send(new EnviarCorreitoAlumnito($request, $adjuntos, $resumenAsignaturas));
        Log::Debug($resumenAsignaturas);
        Log::Debug('#########################################################resumenAsignaturas');
            // DESCOMENTAR EN PRODUCCION
            //
            // Mail::to($curso['correoDocente'])->send(new EnviarCorreitoProfesorcito($request, $adjuntos));
            // Mail::to($curso['correocorreoCoordinador'])->send(new EnviarCorreitoCoordinadorcito($request, $adjuntos));
            // Mail::to($request['correo_alum'])->send(new EnviarCorreitoAlumnito($request, $adjuntos));
            // EL profe recibe solo la resolucion del coordinador, sin datos de adjunto. Sacar desde justiController
            // 1 solo correo con resumen de asignaturas para Coordinador
            // 1 solo correo con resumen...Alumno recibe confirmacion de creacion con respaldo de los adjuntos
            // Mail::to('jcastillo@duoc.cl')->send(new EnviarCorreitoProfesorcito($request, $adjuntos));
            // Mail::to('dseron@duoc.cl')->send(new EnviarCorreitoCoordinadorcito($request, $adjuntos));
            // Mail::to('jcaguirrecl@gmail.com')->send(new EnviarCorreitoAlumnito($request, $adjuntos));
            // DESCOMENTAR EN PRODUCCION
            // Mail::to($curso['correoDocente'])->send(new EnviarCorreitoProfesorcito($request, $adjuntos));
            // Mail::to($curso['correocorreoCoordinador'])->send(new EnviarCorreitoCoordinadorcito($request, $adjuntos));
            // Mail::to($request['correo_alum'])->send(new EnviarCorreitoAlumnito($request, $adjuntos));




        // $justification->notify(new InboxMessage($request));

        // $result = $this->authorize('alumno/store', $post);

        // if(!$result){
        //     Log::debug('AAAA');
        // }
        return redirect()->intended('alumno/index')->with('success', 'JUSTIFICACION CREADA CORRECTAMENTE !!!                      Presiona x para cerrar');

        // return redirect()->route('alumno');
    }

    public function revisar()
    {
        if(Auth::user()->activacion == '0')
        {
            Log::debug("############################################33CONSOLA");
            return view('contrasena.cambiar', []);

        }
            $justificacion  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Pendiente']])->get();

            $justificacion  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email]])->get();

            $cantEmitidas   = DB::table('justifications')->where('correo_alum','like', auth()->user()->email)->count();
            $cantAprobadas  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'aprobada' ]])->count();
            $cantRechazadas = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'rechazada']])->count();
            $cantValidando  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'validando' ]])->count();
              Log::Debug($justificacion);
            return view('alumno.revisarJustificacion', [
                'justificacion'  => $justificacion,
                'cantEmitidas'   => $cantEmitidas,
                'cantAprobadas'  => $cantAprobadas,
                'cantRechazadas' => $cantRechazadas,
                'cantValidando'  => $cantValidando
              ]);

    }

    public function getAsignaturas($asignaturaId) {
        $user = auth()->user();
        Log::debug($user->email);
        // Log::debug($asignaturaId);
        $asignatura = DB::table('datos_semestre')->where([
            ['NOM_ASIG', 'like', $asignaturaId],
            ['CORREO_ALUM', 'like', $user->email],
        ])->get();
        // $asignatura = DB::table("datos_semestre")->where("NOM_ASIG",$asignaturaId)->pluck("name","id");
        // $asignatura = array(["nombreProfesor", "el Profe"], ["nombreCoordinador", "el Coordinador"]);
        // Log::debug($asignatura);
        return json_encode($asignatura);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $justifications = DB::table('justifications')->where('id_dato', $id)->first();
       $datosAlumno = DB::table('datos_semestre')->where([['correo_alum', 'like', $justifications->CORREO_ALUM],
                                                             ['nom_asig', 'like', $justifications->ASIGNATURA]])->first();
       $imagenes = DB::table('documento')
        ->select('substr(URL,12)')
        ->where('nfolio','like', '20180421371067')
        ->get();
        Log::Debug($imagenes->toJson());
        return view('coordinador/edicionJustificaciones',['justifications' => $justifications,
                                                         'datosAlumno'    => $datosAlumno,
                                                         'imagenes'       => $imagenes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


      $correo_alum = Input::get('correo_alum');
      $comentarioRechazo = Input::get('comentarioRechazo');
      $estado = Input::get('estado');

      DB::table('justifications')
            ->where([['id_dato','like',$id]])
            ->update(['estado' => $estado]);
      DB::table('justifications')
            ->where([['id_dato','like',$id]])
            ->update(['COMENTARIO_REC' => $comentarioRechazo]);
      return redirect()->action('CoordinadorController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
