@extends('layouts.alumno')


@section('utilitiesHead')
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!-- Dropzone.js -->
  <link href="/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
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

              <form enctype="multipart/form-data" id="my-awesome-dropzone" class="dropzone" action="{{url('/alumno/store')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
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

                        <h2 class="StepTitle">Mis datos Academicos</h2>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control has-feedback-left" id="inputSuccess2" readonly="readonly" placeholder="Nombre">
                          <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control" id="inputSuccess3" readonly="readonly" placeholder="Apellido">
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control has-feedback-left" id="inputSuccess4" readonly="readonly" placeholder="Email">
                          <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="number" class="form-control" id="inputSuccess5"  placeholder="Telefono/Celular">
                          <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control" id="inputSuccess6" readonly="readonly" placeholder="Cordinador">
                          <span class="fa fa-institution form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control" id="inputSuccess7" readonly="readonly" placeholder="Carrera">
                          <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                          <input type="text" class="form-control" id="inputSuccess8" readonly="readonly" placeholder="Jornada">
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
                        <input type="text" class="form-control has-feedback-left" id="inputSuccess2" readonly="readonly"  placeholder="Nombre Docente" name="nombreDocente">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <select class="form-control" name="asignatura">
                                 <option>Seleciona una asignatura</option>
                                 <option>Programacion de base de datos</option>
                                 <option>DAI</option>
                                 <option>Soporte en hardware</option>
                                 <option>Desarrollo en Java</option>
                               </select>
                        <span class="fa fa-folder form-control-feedback right" aria-hidden="true"></span>
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

  <script type="text/javascript">
    Dropzone.autoDiscover = false;
    jQuery(document).ready(function() {

      $("div#my-awesome-dropzone").dropzone({
        url: "/file/post"
      });
    });

    Dropzone.options.myAwesomeDropzone = {
    autoProcessQueue: true,
    uploadMultiple: true,
    parallelUploads: 2,
    maxFiles: 2,
    maxFilesize: 3,
  };
  </script>


@endsection
