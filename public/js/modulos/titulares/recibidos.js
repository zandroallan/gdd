
$(document).ready(
    function() {
        $('._recibido').addClass('active');
        index_(); 
    }
);
 
function index_(vid_tipo_documento)
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/titular/recibidos/resultados',
        dataType: "JSON",
        data: {
            acuse: 1,
            method: 'get',
            id_tipo_envio: 1
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            internos(vresponse.respuesta);
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){
            toastrAlert(verrorThrown, vtitle, 0);
        }
    });  
 }

function internos(vrespuesta)
{
    var vj=1;
    var vhtml ='';
        vhtml+='<table class="table table-hover table-mailbox" width="100%">';
        vhtml+='    <thead>';
        vhtml+='        <tr class="csstr">';
        vhtml+='            <th class="text-center">No</th>';
        vhtml+='            <th class="text-center">NUMERO</th>';
        vhtml+='            <th class="text-center">REMITENTE</th>';
        vhtml+='            <th class="text-center">ASUNTO</th>';
        vhtml+='            <th class="text-center">RECIBIDO</th>';
        vhtml+='            <th class="text-center">ACUSE</th>';
        vhtml+='            <th class="text-center">#</th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for ( vi=0; vi<vrespuesta.length; vi++ ) {
        var vacusado='No';
        var vesNuevo='active';
        var vstyleNuevo='';
        if ( vrespuesta[vi].acuse != '' ) vacusado='Si';
        if ( vrespuesta[vi].es_nuevo == 1 ) { vesNuevo='unread'; vstyleNuevo="font-weight: bold; color: #000;"; }

        vhtml+='        <tr class="'+ vesNuevo +'" style="'+ vstyleNuevo +'" id="tr_'+ vrespuesta[vi].id_documento_interno +'">';
        vhtml+='            <td class="text-center"><span class="badge bg-success">' + (vi + 1) + '</span></td>';
        vhtml+='            <td class="text-center">';
        vhtml+='                <a class="" href="'+ vuri +'/titular/recibidos/'+ vrespuesta[vi].id_documento_interno +'/data/'+ vrespuesta[vi].id_tipo_documento +'">' + vrespuesta[vi].folio + '</a>';
        vhtml+='                <br /><span class="badge badge-label bg-'+ vrespuesta[vi].tipo_documento_color +'">'+ vrespuesta[vi].tipo_documento +'</span>';        
        vhtml+='            </td>';        
        vhtml+='            <td class="text-center">';
        vhtml+='                <strong>' + vrespuesta[vi].area_responsable_envia + '</strong><br />' + vrespuesta[vi].responsable_area_envia;
        vhtml+='            </td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].asunto + '</td>';
        vhtml+='            <td class="text-center">' + changeDateFormat(vrespuesta[vi].sended_at) + '</td>';
        vhtml+='            <td class="text-center">' + vacusado + '</td>';
        vhtml+='            <td class="text-center">';
        vhtml+='                <button class="btn btn-outline-success btn-icon waves-effect waves-light" onclick="show('+ vrespuesta[vi].id_documento_interno +')" title="Vista preliminar">';
        vhtml+='                    <i class="ri-file-list-3-line"></i>';
        vhtml+='                </button>';
        vhtml+='                <a class="btn btn-outline-danger btn-icon waves-effect waves-light" href="'+ vuri +'/titular/documento/'+ vrespuesta[vi].id_documento_interno +'/pdf" title="Vista preliminar" target="_blank">';
        vhtml+='                    <i class="bx bx-zoom-in"></i>';
        vhtml+='                </a>';
        vhtml+='            </td>';
        vhtml+='        </tr>';
        vj++;
    }
        vhtml+='    </tbody>';
        vhtml+='</table>';

    $('._response').html(vhtml);
    configTableBasic('table', false);
}

// function oficialia(vresponse)
// {
//     var vj=1;
//     var vrespuesta=vresponse.respuesta;
//     var vhtml ='';
//     for(vi=0; vi<vrespuesta.length; vi++){
//         var vacusado='<span class="badge badge-default">Sin Acusar</span>';
//         if((vrespuesta[vi].acuse!='') && (vrespuesta[vi].acuse!=null)) vacusado='<span class="badge badge-success">'+ changeDateFormat(vrespuesta[vi].acuse) +'</span>';
//         vhtml+='        <tr class="" id="tr_'+ vrespuesta[vi].id_documento_externo +'">';
//         vhtml+='            <td class="text-center"><span class="label label-success">' + (vi + 1) + '</span></td>';
//         vhtml+='            <td class="text-center">' + vrespuesta[vi].numero + '</td>';        
//         vhtml+='            <td class="text-center">';
//         vhtml+='                <strong>' + vrespuesta[vi].dependencia + '</strong>';
//         vhtml+='            </td>';
//         vhtml+='            <td class="text-center">' + vrespuesta[vi].observacion + '</td>';
//         vhtml+='            <td class="text-center">' + changeDateFormat(vrespuesta[vi].created_at) + '</td>';
//         vhtml+='            <td class="text-center">' + vacusado + '</td>';
//         if(vresponse.id_area == 4 ) {
//             var vturnado='<span class="badge badge-warning">No</span>';
//             if(vrespuesta[vi].turnado == 1) vturnado='<span class="badge badge-success">Turnado</span>';

