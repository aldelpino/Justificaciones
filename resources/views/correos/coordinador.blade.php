<h3>
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
