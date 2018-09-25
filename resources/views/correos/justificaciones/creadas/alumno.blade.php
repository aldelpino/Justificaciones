@component('mail::message')
# Estimado:

Le informamos que la solicitud <strong>{{ $folio }}</strong> ha sido ingresada con éxito.
Su coordinador revisará la solicitud y la responderá a la brevedad.

## Detalle

* Nombre: {{ $nombreAlumno }}
* Asignaturas:
@foreach($resumenAsignaturas as $asignatura)
  * {{ $asignatura }}
@endforeach
* Docente: {{ $nombreProfe }}
* Comentario de alumno: {{ $comentario }}

¡Gracias!

<i>Justificaciones DuocUC, 2018.</i>
@endcomponent
