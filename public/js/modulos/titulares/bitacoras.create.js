
$(document).ready(function(){

    $(".btn-guardar").click(function() {
        swal({
            title: 'Guardar Datos',
            text: "Esta seguro de guardar los datos?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                //swal({title: "<span style='color:#3498db'>Enviado!</span>", html: "El registro ha sido enviado <b>satisfactoriamente</b>.", type: "success" });
                $(".myform").submit();
            }
        });
    });

    $('.myform').on('submit', function(e) {
        $(".btn-guardar").prop('disabled', true);
        var el = $('.myform');

        //validate();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: el.attr('action'),
            data: $(this).serialize(),
            success: function(json) {
                $('#id').val(json.id_documento_bitacora);
                if(json.origin=='create') clean_form();
                var fields = json.data;
                messages_validation(fields, false);
                swal({
                    type: 'success',
                    title: 'Exito',
                    html: json.success,
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    $(".btn-guardar").prop('disabled', false);
                    if( json.sended_at ) window.location = json.url;
                });
            },
            error: function(json) {
                var jsonString=json.responseJSON;
                if(json.status === 422) {
                    messages_validation(null, false);
                    swal({
                        type: 'warning',
                        title: 'Lo sentimos !',
                        html: 'Se han encontrado <b>campos vacios</b>, favor de verificar.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    var errors = jsonString.errors;
                    messages_validation(errors, true);
                }
                if(json.status === 409) {
                    var errors = jsonString.errors;
                    swal({
                      type: 'error',
                      title: 'Error!',
                      html: errors
                    });
                 }
                 $(".btn-guardar").prop('disabled', false);
            }
        });
    });
});


function messages_validation(fields, show)
{
    if(show==true){
        //alert(2);
        $.each(fields, function(key, value) {
            $('#el-'+key).html(value);
            //$('#'+key).addClass('md-input-danger');
            //$('#lbl-'+key).addClass('md-color-red-A700');
            $('#el-'+key).removeClass('hidden');
        });
    }
    else{
        
        $('label.error').html("");
        //$("input.md-input-danger").removeClass('md-input-danger');
        $('label.error').addClass('hidden');
        //$("label.md-color-red-A700").removeClass('md-color-red-A700');
    }
}

function responder(vid_documento_interno)
 {
    if(vid_documento_interno>0)
        window.location.href=vuri +'/titular/borradores/'+ vid_documento_interno +'/pdf';
 }