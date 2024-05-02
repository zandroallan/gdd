var buttonpressed;
$(".btn-guardar").click(function() {
    buttonpressed= $(this).attr('name');    
    swal({
        title: 'Guardar Datos',
        text: "Esta seguro de guardar los datos?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {            
            //swal({title: "<span style='color:#3498db'>Enviado!</span>", html: "El registro ha sido enviado <b>satisfactoriamente</b>.", type: "success" });
            $(".myform").submit();  
        }           
    });        
});

$(".btn-enviar").click(function() {
    buttonpressed= $(this).attr('name');
    //alert(buttonpressed);
    swal({
        title: 'Enviar',
        text: "Realmente desea de enviar los datos capturados?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {  
            $('#enviado ').val(1);                     
            //swal({title: "<span style='color:#3498db'>Enviado!</span>", html: "El registro ha sido enviado <b>satisfactoriamente</b>.", type: "success" });
            $(".myform").submit();  
        }           
    });        
});

$(".btn-borradores").click(function() {
    buttonpressed = $(this).attr('name');
    $('#enviado ').val(0);
    $(".myform").submit();        
});

$(".btn-actualizar").click(function() {
    buttonpressed = $(this).attr('name');
    //$('#enviado ').val(0);
    $(".myform").submit();        
}); 

$(".btn-turnar").click(function() {
    buttonpressed = $(this).attr('name');
    $('#turnar ').val(1);
    $(".myform").submit();        
});     

$(".btn-eliminar").click(function() {
    buttonpressed = $(this).attr('name');
    swal({
        title: 'Advertencia!',
        text: "Esta seguro de eliminar los datos?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            //swal({title: "<span style='color:#3498db'>Enviado!</span>", html: "El registro ha sido enviado <b>satisfactoriamente</b>.", type: "success" });
            $(".myformdelete").submit();    
        }           
    });        
});

$('#myform').on('submit', function(e) {
    var l= $('.'+buttonpressed).ladda();
    //alert(buttonpressed);
    //var l= buttonpressed.ladda();
    l.ladda('start');
    var el = $('#myform');    
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: el.attr('action'),
        data: new FormData(this),
        processData: false,
        contentType: false,       
        success: function(json) {  
            if(json.origin=='create'){ clean_form(); } 
            
            var fields = json.data;
            messages_validation(fields, false);

            swal({
                /*position: 'top',*/
                type: 'success',
                title: 'Exito',
                html: json.success,
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                l.ladda('stop');                
                if(json.origin=='update'){ window.location = json.url; }                                 
            });
        },
        error: function(json)
        {
            var jsonString= json.responseJSON;
            if(json.status === 422) {
                messages_validation(null, false);
                swal({
                    /*position: 'top',*/
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
             l.ladda('stop'); 
        }           
    });
});



$('#myformdelete').on('submit', function(e) {
    var el = $('#myformdelete');
    e.preventDefault(); 
    $.ajax({
        type: "DELETE",
        url: el.attr('action'),
        data: $(this).serialize(),
        success: function(json) {               
            //clean_form();
            swal({                
                type: 'success',
                title: 'Exito',
                html: json.success,
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location = json.url;                
            });
        },
        error: function(json)
        {
            if(json.status === 422) {                   
                var jsonString= json.responseJSON;
                var errors = jsonString.errors;
                /*$.each(errors, function(key, value) {
                    $('#el-'+key).html(value);
                    $('#'+key).addClass('md-input-danger');
                    $('#lbl-'+key).addClass('md-color-red-A700');                        
                    
                });*/
            } else {

                alert('Incorrect credentials. Please try again.')
            }
        }           
    });
});

$('#myformdeletei').on('submit', function(e) {
    var el = $('#myformdeletei');

    e.preventDefault(); 
    $.ajax({
        type: "DELETE",
        url: el.attr('action'),
        data: $(this).serialize(),
        success: function(json) {               
            //clean_form();
            swal({                
                type: 'success',
                title: 'Exito',
                html: json.success,
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                var url=$('.myformdeletei').attr('action');
                url= url.replace(/\/[^\/]*$/, '/0');     
                $('.myformdeletei').attr('action', url);          
                $('.dt_default').DataTable().ajax.reload();
            });
        },
        error: function(json)
        {
            if(json.status === 422) {                   
                var jsonString= json.responseJSON;
                var errors = jsonString.errors;
            } else {
                alert('Incorrect credentials. Please try again.')
            }
        }           
    });
});

function messages_validation(fields, show){
    var tb1error= false;
    var tb2error= false;
    if(show==true){
        //alert(2);
        $.each(fields, function(key, value) {
            $('#el-'+key).html(value);
            $('#el-'+key).removeClass('hidden');
            if(key=='id_area_responde' || key=='fecha_vencimiento' || key=='indicaciones'){ tb2error= true; }
            if(key=='id_dependencia' || key=='id_tipo_documento' || key=='numero'
            || key=='fecha' || key=='id_destinatario'  || key=='remitente' || key=='id_cargo'){ tb1error= true; }
        });
    }else{        
        $('label.error').html("");
        $('label.error').addClass('hidden');
    }

    if(tb2error){
        $('#tb2error').removeClass('hidden');
    }else{
        $('#tb2error').addClass('hidden');
    }
    if(tb1error){
        $('#tb1error').removeClass('hidden');
    }else{
        $('#tb1error').addClass('hidden');
    }
}

function destroy(id){
    swal({
        title: 'Advertencia!',
        text: "Esta seguro de eliminar los datos?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {                
            var url=$('.myformdeletei').attr('action');
            url= url.replace(/\/[^\/]*$/, '/'+id)
            $('.myformdeletei').attr('action', url).submit();
            //alert(s);
            //$(".myformdelete").submit();

        }           
    }); 
}