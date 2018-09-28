@component('mail::message')
# Estimado:

Le informamos que la solicitud <strong>{{ $folio }}</strong> ha sido ingresada con éxito.
Su coordinador revisará la solicitud y la responderá a la brevedad.

## Detalle

* Rut: {{ $rutAlumno }}
* Nombre: {{ $nombreAlumno }}
* Carrera: {{ $carreraAlumno }}
* Asignaturas:
@foreach($resumenAsignaturas as $asignatura)
  * {{ $asignatura }}
@endforeach
* Docentes: {{ $nombreProfes }}
* Comentario de alumno: {{ $comentario }}

¡Gracias!

<i>Sistema de Justificaciones Duoc UC - Sede Antonio Varas, 2018.</i>
@endcomponent
