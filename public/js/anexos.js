$('#myformdeleteanexo').on('submit', function(e) {
    var el = $('#myformdeleteanexo');
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
                window.location.reload();                
            });
        },
        error: function(json)
        {
            if(json.status === 422) {                   
                var jsonString= json.responseJSON;
                var errors = jsonString.errors;
                //alert(errors);
            } else {

                alert('Incorrect credentials. Please try again.');
            }
        }           
    });
});

function destroy_anexo(id){
    swal({
        title: 'Advertencia!',
        text: "Esta seguro de eliminar este anexo?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {                
            var url=$('.myformdeleteanexo').attr('action');
            url= url.replace(/\/[^\/]*$/, '/'+id)
            $('.myformdeleteanexo').attr('action', url).submit();
        }           
    }); 
}