@component('mail::message')
# Estimado:

Le informamos que la justificación realizada por el alumno <strong>{{ $nombreAlumno }}</strong>
con fecha <strong>{{ date('d-m-Y', strtotime($fechaJustificacion)) }}</strong>
ha sido <strong>RECHAZADA</strong> por su coordinador(a).
El alumno también fue informado de esta resolución.

## Detalle Solicitud

* Rut: {{ $rutAlumno }}
* Nombre: {{ $nombreAlumno }}
* Carrera: {{ $carreraAlumno }}
* Asignatura: {{ $asignatura }}
* Coordinador: {{ $nombreCoordinador }}
* Resolución: {{ $resolucion }}

<i>Sistema de Justificaciones Duoc UC - Sede Antonio Varas, 2018.</i>
@endcomponent
