$(document).ready(
    function() {
        $('._recibido').addClass('active');

        acuses(); 
        var buttonpressed;
        $('#btnreturnar').click(function() {
            buttonpressed= $(this).attr('name');
            swal({
                title: 'Guardar los datos',
                text: "Esta seguro de guardar los datos?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $(".myform").submit();
                }
            });
        });

        $('#btnconcluir_folio').click(function() {
            buttonpressed= $(this).attr('name');
            swal({
                title: 'Concluir el folio',
                text: "Esta seguro de concluir el folio?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $(".myform_concluir").submit();
                }
            });
        });

        $('.myform').on('submit', function(e) {
            var el = $('.myform');

            e.preventDefault();
            $.ajax({
                type: "POST",
                url: el.attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(json) {
                    $('#btnvista').show();

                    var fields = json.data;
                    messages_validation(fields, false);
                    swal({
                        type: 'success',
                        title: 'Exito',
                        html: 'Documento returnado correctamente.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        // $(".btn-guardar").prop('disabled', false);
                        $(".modal").modal("hide");
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
                    if ( json.status === 409 ) {
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



        $('.myform_concluir').on('submit', function(e) {
            var el = $('.myform_concluir');

            e.preventDefault();
            $.ajax({
                type: "POST",
                url: el.attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(json) {

                    swal({
                        type: 'success',
                        title: 'Exito',
                        html: 'Folio concluido correctamente.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        $(".modal").modal("hide");
                    });
                },
                error: function(json) { }
            });
        });
    
    }
);

function acusar()
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/titular/recibidos/acusar',
        dataType: "JSON",
        data: {
            id: $('#id').val(),
            id_tipo_documento: $('#id_tipo_documento').val()
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
        	if ( vresponse.codigo == 1 ) {
                swalFire('success', 'Mensaje', vresponse.respuesta);
	            acuses();

	            $('#btnacusar').hide();                
                $('#btnresponder').show();
                $('#btnreturnar').show();
                $('#btnconcluir').show();
        	}        	
		},
        error: function(vjqXHR, vtextStatus, verrorThrown){
            toastrAlert(verrorThrown, vtitle, 0);
        }
    });  
 }

function acuses()
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/titular/recibidos/detalles',
        dataType: "JSON",
        data: {
            id: $('#id').val(),
            id_tipo_documento: $('#id_tipo_documento').val()
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vhtml ='';
                vhtml+='<h4 class="mb-3">Listado de acuses</h4>';
                vhtml+='<table class="table table-striped table-hover" width="100%">';
                vhtml+='    <thead>';
                vhtml+='        <th>VISTO</th>';
                vhtml+='        <th>TIPO</th>';
                vhtml+='        <th>AREA/RESPONSABLE</th>';
                vhtml+='        <th>ACUSE</th>';
                vhtml+='    </thead>';
                vhtml+='    <tbody>';                
            for(var vi=0; vi<vresponse.destinatarios.length; vi++) {
                var vvisto='ri-checkbox-blank-line';
                var vacuse='<span class="badge badge-label bg-dark">Sin acusar</span>';
                if ( vresponse.destinatarios[vi].es_nuevo == 0 ) vvisto='ri-checkbox-line';
                if ( vresponse.destinatarios[vi].acuse != null ) vacuse='<span class="badge badge-label bg-success">' + vresponse.destinatarios[vi].acuse +'</span>';

                vhtml+='        <tr>';
                vhtml+='            <td><i class="'+ vvisto +'"></i></td>';
                vhtml+='            <td><span class="badge badge-label bg-info">ORIGINAL</span></td>';
                vhtml+='            <td>';
                vhtml+='                '+ vresponse.destinatarios[vi].responsable_area +'<br /><strong>' + vresponse.destinatarios[vi].area_responsable +'</strong>';
                vhtml+='            </td>';
                vhtml+='            <td>' + vacuse +'</td>';
                vhtml+='        </tr>';
            }
            for ( var vi=0; vi<vresponse.copias.length; vi++ ) {
                var vvisto='ri-checkbox-blank-line';
                var vacuse='<span class="badge badge-label bg-dark">Sin acusar</span>';
                if (vresponse.copias[vi].es_nuevo == 0) vvisto='ri-checkbox-line';
                if(vresponse.copias[vi].acuse != null) vacuse='<span class="badge badge-label bg-success">' + vresponse.copias[vi].acuse + '</span>';
                
                vhtml+='        <tr>';
                vhtml+='            <td><i class="'+ vvisto +'"></i></td>';
                vhtml+='            <td><span class="badge badge-label bg-info">ORIGINAL</span></td>';
                vhtml+='            <td>';
                vhtml+='                '+ vresponse.copias[vi].responsable_area +'<br /><strong>' + vresponse.copias[vi].area_responsable +'</strong>';
                vhtml+='            </td>';                
                vhtml+='            <td>' + vacuse +'</td>';
                vhtml+='        </tr>';
            }
                vhtml+='     </tbody>';
                vhtml+='</table>';              
   

            $('#vdestinos').html(vhtml);
            configTableBasic('table', false);
            // $('.table').footable();
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){
            toastrAlert(verrorThrown, vtitle, 0);
        }
    });  
 }

function responder(vid_documento_interno)
 {
    if(vid_documento_interno>0)
        window.location.href=vuri +'/titular/recibidos/'+ vid_documento_interno +'/responder';
 }