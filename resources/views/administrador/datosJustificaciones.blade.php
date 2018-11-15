@extends('layouts.admin')


@section('utilitiesHead')
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
@endsection


@section('content')
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
    <div class="page-title">
        <div class="title_left">
          <h3>Lista de Justificaciones</small></h3>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
             <div class="x_content">
                 <table id="" class="display table table-striped table-bordered">
                   <thead>
                     <tr>
                       <th>Nro. Folio</th>
                       <th>Rut Alumno</th>
                       <th>Nombre Alumno</th>
                       <th>Correo Alumno</th>
                       <th>Asignatura</th>
                       <th>Fecha Solicitud</th>
                       <th>Fecha Justificacion</th>
                       <th>Motivo</th>
                       <th>Comentario Alumno</th>
                       <th>Coordinador</th>
                       <th>Estado</th>
                       <th>Comentario Rechazo</th>
                     </tr>
                   </thead>
                   <tbody>
                     @foreach ($allJustifications as $obj)
                       <tr>
                         <td>{{ $obj->NFOLIO }}</td>
                         <td>{{ $obj->RUT}}</td>
                         <td>{{ $obj->NOMBRE_ALUM }}</td>
                         <td>{{ $obj->CORREO_ALUM }}</td>
                         <td>{{ $obj->ASIGNATURA }}</td>
                         <td>{{ $obj->FEC_SOL }}</td>
                         <td>{{ $obj->FEC_JUS }}</td>
                         <td>{{ $obj->MOTIVO }}</td>
                         <td>{{ $obj->COMENTARIO }}</td>
                         <td>{{ $obj->CORREO_COR }}</td>
                         <td>{{ $obj->ESTADO }}</td>
                         <td>{{ $obj->COMENTARIO_REC }}</td>
                       </tr>
                     @endforeach
                   </tbody>
                 </table>
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

  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('table.display').DataTable({
        "scrollX": true,
        "columnDefs": [{ "width": "300px", "targets": 2 },
                       { "width": "600px", "targets": 8 },
                       { "width": "600px", "targets": 11 }

                      ],
        "order": [[ 4, "asc" ]],
        "language": {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar _MENU_ registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
            "oPaginate": {
              "sFirst":    "Primero",
              "sLast":     "Último",
              "sNext":     "Siguiente",
              "sPrevious": "Anterior"
            },
            "oAria": {
              "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
              "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            buttons: {
                copyTitle: 'Añadido al portapapeles',
                copyKeys: 'Presione <i> ctrl </ i> o <i> \ u2318 </ i> + <i> C </ i> para copiar los datos de la tabla al portapapeles. <br> <br> Para cancelar, haga clic en este mensaje o presione Esc.',
                copySuccess: {
                    _: '%d lineas copiadas',
                    1: '1 linea copiada'
                }
            },
          },
            dom: 'Bfrtip',
            buttons: [
              { extend: 'copy', text: 'Copiar Datos' },
              { extend: 'excel', text: 'Exportar Excel' },
              { extend: 'csv', text: 'Exportar CSV' }
            ]
        }
      );
    });
  </script>
@endsection
