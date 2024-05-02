$(document).ready(function() {
    // $('#valumnos').addClass('active');
    // $('#btnnuevo').attr('onclick', 'open_create_alumnos()');
    index_(); 
});
 
function index_()
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/titular/recibidos/resultados',
        dataType: "JSON",
        data: {
            method: 'get',
            id_tipo_envio: 2
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vrespuesta=vresponse.respuesta;
            switch(vresponse.codigo){
                case 0:
                    $('.vrespuesta').html('<div class="alert alert-warning" role="alert">'+ vrespuesta +' . . .</div>');
                  break;
                case 1:
                    recibidos(vrespuesta);
                  break;
            }
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){
            toastrAlert(verrorThrown, vtitle, 0);
        }
    });  
 }

function recibidos(vrespuesta)
{
    var vj=1;
    var vhtml ='';
        vhtml+='<table class="table table-hover table-mailbox" data-sorting="true" data-filtering="true" data-paging="true" data-paging-size="25">';
        vhtml+='    <thead>';
        vhtml+='        <tr class="csstr">';
        vhtml+='            <th class="text-center">No</th>';
        vhtml+='            <th class="text-center">DOCUMENTO</th>';
        vhtml+='            <th class="text-center">ASUNTO</th>';
        vhtml+='            <th class="text-center">REMITENTE</th>';
        vhtml+='            <th class="text-center">RECIBIDO</th>';
        vhtml+='            <th class="text-center">ACUSE</th>';
        vhtml+='            <th class="text-center">#</th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for(vi=0; vi<vrespuesta.length; vi++){
        var vacusado='No';
        if(vrespuesta[vi].acuse!='') vacusado='Si';
        vhtml+='        <tr class="" id="tr_'+ vrespuesta[vi].id +'">';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].folio + '</td>';
        vhtml+='            <td class="text-center"><p class="text-'+ vrespuesta[vi].tipo_documento_color +'">' + vrespuesta[vi].tipo_documento + '</p></td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].asunto + '</td>';
        vhtml+='            <td class="text-center">';
        vhtml+='                <strong>' + vrespuesta[vi].area_responsable_envia + '</strong><br />' + vrespuesta[vi].responsable_area_envia;
        vhtml+='            </td>';
        vhtml+='            <td class="text-center">' + changeDateFormat(vrespuesta[vi].sended_at) + '</td>';
        vhtml+='            <td class="text-center">' + vacusado + '</td>';
        vhtml+='            <td class="text-center">';
        vhtml+='                <a class="btn btn-success" href="'+ vuri +'/titular/documento/'+ vrespuesta[vi].id_documento_interno +'/pdf" title="Vista preliminar" target="_blank">';
        vhtml+='                    <i class="fa fa-file"></i>';
        vhtml+='                </a>';
        vhtml+='                <a class="btn btn-primary" href="'+ vuri +'/titular/recibidos/'+ vrespuesta[vi].id_documento_interno +'" title="Detalles del documento">';
        vhtml+='                    <i class="fa fa-edit"></i>';
        vhtml+='                </a>';
        vhtml+='            </td>';
        vhtml+='        </tr>';
        vj++;
    }
        vhtml+='    </tbody>';
        vhtml+='</table>';
        $('.vrespuesta').html(vhtml);
        $('.table').footable();
}

function delete_(vid_)
 {
    $.ajax({
        type: 'DELETE',
        url: vuri + '/titular/recibidos/' + vid_,
        dataType: "JSON",
        data: {
            _token: $('#_token').val()
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            $.toast({
                heading: 'Eliminación',
                text: vresponse.respuesta,
                position: 'top-right',
                loaderBg: '#fff',
                icon: 'success',
                hideAfter: 3500,
                stack: 6
            });
            $('#tr_' + vid_).remove();
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });  
 }

function changeDateFormat(vfecha) 
 {
    var vfecha_request=vfecha.split(" ");
    var vfecha_response=vfecha_request[0].split("-");
    var vresponse=vfecha_response[2] + "/" + vfecha_response[1] + "/" + vfecha_response[0] + " " + vfecha_request[1];
    return vresponse;
 }