var id_tipo_documento=0;

$(document).ready(function() {
    // $('#valumnos').addClass('active');
    // $('#btnnuevo').attr('onclick', 'open_create_alumnos()');
    $('#btn_1').attr('onclick', 'index_(2)');
    $('#btn_2').attr('onclick', 'index_(3)');
    $('#btn_3').attr('onclick', 'index_(0)');
    index_(2); 
});
 
function index_(vid_tipo_documento)
 {
    id_tipo_documento=vid_tipo_documento;
    
    $.ajax({
        type: 'GET',
        url: vuri + '/titular/enviados/resultados',
        dataType: "JSON",
        data: {
            method: 'get',
            acusado: 1,
            id_tipo_documento: vid_tipo_documento
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vrespuesta=vresponse.respuesta;
            switch(vresponse.codigo){
                case 0:
                    $('.vrespuesta1').html('<div class="alert alert-warning" role="alert">'+ vrespuesta +' . . .</div>');
                    $('.vrespuesta2').html('<div class="alert alert-warning" role="alert">'+ vrespuesta +' . . .</div>');
                    $('.vrespuesta3').html('<div class="alert alert-warning" role="alert">'+ vrespuesta +' . . .</div>');
                  break;
                case 1:
                    enviados(vrespuesta, vid_tipo_documento);
                  break;
            }
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){
            toastrAlert(verrorThrown, vtitle, 0);
        }
    });  
 }

function enviados(vrespuesta, vid_tipo_documento)
{
    var vj=1;
    var vhtml ='';
        vhtml+='<table class="table table-hover table-mailbox" data-sorting="true" data-filtering="true" data-paging="true" data-paging-size="25">';
        vhtml+='    <thead>';
        vhtml+='        <tr class="csstr">';
        vhtml+='            <th class="text-center">No/DOCUMENTO</th>';
        vhtml+='            <th class="text-center">ASUNTO</th>';
        vhtml+='            <th class="text-center">ACUSE</th>';
        vhtml+='            <th class="text-center">CREACION</th>';
        vhtml+='            <th class="text-center">#</th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for(vi=0; vi<vrespuesta.length; vi++) {
        var vacusado='<p class="text-warning">No</p>';
        if(vrespuesta[vi].acusado==1) vacusado='<p class="text-success">SI</p>';

        vhtml+='        <tr class="" id="tr_'+ vrespuesta[vi].id +'">';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].tipo_documento +'<br />'+ vrespuesta[vi].folio + '</td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].asunto + '</td>';
        vhtml+='            <td class="text-center">' + vacusado + '</td>';
        vhtml+='            <td class="text-center">' + changeDateFormat(vrespuesta[vi].created_at) + '</td>';
        vhtml+='            <td class="text-center">';
        vhtml+='                <button class="btn btn-default" data-toggle="modal" data-target="#myModal" onclick="detail('+ vrespuesta[vi].id +')" title="Detalles">';
        vhtml+='                    <i class="fa fa-eye"></i>';
        vhtml+='                </button>';
        vhtml+='                <a class="btn btn-success" href="'+ vuri +'/titular/documento/'+ vrespuesta[vi].id +'/pdf" title="Vista preliminar" target="_blank">';
        vhtml+='                    <i class="fa fa-file"></i>';
        vhtml+='                </a>';
        vhtml+='                <a class="btn btn-primary" href="'+ vuri +'/titular/enviados/'+ vrespuesta[vi].id +'" title="Detalles del documento">';
        vhtml+='                    <i class="fa fa-edit"></i>';
        vhtml+='                </a>';
        vhtml+='            </td>';
        vhtml+='        </tr>';
        vj++;
    }
        vhtml+='    </tbody>';
        vhtml+='</table>';

        switch(vid_tipo_documento){
            case 2: $('.vrespuesta1').html(vhtml); break;
            case 3: $('.vrespuesta2').html(vhtml); break;
            case 0: $('.vrespuesta3').html(vhtml); break;
        }
        $('.table').footable();
}

