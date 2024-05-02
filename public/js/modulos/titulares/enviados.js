var id_tipo_documento=0;

$(document).ready(
    function() {
        $('._enviado').addClass('active');
        index_(); 
    }
);
 
function index_()
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/titular/enviados/resultados',
        dataType: "JSON",
        data: {
            method: 'get',
            acusado: 0
        },
        success: function(vresponse, vtextStatus, vjqXHR) {

            enviados(vresponse)
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){
            toastrAlert(verrorThrown, vtitle, 0);
        }
    });
 }

function enviados(vresponse)
 {
    var vj=1;
    var vrespuesta=vresponse.respuesta;
    var vhtml ='';
        vhtml+='<table class="table table-hover table-mailbox" width="100%">';
        vhtml+='    <thead class="table-light">';
        vhtml+='        <tr class="csstr">';
        vhtml+='            <th class="text-center">No</th>';
        vhtml+='            <th class="text-center">DOCUMENTO</th>';
        vhtml+='            <th class="text-center">DESTINATARIO</th>';
        vhtml+='            <th class="text-center">ASUNTO</th>';
        vhtml+='            <th class="text-center">ACUSE</th>';
        vhtml+='            <th class="text-center">CREACION</th>';
        vhtml+='            <th class="text-center">#</th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';

        for(vi=0; vi<vrespuesta.length; vi++) {
            var vdestinatarios ='';
            var vdestinatariosText=JSON.parse(vrespuesta[vi].destinatario_text);
            if((vdestinatariosText != null) && (vdestinatariosText != '')) {
                // En revision            
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
            
            var vacusado='<p class="text-warning">No</p>';
            if ( vrespuesta[vi].acusado == 1 ) vacusado='<p class="text-success">SI</p>';

            vhtml+='    <tr class="" id="tr_'+ vrespuesta[vi].id +'">';
            vhtml+='        <td class="text-center"><span class="badge bg-success">' + (vi + 1) + '</span></td>';
            vhtml+='        <td class="text-center" onclick="detalle('+ vrespuesta[vi].id +')">';
            vhtml+='            <span class="badge badge-label bg-'+ vrespuesta[vi].tipo_documento_color+'">' + vrespuesta[vi].tipo_documento +'</span><br />'+ vrespuesta[vi].numero;
            vhtml+='        </td>';
            vhtml+='        <td class="text-center" onclick="detalle('+ vrespuesta[vi].id +')">' + vdestinatarios + '</td>';
            vhtml+='        <td class="text-center">' + vrespuesta[vi].asunto + '</td>';
            vhtml+='        <td class="text-center">' + vacusado + '</td>';
            vhtml+='        <td class="text-center">' + changeDateFormat(vrespuesta[vi].created_at) + '</td>';
            vhtml+='        <td class="text-center">';
            vhtml+='            <button class="btn btn-outline-success btn-icon waves-effect waves-light" onclick="detail('+ vrespuesta[vi].id +')" title="Detalles">';
            vhtml+='                <i class="ri-file-list-3-line"></i>';
            vhtml+='            </button>';
            vhtml+='            <a class="btn btn-outline-danger btn-icon waves-effect waves-light" href="'+ vuri +'/titular/documento/'+ vrespuesta[vi].id +'/pdf" title="Vista preliminar" target="_blank">';
            vhtml+='                <i class="bx bx-zoom-in"></i>';
            vhtml+='            </a>';
            vhtml+='        </td>';
            vhtml+='    </tr>';
            vj++;
        }
    vhtml+='    </tbody>';
    vhtml+='</table>';

    $('._response').html(vhtml);
    configTableBasic('table', false);
 }

function turnados(vrespuesta, vid_tipo_documento)
{
    var vj=1;
    var vhtml ='';
    for(vi=0; vi<vrespuesta.length; vi++) {
        var vacusado='<p class="text-warning">No</p>';
        if(vrespuesta[vi].acusado==1) vacusado='<p class="text-success">SI</p>';

        vhtml+='        <tr class="" id="tr_'+ vrespuesta[vi].id +'">';
        vhtml+='            <td class="text-center"><span class="label label-success">' + (vi + 1) + '</span></td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].folio + '</td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].indicaciones + '</td>';
        vhtml+='            <td class="text-center">' + vacusado + '</td>';
        vhtml+='            <td class="text-center">' + changeDateFormat(vrespuesta[vi].created_at) + '</td>';
        vhtml+='            <td class="text-center">';
        vhtml+='                <button class="btn btn-default" data-toggle="modal" data-target="#myModal" onclick="detail('+ vrespuesta[vi].id +')" title="Detalles">';
        vhtml+='                    <i class="fa fa-eye"></i>';
        vhtml+='                </button>';
        // vhtml+='                <a class="btn btn-success" href="'+ vuri +'/titular/documento/'+ vrespuesta[vi].id +'/pdf" title="Vista preliminar" target="_blank">';
        // vhtml+='                    <i class="fa fa-file"></i>';
        // vhtml+='                </a>';
        vhtml+='                <a class="btn btn-primary" href="'+ vuri +'/titular/enviados/'+ vrespuesta[vi].id +'/data/100" title="Detalles del documento">';
        vhtml+='                    <i class="fa fa-window-maximize"></i>';
        vhtml+='                </a>';
        vhtml+='            </td>';
        vhtml+='        </tr>';
        vj++;
    }

    switch(vid_tipo_documento){
        case 7:    $('#vrespuesta3').html(vhtml); break;
        case 100:  $('#vrespuesta4').html(vhtml); break;            
    }     
}

