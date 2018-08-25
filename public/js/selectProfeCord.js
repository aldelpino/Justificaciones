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
                    $('input[name=nombreDocente]').val(data[0].NOMBRE_DOC);
                    $('input[name=nombreCoordinador]').val(data[0].NOMBRE_COR);

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
