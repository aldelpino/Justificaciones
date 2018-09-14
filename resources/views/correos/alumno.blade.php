<h3>Estimado(a):</h3>
<div>
    Le informamos que la solicitud <h3> {{ $folio }} </h3> ha sido ingresada con éxito, su coordinador/a revisará la solicitud y la responderá a la brevedad.<br>
    <h3> Solicitud:</h3><br>
    {{-- Rut:<br> --}}
    Nombre: {{ $nombreAlumno }}<br>
    {{-- Carrera: <br> --}}
    {{-- Jornada: <br> --}}
    Asignatura:
    {{-- <br> --}}
    {{-- @foreach ($$resumenAsignaturas as $w) --}}
    @foreach($resumenAsignaturas as $p)
        {{$p}}
    @endforeach
        {{-- {{ $resumenAsignaturas[0] }} --}}
    {{-- @endforeach --}}
    <br>
    Docente: {{ $nombreProfe }}<br>
    Comentario (alumno): {{ $comentario }}<br>
    <br>
    Favor conservar este mail.<br>
    <h3>Saludos cordiales sus amigos del CITT</h3>
    {{-- <img src="{{ $message->embed($pathToFile) }}"> --}}
</div>