function detail(vid)
 {
    $('.mdl-show').modal('show');

    $.ajax({
        type: 'GET',
        url: vuri + '/titular/recibidos/detalles',
        dataType: "JSON",
        data: {
            id: vid
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vhtml ='';
                vhtml+='<h4>LISTADO DE ACUSES</h4>';
                vhtml+='<table class="table align-middle table-nowrap mb-0" width="100%">';
                vhtml+='    <thead>';
                vhtml+='        <th>VISTO</th>';
                vhtml+='        <th>TIPO</th>';
                vhtml+='        <th>AREA/RESPONSABLE</th>';
                vhtml+='        <th>ACUSE</th>';
                vhtml+='    </thead>';
                vhtml+='    <tbody>';                
            for(var vi=0; vi<vresponse.destinatarios.length; vi++) {
                var vvisto='ri-checkbox-blank-line';
                var vacuse='Sin acusar';
                if (vresponse.destinatarios[vi].es_nuevo == 0) vvisto='ri-checkbox-line';
                if (vresponse.destinatarios[vi].acuse != null) vacuse=vresponse.destinatarios[vi].acuse;

                vhtml+='        <tr>';
                vhtml+='            <td><i class="'+ vvisto +'"></i></td>';
                vhtml+='            <td><span class="badge badge-label bg-info">ORIGINAL</span></td>';
                vhtml+='            <td>';
                vhtml+='                '+ vresponse.destinatarios[vi].responsable_area +'<br /><strong>' + vresponse.destinatarios[vi].area_responsable +'</strong>';
                vhtml+='            </td>';
                vhtml+='            <td>' + vacuse +'</td>';
                vhtml+='        </tr>';
            }
            for(var vi=0; vi<vresponse.copias.length; vi++) {
                var vvisto='ri-checkbox-blank-line';
                var vacuse='Sin acusar';
                if (vresponse.copias[vi].es_nuevo == 0) vvisto='ri-checkbox-line';
                if (vresponse.copias[vi].acuse != null) vacuse=vresponse.copias[vi].acuse;                
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

            var vhtmlAnexo ='';
                vhtmlAnexo+='   <div class="mt-4 text-muted border-top border-top-dashed pt-3">';
                vhtmlAnexo+='       <h6 class="fs-14">';
                vhtmlAnexo+='           <span class="badge badge-label bg-warning">'+ vresponse.anexos.length +'</span> Anexos Existentes';
                vhtmlAnexo+='       </h6>';
                vhtmlAnexo+='       <ul class="list-group list-group-flush">';
            for(var vi=0; vi<vresponse.anexos.length; vi++) {                
                vhtmlAnexo+='           <a href="'+ vuri +'/anexos/' + vresponse.anexos[vi].id + '/descarga" class="list-group-item list-group-item-action">';
                vhtmlAnexo+='               <i class="bx bx-paperclip"></i> '+ vresponse.anexos[vi].nombre;
                vhtmlAnexo+='           </a>';              
            }
                vhtmlAnexo+='       </ul>';
                vhtmlAnexo+='   </div>';

            $('._destinatarios').html(vhtml);
            $('._anexos').html(vhtmlAnexo);
            $('.modal-title').html(vresponse.respuesta.numero);
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

function detalle(vid)
 {
    window.location.href=vuri+'/titular/enviados/'+ vid;
 }

function changeDateFormat(vfecha) 
 {
    var vfecha_request=vfecha.split(" ");
    var vfecha_response=vfecha_request[0].split("-");
    var vresponse=vfecha_response[2] + "/" + vfecha_response[1] + "/" + vfecha_response[0] + " " + vfecha_request[1];
    return vresponse;
 }