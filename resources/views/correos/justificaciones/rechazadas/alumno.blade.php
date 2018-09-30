@component('mail::message')
# Estimado:

Le informamos que la solicitud <strong>{{ $folio }}</strong> ha sido <strong>RECHAZADA</strong> por su coordinador(a)
con fecha <strong>{{ date("d-m-Y", strtotime($fechaJustificacion)) }}</strong>.
Su docente será informado de esta situación.

## Detalle Solicitud

* Rut: {{ $rutAlumno }}
* Nombre: {{ $nombreAlumno }}
* Carrera: {{ $carreraAlumno }}
* Docentes:
@foreach($nombreProfesores as $p)
  * {{ $p }}
@endforeach
* Asignaturas:
@foreach ($asignaturas as $a)
  * {{ $a }}
@endforeach
* Resolución: {{ $resolucion }}

Favor, conservar este mail.

<i>Sistema de Justificaciones, {{ date('Y') }}.</i>
@endcomponent
