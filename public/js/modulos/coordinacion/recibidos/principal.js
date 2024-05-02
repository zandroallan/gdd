function dt_default(url, url_edit, url_acuse) {
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/js/" ;
    var baseUrl2 = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/" ;
    var dt_default = $('.dt_default').DataTable({
        "searching": true,
        "bLengthChange": false,
        "orderable": false,
        "language": {
            "url": baseUrl+"spanish.json"
        },
       "ajax": {
            "dataType": 'json',
            "contentType": "application/json; charset=utf-8",
            "type": "GET",
            "url": url,
            "dataSrc": function (jsonData) {
                    return jsonData;
                }
        },                           
        "columns": [
            { "data": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                "className": 'text-center'
            },
            
            { "data": "numero",
                "render": function(data){
                    return data;
                }
             },
            { "data": "dependencia" },
            { "data": "tipo_documento" },
            { "data": "destinatario" },
            { "data": "fecha",
                "render": function(data){
                    var s1= moment(data).format('DD/MM/YYYY');
                    return s1;
                },
                "className": 'text-center'
            }, 
            { "data": "fecha_envio",
                "render": function(data){
                    var s1= moment(data).format('DD/MM/YYYY HH:mm:ss');
                    return s1;
                },
                "className": 'text-center'
            }, 
            { "data": "usuario_capturo",
                "render": function(data){                    
                    return data;
                },
                "className": 'text-center'
            },            
            { "data": {"id_estinatario":"id_estinatario", "acuse":"acuse", "usuario_acuso":"usuario_acuso"},
                "render": function(data){

                    var s1= url_acuse;
                    var newStr2= s1.replace('_', data.id_estinatario);

                    var s1= '<button type="button" class="btn btn-default btn-xs" onclick="acusar_oficialia(\''+newStr2+'\',1)">Sin acusar</button>';
                    if(data.acuse!=null){ var s1= '<span class="badge badge-success" title="Acusado por: '+data.usuario_acuso+'"><i class="fa fa-gavel"></i>'+moment(data.acuse).format('DD/MM/YYYY HH:mm:ss')+'</span>'; }
                    
                    return s1;
                },
                "className": 'text-center'
            },            
            { "data": {"documentos":"documentos", "id_docto":"id_docto"},
                "render": function(data){
                    var doctos= data.documentos;
                    var id_docto= data.id_docto;
                    var array= doctos.split("|");
                    
                    var s1= '<div class="btn-group">'+
                                '<button data-toggle="dropdown" class="btn btn-primary2 btn-sm dropdown-toggle"><i class="fa fa-paperclip"></i> <span class="caret"></span></button>'+
                                '<ul class="dropdown-menu">';

                    array.forEach(function(elemento) {
                        s1+= '<li><a href="'+baseUrl2+'anexos/'+id_docto+'/descarga">'+elemento+'</a></li>';
                    });

                    s1+='</ul>'+
                        '</div>';

                    return s1;
                },
                "className": 'text-center'
            }, 
            { "data": {"id_estinatario":"id_estinatario"}, 
              "render": function(data){

                var cadena="";
                /*var status= $("#status").val();
                var cadena="";
                if(status==0){*/
                    var s1= url_edit;
                    var newStr= s1.replace('_', data.id_estinatario);
                    /*var s2= url_show;
                    var newStr2= s2.replace('_', data.id_estinatario);   */                                       
                    cadena= "<a href='"+newStr+"' class='btn btn-info btn-circle' title='Ver'><i class='fa fa-search'></i></a> ";
                //}                            
                return   cadena;               
              },
                "className": 'text-center'
            }
        ],
        createdRow: function (row, data, index) {            
           
            if(data.es_nuevo==1){
                $(row).addClass('font-extra-bold-row');
            }           
           
        }        
       
    });    
}
$("#id_dependencia").change(function(event){
    var id_dependencia = $('#id_dependencia').val();
    //alert(id_dependencia);
    var array= [246,247,267,313,318];
    if(id_dependencia==246 || id_dependencia==247 || id_dependencia==267 || id_dependencia==313 || id_dependencia==318){
        $('#div-remitente').removeClass('hidden');        
    }else{
        $('#div-remitente').addClass('hidden');
    }
});


function acusar_oficialia(url2, origen){
    //alert(url2);
    $.ajax({
        type: "GET",
        url: url2,
        data: $(this).serialize(),
        success: function(json) {             
            swal({                
                type: 'success',
                title: 'Exitoss',
                html: json.success,
                showConfirmButton: false,
                timer: 1500
            }).then(function() {                
                if(origen==1){ $('.dt_default').DataTable().ajax.reload(); }
                if(origen==2){ 
                    
                    $('#btn-acusar').addClass('hidden'); 
                    $('#lbl_acuse').removeClass('hidden'); 
                    $('#lbl_vacuse').text(moment(json.acuse).format('DD/MM/YYYY HH:mm:ss')); 
                }
                
            });
        },
        error: function(json)
        {
            var jsonString= json.responseJSON;
            if(json.status === 422) {
                messages_validation(null, false);
                swal({
                    type: 'error',
                    title: 'Lo siento',
                    html: 'Se han encontrado <b>errores</b>, favor de verificar los datos.',
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
            //l.ladda('stop'); 
        }
    });   
}