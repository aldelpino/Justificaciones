@component('mail::message')
# Estimado:

Le informamos que la justificación realizada por el alumno <strong>{{ $nombreAlumno }}</strong>
con fecha <strong>{{ date('d-m-Y', strtotime($fechaJustificacion)) }}</strong>
ha sido <strong>APROBADA</strong> por su coordinador(a). El alumno también fue informado de esta resolución,
favor coordinar con alumno(a) para rendir evaluación si corresponde.

## Detalle Solicitud

* Rut: {{ $rutAlumno }}
* Nombre: {{ $nombreAlumno }}
* Carrera: {{ $carreraAlumno }}
* Asignatura: {{ $asignatura }}
* Coordinador: {{ $nombreCoordinador }}
* Resolución: {{ $resolucion }}

<i>Justificaciones DuocUC, 2018.</i>
@endcomponent
