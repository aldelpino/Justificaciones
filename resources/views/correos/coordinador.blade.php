<h3>
<<<<<<< HEAD
        Estimado(a):      </h3>
        <div>
                Le informamos que ha sido ingresada
                una nueva solicitud de justificación  {{ $folio }}
                a su bandeja favor responder a la brevedad.<br>
            Detalle Solicitud:<br>
            {{-- Rut:<br> --}}
            Nombre: {{ $nombreAlumno }}<br>
            {{-- Carrera: <br> --}}
            {{-- Jornada: <br> --}}
            Asignatura:
            {{-- <br> --}}
            {{-- @foreach ($$resumenAsignaturas as $w) --}}
                {{ $resumenAsignaturas[0] }}
            {{-- @endforeach --}}
            <br>
            Docente: {{ $nombreProfe }}<br>
            Comentario (alumno): {{ $comentario }}<br>
            <br>
            <br>
            <br>
            <h3>Saludos cordiales sus amigos del CITT</h3>
            {{-- <img src="{{ $message->embed($pathToFile) }}"> --}}
        </div>
=======
        Estimado Profesor
    </h3>
    <div>
        Nombre Alumno: {{ $nombreAlumno }}<br>
        Nombre Profesor: {{ $nombreProfe }}<br>
        Nombre nombreCoordinador: {{ $nombreCoordinador }}

        {{-- <img src="{{ $message->embed($pathToFile) }}"> --}}
    </div>
>>>>>>> desarrollo
