$(document).ready(function() {

    $('select[name="asignatura"]').on('change', function(){
        var asignaturaId = $(this).val();
        if(asignaturaId) {
            $.ajax({
                url: '/asignaturas/get/'+asignaturaId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {
                    window.console&&console.log(data);
                    // var objData = JSON.parse(data);
                    $('input[name=correoDocente]').val(data[0].CORREO_DOC);
                    $('input[name=correoCoordinador]').val(data[0].CORREO_COR);
                    $('input[name=nombreDocente]').val(data[0].NOMBRE_DOC + ' ' + data[0].APEP_DOC);
                    $('input[name=nombreCoordinador]').val(data[0].NOMBRE_COR + ' ' + data[0].APEP_COR);

                    // $.each(data, function(key, value){

                    //     $('select[name="state"]').append('<option value="'+ key +'">' + value + '</option>');

                    // });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            // $('select[name="state"]').empty();
        }

    });

});
