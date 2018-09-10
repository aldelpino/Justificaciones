@extends('layouts.alumno')
{{-- @include('alert::bootstrap') --}}

@section('utilitiesHead')
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!-- Dropzone.js -->
  <link href="/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <style>
        #loader{
        visibility:hidden;
        }
    </style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')

  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Creando Justificativo</h3>
        </div>
      </div>
      <div class="clearfix"></div>

      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">


              <!-- Smart Wizard -->

              <form enctype="multipart/form-data" id="my-awesome-dropzone" class="dropzone" action="{{url('alumno/store')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" id="folio" name="folio" value="{{$folio}}">
                <input type="hidden" id="inputSuccess3" name="apem_alum" value="{{$datosAlumno->APEM_ALUM}}">
                <input type="hidden" id="cursosArray" name="cursosArray">
                <input type="hidden" id="correoDocente" name="correoDocente">
                <input type="hidden" id="correoCoordinador" name="correoCoordinador">
                <div id="wizard" class="form_wizard wizard_horizontal">
                  <ul class="wizard_steps">
                    <li>
                      <a href="#step-1">
                        <span class="step_no">1</span>
                        <span class="step_descr">
                                          Paso 1<br />
                                          <small>Mis Datos Academicos</small>
                                      </span>
                      </a>
                    </li>
                    <li>
                      <a href="#step-2">
                        <span class="step_no">2</span>
                        <span class="step_descr">
                                          Paso 2<br />
                                          <small>Datos Solicitud</small>
                                      </span>
                      </a>
                    </li>
                    <li>
                    <a href="#step-3">
                      <span class="step_no">3</span>
                      <span class="step_descr">
                                        Paso 3<br />
                                        <small>Cargar Certificado</small>
                                    </span>
                    </a>
                  </li>
                    <li>
                      <a href="#step-4">
                        <span class="step_no">4</span>
                        <span class="step_descr">
                                          Paso 4<br />
                                          <small>Comentario</small>
                                      </span>
                      </a>
                    </li>
                  </ul>
                    <div id="step-1">
                      <div class="form-horizontal form-label-left">
                        {{-- @foreach($datosAlumno as $key => $data) --}}
                        {{-- @foreach($datosAlumno as $data)
                            <tr>
                                <th>{{$data->nombre_alum}}</th>
                                <th>{{$data['correo_alum']}}</th>
                            </tr>
                        @endforeach --}}
                        {{-- {{$datosAlumno->CORREO_ALUM}} --}}
                        {{-- {{ print_r($datosAlumno, true) }} --}}
                        {{-- {{ print_r($infoCursos, true) }} --}}
                        {{-- {{$datosAlumno->'correo_alum'}} --}}
                        <h2 class="StepTitle">Mis datos Academicos</h2>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control has-feedback-left" id="inputSuccess2" readonly="readonly" name='nombre_alum' placeholder="{{$datosAlumno->NOMBRE_ALUM}}" value="{{$datosAlumno->NOMBRE_ALUM}}">
                          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control" id="inputSuccess3" readonly="readonly" name='apep_alum' placeholder="{{$datosAlumno->APEP_ALUM}}" value="{{$datosAlumno->APEP_ALUM}}">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control has-feedback-left" id="inputSuccess4" readonly="readonly" name='correo_alum' placeholder="{{$datosAlumno->CORREO_ALUM}}" value="{{$datosAlumno->CORREO_ALUM}}">
                          <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="number" class="form-control" id="inputSuccess5"  placeholder="Telefono/Celular" name="celular_alum" value="{{$datosAlumno->CELULAR}}">
                          <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <!-- <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control" id="inputSuccess6" readonly="readonly" placeholder="Cordinador">
                          <span class="fa fa-institution form-control-feedback right" aria-hidden="true"></span>
                        </div> -->

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control" id="inputSuccess7" readonly="readonly" placeholder="{{$datosAlumno->CARRERA}}">
                          <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control" id="inputSuccess8" readonly="readonly" placeholder="{{$datosAlumno->JORNADA}}">
                          <span class="fa fa-institution form-control-feedback right" aria-hidden="true"></span>
                        </div>

                      </div>
                    </div>
                    <div id="step-2">
                      <h2 class="StepTitle">Datos Solicitud</h2><br>

                      <div class="col-md-12">
                        Que fechas faltaste?
                        <div class="input-prepend input-group">
                          <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                          <input type="text" style="width: 200px" name="fechaJustificacion" id="reservation" class="form-control" value="01/01/2018 - 01/25/2018" />
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label for="nombreDocente" class="control-label">Docente:</label>
                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" readonly="readonly"  placeholder="Nombre Docente" name="nombreDocente">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <label for="nombreDocente" class="control-label">Coordinador:</label>
                        <input type="text" class="form-control" id="inputSuccess6" readonly="readonly" placeholder="Nombre Cordinador" name="nombreCoordinador">
                        <span class="fa fa-institution form-control-feedback right" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                            {{-- {!! Form::label('item', 'Item:') !!} --}}
                            {{-- {!! Form::select('asignatura', ['L' => 'Large', 'S' => 'Small'], null, ['placeholder' => 'Pick a size...', 'class' => 'form-control']) !!} --}}
                            {{-- {!! Form::select('asignatura', [$infoCursos['NOM_ASIG']], null, ['placeholder' => 'Pick a size...', 'class' => 'form-control']) !!} --}}

                        {{-- FUNCIONA OK --}}
                        <select class="form-control" id="carritoJC" name="asignatura" placeholder="Asignatura">
                            <option value=''>Seleccionar asignatura</option>
                            @foreach($infoCursos as $item)
                                <option value="{{$item['NOM_ASIG']}}">{{$item['NOM_ASIG']}}</option>
                            @endforeach
                        </select>

                        {{-- // echo Form::checkbox('name', 'value'); --}}
                        {{-- // echo '<br/>'; --}}
                        {{-- {!! Form::checkbox('is_ok[]',  false,  isset($model->checkbox) ? : 0) !!} --}}

                        {{-- <select class="form-control" name="asignatura">
                            <option>Seleciona una asignatura</option>
                            <option>Programacion de base de datos</option>
                            <option>DAI</option>
                            <option>Soporte en hardware</option>
                            <option>Desarrollo en Java</option>
                        </select> --}}
                        <span class="fa fa-folder form-control-feedback right" aria-hidden="true"></span>
                        <span id="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span>
                        <div id="panel-asignaturas">No has seleccionado Asignaturas</div>
                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-6">
                              <button class="btn btn-default" id="carrito">
                                  <i class="fa fa-plus"></i> Agregar Asignatura a la justificacion
                              </button>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <select class="form-control" name="motivo">
                               <option>Seleciona un motivo</option>
                               <option>Médico</option>
                               <option>Laboral</option>
                               <option>Otros</option>
                             </select>
                        <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                      </div>




                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          ¿A que faltaste?
                        <div class="checkbox">
                                <label>
                                  <input name="tipoInasistencia" type="checkbox" value="evaluacion"> Evaluaciones
                                </label>
                              </div>
                              <div class="checkbox">
                                <label>
                                  <input name="tipoInasistencia" type="checkbox" value="clases"> Clases
                                </label>
                              </div>
                      </div>
                    </div>
                    <div id="step-3">
                      <h2 class="StepTitle">Paso 3 Cargar Certificado</h2>
                      <div class="x_content">
                        <p>Arrastre las fotos que necesita subir o haga click en el panel</p>
                        {{-- <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data" class="dropzone dropzone-previews" id="my-awesome-dropzone">
                            @csrf
                        </form> --}}
                        <div class="dropzone dropzone-previews" id="my-awesome-dropzone"></div>
                        <br />
                        <br />
                        <br />
                        <br />
                      </div>
                    </div>
                    <div id="step-4">
                      <h2 class="StepTitle">Paso 4 Comentario</h2>
                      <label for="message">Ingrese máximo 500 caracteres:</label>
                      <textarea cols="40" rows="5" id="message" required="required" class="form-control" name="comentario"></textarea>
                    </div>
                    {{-- <div class="form-group">
                        <button type="submit" class="btn btn-primary" value="Send">Send</button>
                    </div> --}}
                </div>
              </form>
              <!-- End SmartWizard Content -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

@endsection

@section('utilities')
  <!-- jQuery Smart Wizard -->
  <script src="/vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
  <!-- Dropzone.js -->
  <script src="/vendors/dropzone/dist/min/dropzone.min.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="../vendors/moment/min/moment.min.js"></script>
  <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap-datetimepicker -->
  <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

  {{-- <script type="text/javascript">
    Dropzone.options.dropzone =
     {
        maxFilesize: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
           return time+file.name;
        },
        acceptedFiles: ".pdf",
        addRemoveLinks: true,
        timeout: 5000,
        success: function(file, response)
        {
            console.log(response);
        },
        error: function(file, response)
        {
           return false;
        }
}; --}}
{{-- <script>
    // CSRF for all ajax call
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
</script>
  <script type="text/javascript">
    Dropzone.autoDiscover = false;
    jQuery(document).ready(function() {

      $("div#my-awesome-dropzone").dropzone({
        url: "image/upload/store"
      });
    });

    Dropzone.options.myAwesomeDropzone =
    {
    acceptedFiles: ".pdf",
    autoProcessQueue: true,
    uploadMultiple: true,
    parallelUploads: 2,
    maxFiles: 2,
    maxFilesize: 3,
    };
  </script> --}}
    <script type="text/javascript">
        function display_locations(arr) {
            // var array = ['london', 'ontario', 'san francisco', 'new york'];
            var newHTML = "";
            for (var i = 0; i < arr.length; i++) {
                newHTML = newHTML + '<span>' + arr[i].asignatura + '</span>';
            }
            $("#panel-asignaturas").html(newHTML);
            $("#cursosArray").val(JSON.stringify(arr));
        }

        $(function() {
            var arr = new Array();
            $("#carrito").click( function()
                {
                arr.push({asignatura: $('#carritoJC').find(":selected").text(), correoDocente: $('input[name=correoDocente]').val(), correoCoordinador: $('input[name=correoCoordinador]').val()});
                display_locations(arr);
                console.log(arr);
                }
            );
        });
    </script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        jQuery(document).ready(function() {
        // $(document).ready(function () {
            var folio = $('#folio').val();
            console.log(folio);
            console.log("##############################################SUBIENDO ARCHIVOS");
            Dropzone.autoDiscover = false;
            $("div#my-awesome-dropzone").dropzone({
                url: "image/upload/store/",
                maxFiles: 3,
                maxFilesize: 2,
                dictResponseError: "Error al subir el archivo",
                dictInvalidFileType: "Solo archivos tipo Imagen",
                dictMaxFilesExceeded: "Disculpa, solo puedes subir un maximo de 3 archivos!",
                paramName: "file",
                dictFileTooBig: "Archivo demasiado largo, tamaño maximo 2MB.",
                acceptedFiles: "image/jpeg, image/png, image/jpg",
                params: {
                    folio: folio
                },
//                init: function() {
                //     this.on("sending", function(file, xhr, formData) {
                //     formData.append("data", "loremipsum");
//                    console.log('Enviando!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!')
                    });
                },
//                headers: {
                    'X-CSRFToken': $('meta[name="token"]').attr('content')
                },
            });
        });
    </script>

  <script src="{{ asset('js/selectProfeCord.js') }}"></script>


@endsection

{{-- Dropzone.prototype.defaultOptions.dictDefaultMessage = "Drop files here to upload";
Dropzone.prototype.defaultOptions.dictFallbackMessage = "Your browser does not support drag'n'drop file uploads.";
Dropzone.prototype.defaultOptions.dictFallbackText = "Please use the fallback form below to upload your files like in the olden days.";
Dropzone.prototype.defaultOptions.dictFileTooBig = "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.";
Dropzone.prototype.defaultOptions.dictInvalidFileType = "You can't upload files of this type.";
Dropzone.prototype.defaultOptions.dictResponseError = "Server responded with {{statusCode}} code.";
Dropzone.prototype.defaultOptions.dictCancelUpload = "Cancel upload";
Dropzone.prototype.defaultOptions.dictCancelUploadConfirmation = "Are you sure you want to cancel this upload?";
Dropzone.prototype.defaultOptions.dictRemoveFile = "Remove file";
Dropzone.prototype.defaultOptions.dictMaxFilesExceeded = "You can not upload any more files."; --}}
