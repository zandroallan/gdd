function dt_default(url, url_edit) {
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/js/" ;
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
                    return '<b>'+data+'</b>';
                }
             },
            { "data": "dependencia" },
            { "data": "destinatario" },
            { "data": "fecha",
                "render": function(data){
                    var s1= moment(data).format('DD/MM/YYYY');
                    return s1;
                },
                "className": 'text-center'
            }, 
            { "data": "id_tipo_entrada",
                "render": function(data){
                    var s1= '<span class="badge badge-default">Conocimiento</span>';
                    if(data==1){ var s1= '<span class="badge badge-success">Asignación directa</span>'; }                    

                    return s1;
                },
                "className": 'text-center' 

            },                     
            { "data": "id", 
              "render": function(data){
                var cadena="";
                /*var status= $("#status").val();
                var cadena="";
                if(status==0){*/
                    var s1= url_edit;
                    var newStr= s1.replace('_', data);                     
                    cadena= "<a href='"+newStr+"' class='btn btn-warning btn-circle' title='Editar'><i class='fa fa-pencil'></i></a> "+
                "<a href='#'  title='Eliminar' class='btn btn-danger btn-circle' onclick='destroy(\""+data+"\")'><i class='fa fa-trash'></i></a>";
                //}                            
                return   cadena;               
              },
                "className": 'text-center'
            }
        ]
       
    });    
}

function dt_default2(url, url_edit) {
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/js/" ;
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
                    return '<b>'+data+'</b>';
                }
             },
            { "data": "dependencia" },
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
            { "data": "acuse",
                "render": function(data){
                    var s1= '<span class="badge badge-default">Sin acusar</span>';
                    if(data!=null){ var s1= '<span class="badge badge-success">'+moment(data).format('DD/MM/YYYY HH:mm:ss')+'</span>'; }
                    
                    return s1;
                },
                "className": 'text-center'
            },  
                                           
            { "data": {"id": "id", "enviado": "fecha_envio" }, 
              "render": function(data){
                var cadena="";
                var momentA= moment(data.fecha_envio).format('YYYY-MM-DD');;
                var momentB= moment().format('YYYY-MM-DD');
                //alert(momentB+" "+momentA);

                if(momentB==momentA){                                  
                    var id= data.id;
                    var s1= url_edit;
                    var newStr= s1.replace('_', id);                     
                    cadena= "<a href='"+newStr+"' class='btn btn-warning btn-circle' title='Editar'><i class='fa fa-pencil'></i></a> ";                    
                }

                           
                return   cadena;               
                },
                "className": 'text-center'
            }
        ]         
    });    
}

function dt_default3(url, url_edit) {
    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/js/" ;
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
                    return '<b>'+data+'</b>';
                }
             },
            { "data": "dependencia" },
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
            { "data": {"acuse":"acuse", "usuario_acuso":"usuario_acuso"},
                "render": function(data){
                    var s1= '<span class="badge badge-default">Sin acusar</span>';
                    var acuse= data.acuse;
                    
                    if(data!=null){ 
                        var usurio_acuso= data.usuario_acuso;
                        var s1='<button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Por: '+usurio_acuso+'">'+moment(acuse).format('DD/MM/YYYY HH:mm:ss')+'</button>';
                        //var s1= '<span class="button badge badge-success" data-toggle="tooltip" data-placement="top" title="Por: '+usurio_acuso+'">'+moment(acuse).format('DD/MM/YYYY HH:mm:ss')+'</span>';
                    }
                    
                    return s1;
                },
                "className": 'text-center'
            }
        ]         
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