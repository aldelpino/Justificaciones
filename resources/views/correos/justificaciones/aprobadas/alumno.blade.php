@component('mail::message')
# Estimado:

Le informamos que la solicitud <strong>{{ $folio }}</strong> ha sido <strong>APROBADA</strong> por su coordinador(a)
con fecha <strong>{{ date("d-m-Y", strtotime($fechaJustificacion)) }}</strong>.
Su docente <strong>{{ $nombreProfesor }}</strong> será informado
de esta situación. Debe coordinar con el docente si justifica alguna evaluación.

## Detalle Solicitud

* Rut: {{ $rutAlumno }}
* Nombre: {{ $nombreAlumno }}
* Asignatura: {{ $asignatura }}
* Resolución: {{ $resolucion }}

Favor, conservar este mail.

<i>Justificaciones DuocUC, 2018.</i>
@endcomponent
