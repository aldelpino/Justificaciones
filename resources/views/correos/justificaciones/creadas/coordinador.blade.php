@component('mail::message')
# Estimado coordinador:

Le informamos que ha sido ingresada una nueva solicitud de justificación <strong>{{ $folio }}</strong>.
Favor, responder a la brevedad.

## Detalle

* Nombre: {{ $nombreAlumno }}
* Asignatura: {{ $resumenAsignaturas[0] }}
* Docente: {{ $nombreProfe }}
* Comentario de alumno: {{ $comentario }}

¡Gracias!

<i>Justificaciones DuocUC, 2018.</i>
@endcomponent
