@extends('layouts.coordinador')

@section('utilitiesHead')
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection



@section('content')



  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">



    <div class="page-title">
        <div class="title_left">
          <h3>Lista de Solicitudes</small></h3>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
             <div class="x_content">
               <div class="" role="tabpanel" data-example-id="togglable-tabs">
                 <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                   <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Pendientes</a>
                   </li>
                   <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Aprobadas</a>
                   </li>
                   <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Rechazadas</a>
                   </li>
                 </ul>
                 <div id="myTabContent" class="tab-content">
                   <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                     <table id="datatable1" class="table table-striped table-bordered">
                       <thead>
                         <tr>
                           <th>Nro. Folio</th>
                           <th>Nombre Alumno</th>
                           <th>Rut</th>
                           <th>Fecha Solicitud</th>
                           <th>Fecha Justificacion</th>
                           <th>Estado</th>
                           <th>#</th>
                         </tr>
                       </thead>
                       <tbody>

                       </tbody>
                     </table>
                   </div>
                   <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                     <table id="datatable2" class="table table-striped table-bordered">
                       <thead>
                         <tr>
                           <th>Nro. Folio</th>
                           <th>Nombre Alumno</th>
                           <th>Rut</th>
                           <th>Fecha Solicitud</th>
                           <th>Fecha Justificacion</th>
                           <th>Estado</th>
                           <th>#</th>
                         </tr>
                       </thead>
                       <tbody>

                       </tbody>
                     </table>
                   </div>
                   <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                     <table id="datatable3" class="table table-striped table-bordered">
                       <thead>
                         <tr>
                           <th>Nro. Folio</th>
                           <th>Nombre Alumno</th>
                           <th>Rut</th>
                           <th>Fecha Solicitud</th>
                           <th>Fecha Justificacion</th>
                           <th>Estado</th>
                           <th>#</th>
                         </tr>
                       </thead>
                       <tbody>
                         
                       </tbody>
                     </table>
                   </div>
                 </div>
               </div>
            </div>
         </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /page content -->

@endsection

@section('utilities')
  <!-- Datatables -->
  <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
  <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
  <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
  <script src="../vendors/jszip/dist/jszip.min.js"></script>
  <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
  <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

  <script type="text/javascript">
  $(document).ready( function () {
$('#datatable1').DataTable();
} );
  </script>

  <script type="text/javascript">
  $(document).ready( function () {
$('#datatable2').DataTable();
} );
  </script>

  <script type="text/javascript">
  $(document).ready( function () {
$('#datatable3').DataTable();
} );
  </script>
@endsection
