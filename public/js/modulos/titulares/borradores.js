$(document).ready(
    function() {
        $('._por_enviar').addClass('active');
        index_(); 
    }
);
 
function index_()
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/titular/borradores/resultados',
        dataType: "JSON",
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vrespuesta=vresponse.respuesta;
            switch(vresponse.codigo){
                case 0:
                    borradores(vrespuesta);
                  break;
                case 1:
                    borradores(vrespuesta);
                  break;
            }
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){
            toastrAlert(verrorThrown, vtitle, 0);
        }
    });  
 }

function borradores(vrespuesta)
{
    var vhtml ='';
        vhtml+='<div class="table-responsive">';
        vhtml+='    <table class="table align-middle table-nowrap mb-0" width="100%">';
        vhtml+='        <thead class="table-light">';
        vhtml+='            <tr class="csstr">';
        vhtml+='                <th class="text-center">No</th>';
        vhtml+='                <th class="text-center">DOCUMENTO</th>';
        vhtml+='                <th class="text-center">DESTINATARIO</th>';
        vhtml+='                <th class="text-center">ASUNTO</th>';
        vhtml+='                <th class="text-center">CREACION</th>';
        vhtml+='                <th class="text-center">#</th>';
        vhtml+='            </tr>';
        vhtml+='        </thead>';
        vhtml+='        <tbody>';

        for(vi=0; vi<vrespuesta.length; vi++) {
            var vdestinatarios ='';
            var vdestinatariosText=JSON.parse(vrespuesta[vi].destinatario_text);
            if((vdestinatariosText != null) && (vdestinatariosText != '')){
                for(vj=0; vj<vdestinatariosText.length; vj++) {
                    var vsalto ='';
                    if(vj > 0) vsalto='<br />';
                    if(vrespuesta[vi].id_tipo_documento == 3){
                        vdestinatarios+=vsalto + vdestinatariosText[vj].responsable;
                    }
                    else {
                        if(vj < 2) 
                            vdestinatarios+=vsalto + vdestinatariosText[vj].responsable +'<br /><strong>'+ vdestinatariosText[vj].area +'</strong>';
                    }
                }
            }

            vhtml+='        <tr class="clickable-row" id="tr_'+ vrespuesta[vi].id +'">';
            vhtml+='            <td class="text-center"><span class="badge bg-success">' + (vi + 1) + '</span></td>';
            vhtml+='            <td class="text-center" onclick="edit(' + vrespuesta[vi].id + ')"><p class="text-'+ vrespuesta[vi].tipo_documento_color +'">' + vrespuesta[vi].tipo_documento + '</p></td>';
            vhtml+='            <td class="text-center" onclick="edit(' + vrespuesta[vi].id + ')">' + vdestinatarios + '</td>';
            vhtml+='            <td class="text-center">' + vrespuesta[vi].asunto + '</td>';
            vhtml+='            <td class="text-center">' + changeDateFormat(vrespuesta[vi].created_at) + '</td>';
            vhtml+='            <td class="text-center">';

            vhtml+='                <a class="btn btn-outline-success btn-icon waves-effect waves-light" href="'+ vuri +'/titular/documento/'+ vrespuesta[vi].id +'/pdf" target="_blank">';
            vhtml+='                    <i class="bx bx-zoom-in"></i>';
            vhtml+='                </a>';
            vhtml+='                <a class="btn btn-outline-danger btn-icon waves-effect waves-light" onclick="delete_('+ vrespuesta[vi].id +')">';
            vhtml+='                    <i class="mdi mdi-delete-empty-outline"></i>';
            vhtml+='                </a>';

            vhtml+='            </td>';
            vhtml+='        </tr>';
        }

        vhtml+='        </tbody>';
        vhtml+='    </table>';
        vhtml+='</div>';

    $('._response').html(vhtml);
    
    configTableBasic('table', false);
}

function delete_(vid_)
 {
    swal({
        title: 'Eliminar',
        text: "Esta seguro de Eliminar el dato?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'DELETE',
                url: vuri + '/titular/borradores/' + vid_,
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(vresponse, vtextStatus, vjqXHR) {
                    swal({
                        type: 'success',
                        title: 'Exito',
                        html: 'El Dato a sido Eliminado Correctamente.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        $('#tr_' + vid_).remove();
                    });
                },
                error: function(vjqXHR, vtextStatus, verrorThrown){ }
            });
        }
    });  
 }

function edit(vid)
 {
    window.location.href=vuri+'/titular/borradores/'+ vid +'/edit';
 }

function changeDateFormat(vfecha) 
 {
    var vfecha_request=vfecha.split(" ");
    var vfecha_response=vfecha_request[0].split("-");
    var vresponse=vfecha_response[2] + "/" + vfecha_response[1] + "/" + vfecha_response[0] + " " + vfecha_request[1];
    return vresponse;
 }