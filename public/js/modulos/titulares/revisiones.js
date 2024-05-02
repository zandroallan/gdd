$(document).ready(function() {
    // $('#valumnos').addClass('active');
    // $('#btnnuevo').attr('onclick', 'open_create_alumnos()');
    index_(); 
});
 
function index_()
 {
    $.ajax({
        type: 'GET',
        url: vuri + '/titular/revisiones/resultados',
        dataType: "JSON",
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vrespuesta=vresponse.respuesta;
            switch(vresponse.codigo){
                case 0:
                    // $('.vrespuesta').html('<div class="alert alert-warning" role="alert">'+ vrespuesta +' . . .</div>');
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
    for(vi=0; vi<vrespuesta.length; vi++){
        vhtml+='        <tr class="clickable-row" id="tr_'+ vrespuesta[vi].id +'">';
        vhtml+='            <td class="text-center"><span class="label label-warning">' + (vi + 1) + '</span></td>';
        vhtml+='            <td class="text-center"><p class="text-'+ vrespuesta[vi].tipo_documento_color +'">' + vrespuesta[vi].tipo_documento + '</p></td>';
        vhtml+='            <td class="text-center">' + vrespuesta[vi].asunto + '</td>';
        vhtml+='            <td class="text-center">' + changeDateFormat(vrespuesta[vi].created_at) + '</td>';
        vhtml+='            <td class="text-center">';
        vhtml+='                <a class="btn btn-success btn-circle" href="'+ vuri +'/titular/documento/'+ vrespuesta[vi].id +'/pdf" title="Vista preliminar" target="_blank">';
        vhtml+='                    <i class="fa fa-file"></i>';
        vhtml+='                </a>';
        vhtml+='                <a class="btn btn-info btn-circle" href="'+ vuri +'/titular/revisiones/'+ vrespuesta[vi].id +'/edit" title="Editar documento">';
        vhtml+='                    <i class="fa fa-edit"></i>';
        vhtml+='                </a>';
        vhtml+='                <button type="button" class="btn btn-danger btn-circle" onclick="delete_('+ vrespuesta[vi].id +')" title="Eliminar documento">';
        vhtml+='                    <i class="fa fa-trash"></i>';
        vhtml+='                </button>';
        vhtml+='            </td>';
        vhtml+='        </tr>';
    }
    $('.vrespuesta').html(vhtml);
    $('.table').footable();
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

function changeDateFormat(vfecha) 
 {
    var vfecha_request=vfecha.split(" ");
    var vfecha_response=vfecha_request[0].split("-");
    var vresponse=vfecha_response[2] + "/" + vfecha_response[1] + "/" + vfecha_response[0] + " " + vfecha_request[1];
    return vresponse;
 }