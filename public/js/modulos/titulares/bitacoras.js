var vidDocumentoBitacora=0;
$(document).ready(
    function() {
        $('._bitacora').addClass('active');
        
        $('#btnaddFile').attr('onclick', 'addAnexo("frmbitacoraAnexo")');
        index_();

        $('#filer').filer({        
            extensions: ["ods", "odt","jpg", "jpge", "png", "xls", "xlsx", "ppt", "odt", "pptx", "docx", "doc", "pdf", "zip", "rar"],
            showThumbs: true,
            addMore: true        
        });
    }
);
 
function index_()
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/titular/bitacoras/resultados',
        dataType: "JSON",
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vrespuesta=vresponse.respuesta;
            switch(vresponse.codigo){
                case 0:
                    $('.vrespuesta').html('<div class="alert alert-warning" role="alert">'+ vrespuesta +' . . .</div>');
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
    var vj=1;
    var vhtml ='';
        vhtml+='<table class="table align-middle table-nowrap mb-0" width="100%">';
        vhtml+='    <thead class="table-light">';
        vhtml+='        <tr>';
        vhtml+='            <th class="text-center">No DOCUMENTO</th>';
        vhtml+='            <th class="text-center">DESTINATARIO</th>';
        vhtml+='            <th class="text-center">ASUNTO</th>';
        vhtml+='            <th class="text-center">ENVIADO</th>';
        vhtml+='            <th class="text-center">STATUS</th>';
        vhtml+='            <th class="text-center">#</th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for(vi=0; vi<vrespuesta.length; vi++){
        vhtml+='        <tr class="clickable-row" id="tr_'+ vrespuesta[vi].id +'">';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].folio + '</td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].destinatario +'<br /><strong>'+ vrespuesta[vi].cargo_destinatario + '</strong></td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].asunto + '</td>';
        vhtml+='            <td class="text-center">' + changeDateFormat(vrespuesta[vi].fecha_documento) + '</td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].status + '</td>';
        vhtml+='            <td class="text-center">';
        if(vrespuesta[vi].id_status != 3){
            vhtml+='            <a class="btn btn-outline-success btn-icon waves-effect waves-light" onclick="set_id('+ vrespuesta[vi].id +')" data-toggle="modal" data-target="#mdlBitacora" title="Anexo Bitacora">';
            vhtml+='                <i class="bx bx-paperclip"></i>';
            vhtml+='            </a>';
            vhtml+='            <a class="btn btn-outline-success btn-icon waves-effect waves-light" href="'+ vuri +'/titular/bitacoras/'+ vrespuesta[vi].id +'/edit" title="Editar Documento">';
            vhtml+='                <i class="ri-edit-box-fill"></i>';
            vhtml+='            </a>';
            vhtml+='            <button type="button" class="btn btn-outline-danger btn-icon waves-effect waves-light" onclick="delete_('+ vrespuesta[vi].id +')" title="Eliminar Documento">';
            vhtml+='                <i class="mdi mdi-delete-empty-outline"></i>';
            vhtml+='            </button>';
        }        
        vhtml+='            </td>';
        vhtml+='        </tr>';
        vj++;
    }
        vhtml+='    </tbody>';
        vhtml+='</table>';
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
                url: vuri + '/titular/bitacoras/' + vid_,
                dataType: "JSON",
                data: {
                    _token: $('#_token').val()
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

function set_id(id_)
 {
    vidDocumentoBitacora=id_;
    console.log(vidDocumentoBitacora);
 }

function addAnexo(idForm)
 {
    var vformData = new FormData($("#"+ idForm)[0]);
    vformData.append('id_documento_bitacora', vidDocumentoBitacora);

    $.ajax({
        type: 'POST',
        url: vuri + '/titular/bitacoras/anexo',
        dataType: 'JSON',        
        contentType:false,
        processData: false,
        cache:false,
        data: vformData,
        success: function(vresponse, vtextStatus, vjqXHR) {
            $("#mdlBitacora").modal('hide');
            swal({
                type: 'success',
                title: 'Exito',
                html: 'El Anexo a sido dato de alta correctamente.',
                showConfirmButton: false,
                timer: 1500
            });

        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ console.log(verrorThrown); }
    });
 }

function changeDateFormat(vfecha) 
 {
    var vfecha_request=vfecha.split(" ");
    var vfecha_response=vfecha_request[0].split("-");
    var vresponse=vfecha_response[2] + "/" + vfecha_response[1] + "/" + vfecha_response[0];
    return vresponse;
 }