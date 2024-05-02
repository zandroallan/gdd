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

$(".btn-eliminar").click(function() {
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
    l.ladda('start');
    var el = $('#myform');
    //validate();
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: el.attr('action'),
        data: $(this).serialize(),
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
                //alert(3);
                messages_validation(null, false);
                swal({
                    /*position: 'top',*/
                    type: 'error',
                    title: 'Lo siento',
                    html: 'Se han encontrado <b>errores</b>, favor de verificar los datossss.',
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

function messages_validation(fields, show){

    if(show==true){
        //alert(2);
        $.each(fields, function(key, value) {
            $('#el-'+key).html(value);
            $('#el-'+key).removeClass('hidden');
        });
    }else{        
        $('label.error').html("");
        $('label.error').addClass('hidden');
    }

}

/*function validate(){

    $('#myform input, #myform select').each(function(){
                    $('#el-'+this.id).html("");
            $('#'+this.id).removeClass('md-input-danger');
            $('#lbl-'+this.id).removeClass('md-color-red-A700');
    });

}*/

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

$(".btn-concluir").click(function() {
    var status= $("#status").val();
    var titulo="";
    var texto="";
    var boton=""
    var boton_color= "";
    if(status==1){
        titulo="¿Realmente desea Desbloquear este módulo?";
        texto="Una vez desbloqueado el módulo podrá, Agregar, Modificar o Eliminar registros.";
        boton= "Desbloquear";
        boton_color= "#9e9e9e";
    }else{
        titulo="¿Realmente desea Terminar este módulo?";
        texto="Una vez terminado el módulo no podrá, Agregar, Modificar o Eliminar registros.";
        boton= "Terminar";
        boton_color= "#009688";
    }
    swal({
        title: titulo,
        text: texto,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: boton_color,
        cancelButtonColor: '#d33',
        confirmButtonText: boton,
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {            
            $(".myformconcluir").submit();
        }
    });
});

$('#myformconcluir').on('submit', function(e) {
    $(".btn-concluir").prop('disabled', true);
    var el = $('#myformconcluir');
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: el.attr('action'),
        data: $(this).serialize(),
        success: function(json) {
            swal({
                type: 'success',
                title: 'Éxito',
                html: json.success,
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                if(json.origin===1){
                    window.location = json.url;
                }else{
                    location.reload();
                }

            });
        },
        error: function(json)
        {
            var jsonString= json.responseJSON;
            if(json.status === 422) {
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
             $(".btn-concluir").prop('disabled', false);
        }
    });
});