//             vhtml+='            <td class="text-center">' + vturnado + '</td>';
//         }
//         vhtml+='            <td class="text-center">';
//         vhtml+='                <button class="btn btn-default" data-toggle="modal" data-target="#myModal" onclick="show('+ vrespuesta[vi].id_documento_externo +')" title="Vista preliminar">';
//         vhtml+='                    <i class="fa fa-eye"></i>';
//         vhtml+='                </button>';
//         vhtml+='                <a class="btn btn-primary" href="'+ vuri +'/titular/recibidos/'+ vrespuesta[vi].id_documento_externo +'/data/'+ id_tipo_documento +'" title="Detalles del documento">';
//         vhtml+='                    <i class="fa fa-window-maximize"></i>';
//         vhtml+='                </a>';
//         vhtml+='            </td>';
//         vhtml+='        </tr>';
//         vj++;
//     }
//     $('.vrespuesta4').html(vhtml);
// }

function returnados(vrespuesta)
{
    var vj=1;
    var vhtml ='';       
    for(vi=0; vi<vrespuesta.length; vi++){
        var vacusado='No';
        if(vrespuesta[vi].acuse!='') vacusado='Si';
        vhtml+='        <tr class="" id="tr_'+ vrespuesta[vi].id +'">';
        vhtml+='            <td class="text-center"><span class="label label-success">' + (vi + 1) + '</span></td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].folio + '</td>';        
        vhtml+='            <td class="text-center">';
        vhtml+='                <strong>' + vrespuesta[vi].area_responsable_envia + '</strong><br />' + vrespuesta[vi].responsable_area_envia;
        vhtml+='            </td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].indicaciones + '</td>';
        vhtml+='            <td class="text-center">' + changeDateFormat(vrespuesta[vi].created_at) + '</td>';
        vhtml+='            <td class="text-center">' + vacusado + '</td>';
        vhtml+='            <td class="text-center">';
        vhtml+='                <button class="btn btn-default" data-toggle="modal" data-target="#myModal" onclick="show('+ vrespuesta[vi].id_folio +')" title="Vista preliminar">';
        vhtml+='                    <i class="fa fa-eye"></i>';
        vhtml+='                </button>';
        vhtml+='                <a class="btn btn-primary" href="'+ vuri +'/titular/recibidos/'+ vrespuesta[vi].id_folio +'/data/'+ id_tipo_documento +'" title="Detalles del documento">';
        vhtml+='                    <i class="fa fa-window-maximize"></i>';
        vhtml+='                </a>';
        vhtml+='            </td>';
        vhtml+='        </tr>';
        vj++;
    }
    $('.vrespuesta5').html(vhtml);
}

// function folios(vrespuesta)
//  {
//     var vj=1;
//     var vhtml ='';       
//     for(vi=0; vi<vrespuesta.length; vi++){
//         var vacusado='No';
//         if(vrespuesta[vi].acuse!='') vacusado='Si';
//         vhtml+='        <tr class="" id="tr_'+ vrespuesta[vi].id +'">';
//         vhtml+='            <td class="text-center"><span class="label label-success">' + (vi + 1) + '</span></td>';
//         vhtml+='            <td class="text-center">' + vrespuesta[vi].folio + '</td>';        
//         vhtml+='            <td class="text-center">';
//         vhtml+='                ' + vrespuesta[vi].responsable_area_envia + '<br /><strong>' + vrespuesta[vi].area_responsable_envia + '</strong>';
//         vhtml+='            </td>';
//         vhtml+='            <td class="text-center">' + vrespuesta[vi].indicaciones + '</td>';
//         vhtml+='            <td class="text-center">' + changeDateFormat(vrespuesta[vi].created_at) + '</td>';
//         vhtml+='            <td class="text-center">' + vacusado + '</td>';
//         vhtml+='            <td class="text-center">';
//         vhtml+='                <button class="btn btn-default" data-toggle="modal" data-target="#myModal" onclick="show('+ vrespuesta[vi].id_folio +')" title="Vista preliminar">';
//         vhtml+='                    <i class="fa fa-eye"></i>';
//         vhtml+='                </button>';
//         vhtml+='                <a class="btn btn-primary" href="'+ vuri +'/titular/recibidos/'+ vrespuesta[vi].id_folio +'/data/'+ id_tipo_documento +'" title="Detalles del documento">';
//         vhtml+='                    <i class="fa fa-window-maximize"></i>';
//         vhtml+='                </a>';
//         vhtml+='            </td>';
//         vhtml+='        </tr>';
//         vj++;
//     }
//     $('.vrespuesta3').html(vhtml);
//  }

function show(vid)
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
                vhtml+='<table class="table table-hover table-mailbox table-show" width="100%">';
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
                if(vresponse.destinatarios[vi].acuse != null) vacuse=vresponse.destinatarios[vi].acuse;

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
                if(vresponse.copias[vi].acuse != null) vacuse=vresponse.copias[vi].acuse;
                
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
                vhtmlAnexo+='   <div class="row">';
            for(var vi=0; vi<vresponse.anexos.length; vi++) {
                vhtmlAnexo+='       <div class="col-sm-3">';
                vhtmlAnexo+='           <div class="hpanel">';
                vhtmlAnexo+='               <div class="panel-body file-body">';
                vhtmlAnexo+='                   <i class="fa fa-file-pdf-o text-info"></i>';
                vhtmlAnexo+='               </div>';
                vhtmlAnexo+='               <div class="panel-footer">';
                vhtmlAnexo+='                   <a href="'+ vuri +'/anexos/' + vresponse.anexos[vi].id + '/descarga">'+ vresponse.anexos[vi].nombre +'</a>';
                vhtmlAnexo+='               </div>';
                vhtmlAnexo+='           </div>';
                vhtmlAnexo+='       </div>';                   
            }
                vhtmlAnexo+='   </div>';

            $('._destinatarios').html(vhtml);
            $('._anexos').html(vhtmlAnexo);
            $('.modal-title').html(vresponse.respuesta.numero);
            $('.font-bold').html(vresponse.respuesta.asunto);

            configTableBasic('table-show', false);
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