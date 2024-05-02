
$(document).ready(
    function() {
        if ( document.getElementById('id').value > 0) {
            $('.btn-preview').show();
        }
        else {
            $('.btn-preview').hide();
        }

        $('#filer_input').filer({
            allowDuplicates: false,
            limit: 6,
            maxSize: 15,
            extensions: ["ods", "odt","jpg", "jpge", "png", "xls", "xlsx", "ppt", "odt", "pptx", "docx", "doc", "pdf", "zip", "rar"],
            showThumbs: true,
            addMore: true        
        });
        
        cotrolSetting();

        $('.btn-send').attr('onclick', 'confirm_send();');
        $('.btn-save').attr('onclick', 'confirm_save()');
        $("#id_tipo_documento").attr("onchange", "cotrolSetting();");
    }
);

function cotrolSetting()
 {
    let id_documento_interno=document.getElementById('id_tipo_documento').value;
    if ( id_documento_interno == 0 ) {
        $('#vcargos').hide();
        $('#vid_destinatario').show();
    }
    else if ( id_documento_interno != 3 ) {
        $('#vcargos').hide();
        $('#vid_destinatario').show();
    }
    else {
        $('#vcargos').show();
        $('#vid_destinatario').hide();
    }
 }

function confirm_save()
 {
    Swal.fire({
        title: "¿Está seguro que desea guardar los datos?",
        text: "Esta acción no se podra revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, estoy seguro!",
        cancelButtonText: "No, estoy seguro!",
        reverseButtons: true,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    }).then(function(result) {
        if ( result.value ) {
            save();
        }
        else if (result.dismiss === "cancel") {
            swalFire('info', 'Usuario', 'Acción cancelada por el usuario.');
        }
    });
 }

function save()
 {
    $(".btn-guardar").prop('disabled', true);

    var formID=document.getElementById("frm-draft");
    var dataForm = new FormData(formID);

    // var vsumernoteCode = $('.summernote').summernote('code');

    $.ajax({
        type: "POST",
        url: vuri + '/titular/borradores',
        data: dataForm,
        processData: false,
        contentType: false,
        success: function(json) {
            $('.btn-preview').show();

            $('#id').val(json.id_documento_interno);
            var fields = json.data;
            messages_validation(fields, false);
            swalFire('success', 'Mensaje', json.respuesta);

            $(".btn-guardar").prop('disabled', false);
        },
        error: function(json) {
            var jsonString=json.responseJSON;
            if ( json.status === 422 ) {
                messages_validation(null, false);
                swalFire('warning', 'Mensaje', 'Se han encontrado <b>campos vacios</b>, favor de verificar.');
                
                var errors = jsonString.errors;
                messages_validation(errors, true);
            }
            if ( json.status === 409 ) {
                var errors = jsonString.errors;
                swalFire('danger', 'Mensaje', errors);
            }

            $(".btn-guardar").prop('disabled', false);
        }
    });
   
 }

function confirm_send()
 {
    Swal.fire({
        title: "¿Está seguro que desea enviar los datos?",
        text: "Esta acción no se podra revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, estoy seguro!",
        cancelButtonText: "No, estoy seguro!",
        reverseButtons: true,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    }).then(function(result) {
        if ( result.value ) {
            send();
        }
        else if (result.dismiss === "cancel") {
            swalFire('info', 'Usuario', 'Acción cancelada por el usuario.')
        }
    });
 }

function send()
 {
    $(".btn-guardar").prop('disabled', true);

    var formID=document.getElementById("frm-draft");
    var dataForm = new FormData(formID);
        dataForm.append('sended_at', 1);

    // var vsumernoteCode = $('.summernote').summernote('code');

    $.ajax({
        type: "POST",
        url: vuri + '/titular/borradores',
        data: dataForm,
        processData: false,
        contentType: false,
        success: function(json) {
            $('.btn-preview').show();

            $('#id').val(json.id_documento_interno);
            // var fields = json.data;
            // messages_validation(fields, false);
            swalFire('success', 'Mensaje', json.respuesta, '/titular/borradores');

            $(".btn-guardar").prop('disabled', false);
        },
        error: function(json) {
            swalFire('warning', 'Mensaje', 'Se han encontrado <b>campos vacios</b>, favor de verificar.');
            $(".btn-guardar").prop('disabled', false);
        }
    });  
 }

function messages_validation(fields, show)
 {
    if ( show == true ) {
        $.each(fields, function(key, value) {
            $('#el-'+key).html(value);
            $('#el-'+key).removeClass('hidden');
        });
    }
    else {
        $('label.error').html("");
        $('label.error').addClass('hidden');
    }
 }

function open_pdf()
 {
    if ( document.getElementById('id').value > 0 ) {
        $(".btn-preview").attr("href", vuri +'/titular/documento/'+ document.getElementById('id').value +'/pdf');
    }
 }