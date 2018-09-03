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
        // dd(Auth::user());
        Log::debug(Auth::user()->email);
        $justificaciones = Justification::all();
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
        Log::debug($request);
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
            $admin->notify(new InboxMessage($request));
        }


        // $justification->notify(new InboxMessage($request));

        // $result = $this->authorize('alumno/store', $post);

        // if(!$result){
        //     Log::debug('AAAA');
        // }
        return redirect()->intended('alumno/index')->with('success', 'JUSTIFICACION CREADA CORRECTAMENTE !!!                      Presiona x para cerrar');;

        // return redirect()->route('alumno');
    }

    public function revisar()
    {
        return view('alumno.revisarJustificacion');
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
        //
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
        //
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
