@component('mail::message')
# Estimado:

Le informamos que la solicitud <strong>{{ $folio }}</strong> de justificación
ha sido <strong>APROBADA</strong> por su coordinador(a)
con fecha <strong>{{ date("d-m-Y", strtotime($fechaJustificacion)) }}</strong>.
Su docente <strong>{{ $nombreProfesor }}</strong> será informado
de esta situación. Si justifica alguna evaluación, debe coordinar con el docente.

## Detalle Solicitud

* Rut: {{ $rutAlumno }}
* Nombre: {{ $nombreAlumno }}
* Carrera: {{ $carreraAlumno }}
* Asignatura: {{ $asignatura }}
* Resolución: {{ $resolucion }}

Favor, conservar este mail.

<i>Sistema de Justificaciones Duoc UC - Sede Antonio Varas, 2018.</i>
@endcomponent