function detail(vid)
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/titular/recibidos/detalles',
        dataType: "JSON",
        data: {
            id: vid,
            id_tipo_documento: id_tipo_documento
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vhtml ='';
                vhtml+='<h4>LISTADO DE ACUSES</h4>';
                vhtml+='<table class="table table-striped">';
                vhtml+='    <thead>';
                vhtml+='        <th>VISTO</th>';
                vhtml+='        <th>TIPO</th>';
                vhtml+='        <th>AREA/RESPONSABLE</th>';
                vhtml+='        <th>ACUSE</th>';
                vhtml+='    </thead>';
                vhtml+='    <tbody>';                
            for(var vi=0; vi<vresponse.destinatarios.length; vi++) {
                var vvisto='fa-square-o';
                var vacuse='Sin acusar';
                if (vresponse.destinatarios[vi].es_nuevo == 0) vvisto='fa-check-square-o';
                if (vresponse.destinatarios[vi].acuse != null) vacuse=vresponse.destinatarios[vi].acuse;

                vhtml+='        <tr>';
                vhtml+='            <td><i class="fa '+ vvisto +'"></i></td>';
                vhtml+='            <td><span class="label label-info">ORIGINAL</span></td>';
                vhtml+='            <td>';
                vhtml+='                '+ vresponse.destinatarios[vi].responsable_area +'<br /><strong>' + vresponse.destinatarios[vi].area_responsable +'</strong>';
                vhtml+='            </td>';
                vhtml+='            <td>' + vacuse +'</td>';
                vhtml+='        </tr>';
            }
            for(var vi=0; vi<vresponse.copias.length; vi++) {
                var vvisto='fa-square-o';
                var vacuse='Sin acusar';
                if (vresponse.copias[vi].es_nuevo == 0) vvisto='fa-check-square-o';
                if (vresponse.copias[vi].acuse != null) vacuse=vresponse.copias[vi].acuse;
                
                vhtml+='        <tr>';
                vhtml+='            <td><i class="fa '+ vvisto +'"></i></td>';
                vhtml+='            <td><span class="label label-info">ORIGINAL</span></td>';
                vhtml+='            <td>';
                vhtml+='                '+ vresponse.copias[vi].responsable_area +'<br /><strong>' + vresponse.copias[vi].area_responsable +'</strong>';
                vhtml+='            </td>';                
                vhtml+='            <td>' + vacuse +'</td>';
                vhtml+='        </tr>';
            }
                vhtml+='     </tbody>';
                vhtml+='</table>';

            var vhtmlAnexo ='';
                vhtmlAnexo+='   <p class="m-b-md">';
                vhtmlAnexo+='       <span><i class="fa fa-paperclip"></i> <span class="label label-warning">'+ vresponse.anexos.length +'</span> Anexos Existentes</span>';
                vhtmlAnexo+='   </p>';
            for(var vi=0; vi<vresponse.anexos.length; vi++) {
                vhtmlAnexo+='   <div class="row">';
                vhtmlAnexo+='       <div class="col-sm-3">';
                vhtmlAnexo+='           <div class="hpanel">';
                vhtmlAnexo+='               <div class="panel-body file-body">';
                vhtmlAnexo+='                   <i class="fa fa-file-pdf-o text-info"></i>';
                vhtmlAnexo+='               </div>';
                vhtmlAnexo+='               <div class="panel-footer">';
                vhtmlAnexo+='                   <a href="#">'+ vresponse.anexos[vi].nombre +'</a>';
                vhtmlAnexo+='               </div>';
                vhtmlAnexo+='           </div>';
                vhtmlAnexo+='       </div>';
                vhtmlAnexo+='   </div>';                
            }

            $('#vdestinos').html(vhtml);
            $('#vanexos').html(vhtmlAnexo);
            $('.modal-title').html(vresponse.respuesta.folio);
            $('.font-bold').html(vresponse.respuesta.asunto);
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){
            toastrAlert(verrorThrown, vtitle, 0);
        }
    });
 }

function delete_(vid_)
 {
    $.ajax({
        type: 'DELETE',
        url: vuri + '/titular/enviados/' + vid_,
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